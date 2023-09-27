<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Http\Requests\DeliveryUpdateRequest;
use App\Models\Delivery;
use App\Models\Item;
use Illuminate\Http\Request;

class DeliveryController extends MasterController
{
    public function delivery(Request $request)
    {
        $deliveries = Delivery::query();
        //category
        if ($request->cat_id)
            $deliveries->whereHas('item', function ($query) use ($request) {
                $query->whereCatId($request->cat_id);
            });
        //Depository
        if ($request->depot_id && $this->isAdmin())
            $deliveries->whereDepotId($request->depot_id);

        //Status
        if ($request->status)
            $deliveries->whereStatus($request->status);

        //between date and date
        if ($request->from && $request->to) {
            $deliveries->whereDate('created_at', '>=',  $request->from)
                ->whereDate('created_at', '<=',  $request->to);
        }
        //from date
        else if ($request->from && !$request->to)
            $deliveries->whereDate('created_at', '>=',  $request->from);
        //to date
        else if (!$request->from && $request->to)
            $deliveries->whereDate('created_at', '<=',  $request->to);
        //terms
        if ($request->q)
            $deliveries->whereHas('item', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->q . '%');
            })->orWhere('recipient_name', 'LIKE', '%' . $request->q . '%');

        $qty = function ($item_return) {
            $num = 0;
            foreach ($item_return as $item_r) {
                $num += $item_r->qty;
            }
            return $num;
        };
        if (!$this->isAdmin())
            $deliveries = $deliveries->allowed();
        $deliveries = $deliveries->paginate(20);
        return view('items.deliveried-items', compact('deliveries', 'qty'));
    }
    public function _delivery(DeliveryRequest $request)
    {
        $data = $request->all();
        $item = Item::find($request->item_id);
        if ($item->qty >= $request->qty) {
            $data['user_id']  = $this->user()->id;
            $data['depot_id'] = $item->depot_id;
            $data['item_id']  = $item->id;
            $data['status']   = $item->status;
            $data['price']    = $item->price;
            $delivery = Delivery::create($data);
            if ($delivery) {
                $item->update(['qty' => ((int)$item->qty - (int)$request->qty)]);
                return redirect()->back()->with('success', 'تم التسليم بنجاح');
            }
        }
        return redirect()->back()->with('failed', 'الكمية المطلوبة اكبر من العدد المتوفر');
    }
    public function getDelivery($id)
    {
        $delivery = Delivery::whereId($id);
        if (!$this->isAdmin())
            $delivery->allowed()->whereUserId($this->user()->id);
        $delivery = $delivery->first();
        return $delivery;
    }
    public function edit($id)
    {
        $delivery = $this->getDelivery($id);
        if ($delivery)
            return view('items.delivered-items-edit', compact('delivery'));
        return redirect()->back()->with('failed', 'العملية التي تريد تعديلها غير موجوده');
    }
    public function update(DeliveryUpdateRequest $request, int $id)
    {
        $delivery = $this->getDelivery($id);
        $item = Item::find($delivery->item_id);
        if ($item) {
            if ($item->qty >= $request->qty) {
                if ($delivery) {
                    $qty = $delivery->qty;
                    // if qty getter than the delivery qty
                    if ($request->qty > $qty) {
                        $qty = (int)$request->qty - (int)$qty;
                        $qty = ((int)$item->qty - (int)$qty);
                    }
                    // if qty lower than the delivery qty
                    elseif ($request->qty < $qty) {
                        $qty = (int)$qty - (int)$request->qty;
                        $qty = ((int)$item->qty + (int)$qty);
                    }
                    // عشان انا بعتمد على ان اصل الكمية المسلمه تفضل زي ما هي حتى لو مسجل مرتجعات لعملية التسليم وبعد كدا بخصم بعمليه حسابيه 
                    $itemReturnQty = $delivery->itemReturn->sum('qty');
                    // بعد ما جبت الكميه المرتجعه هخصم كمية التسليم الجديده من الكميه المتوفره من المنتج بعد خصم الكميه  المرتجعه من عملية التسليم سابقا 
                    if ($delivery->qty != $qty)
                        $item->update(['qty' => $qty - $itemReturnQty]);
                    $data = $request->all();
                    // حتى لا يتم تقليل اصل عملية التسليم
                    $data['qty'] = (int)$data['qty'] < $delivery->qty ? $data['qty'] + $itemReturnQty : $data['qty'];
                    $delivery->update($data);
                    return redirect()->back()->with('success', 'تم تحديث عملية التسليم بنجاح');
                }
            }
            return redirect()->back()->with('failed', 'الكمية المطلوبة اكبر من العدد المتوفر');
        }
        return redirect()->back()->with('failed', 'المنتج غير متوفر');
    }

    public function destroy(int $id)
    {
        $delivery = $this->getDelivery($id);
        if ($delivery) {
            $item = Item::find($delivery->item_id);
            $itemReturnQty = $delivery->itemReturn->sum('qty');
            if ($item)
                $item->update(['qty' => ($item->qty + $delivery->qty) - $itemReturnQty]);
            $delivery->delete();
            return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
        }
        return redirect()->back()->with('failed', 'هذه العملية غير متوفرة');
    }
}
