<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnItemRequest;
use App\Http\Requests\ReturnToStockRequest;
use App\Models\Delivery;
use App\Models\Item;
use App\Models\ItemReturn;
use Illuminate\Http\Request;

class ReturnItemController extends MasterController
{
    public function returnedItems(Request $request)
    {
        $returnedItems = ItemReturn::whereInStock(0);
        //category
        if ($request->cat_id)
            $returnedItems->whereHas('item', function ($query) use ($request) {
                $query->whereCatId($request->cat_id);
            });
        //Depository
        if ($request->depot_id && $this->isAdmin())
            $returnedItems->whereHas('item', function ($query) use ($request) {
                $query->whereDepotId($request->depot_id);
            });
        //Status
        if ($request->status)
            $returnedItems->whereStatus($request->status);
        //between date and date
        if ($request->from && $request->to) {
            $returnedItems->whereDate('created_at', '>=',  $request->from)
                ->whereDate('created_at', '<=',  $request->to);
        }
        //from date
        else if ($request->from && !$request->to)
            $returnedItems->whereDate('created_at', '>=',  $request->from);
        //to date
        else if (!$request->from && $request->to)
            $returnedItems->whereDate('created_at', '<=',  $request->to);
        //terms
        if ($request->q)
            $returnedItems->whereHas('item', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->q . '%');
            })->orWhere('recipient_name', 'LIKE', '%' . $request->q . '%');

        if (!$this->isAdmin())
            $returnedItems = $returnedItems->have();
        $returnedItems = $returnedItems->paginate(18);
        return view('items.returned-items', compact('returnedItems'));
    }
    public function returnItem(ReturnItemRequest $request)
    {
        $user = session()->get('user');
        $data = $request->all();
        $data['user_id'] = $user->id;
        $item = Item::whereId($request->item_id);
        $deliverdItem = Delivery::whereId($request->delivery_id);
        if (!in_array($user->role, ['super-admin', 'admin'])) {
            $item = Item::allowed();
            $deliverdItem = Delivery::whereUserId($user->id);
        }
        $item = $item->first();
        $deliverdItem = $deliverdItem->first();
        if ($item) {
            if ($deliverdItem) {
                if ($deliverdItem->qty >= $request->qty) {
                    $itemReturn = ItemReturn::create($data);
                    if ($itemReturn) {
                        if ($request->inStock == 1)
                            return redirect("return-to-stock?returned_item_id=$itemReturn->id&item_id=$itemReturn->item_id");
                        return redirect()->back()->with('success', 'تم استرداد المنتج بنجاح');
                    }
                }
            }
            return redirect()->back()->with('failed', 'الكمية المستردة اكثر من المستلمة');
        }
        return redirect()->back()->with('failed', 'هذا المنتج غير متوفر او غير مسموح لك بالوصول إليه');
    }

    function returnToStock(ReturnToStockRequest $request)
    {
        $user = session()->get('user');
        $returnedItem = ItemReturn::whereId($request->returned_item_id)->whereInStock(0);
        $item = Item::whereId($request->item_id);
        if (!in_array($user->role, ['super-admin', 'admin'])) {
            $returnedItem = $returnedItem->have();
            $item = $item->allowed();
        }
        $item = $item->first();
        $returnedItem = $returnedItem->first();
        if (!$item || !$returnedItem)
            return redirect()->back()->with('failed', 'هذا المنتج غير متوفر او انك لا تملك صلاحية الوصول له');
        if ($item && $item->status == $returnedItem->status)
            $item->update(['qty' => $item->qty + $returnedItem->qty]);
        else
            $item = Item::create([
                'user_id' => $user->id,
                'cat_id' => $item->cat_id,
                'sub_cat_id' => $item->sub_cat_id,
                'company_id' => $item->company_id,
                'depot_id' => $item->depot_id,
                'title' => $item->title,
                'notes' => $item->notes,
                'price' => $item->price,
                'qty' => $returnedItem->qty,
                'allowed_qty' => $item->allowed_qty,
                'status' => $returnedItem->status,
                'date' => date('Y-m-d'),
            ]);
        $returnedItem->update(['in_stock' => 1]);
        return redirect()->back()->with('success', 'تم اضافة المنتج للمخزن بنجاح');
    }
}
