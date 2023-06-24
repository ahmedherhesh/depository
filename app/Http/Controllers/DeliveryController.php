<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
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
        if ($this->isAdmin())
            $deliveries = $deliveries->paginate(18);
        else
            $deliveries = $deliveries->whereUserId($this->user()->id)->allowed()->paginate(18);
        return view('items.deliveried-items', compact('deliveries', 'qty'));
    }
    public function _delivery(DeliveryRequest $request)
    {
        $user = session()->get('user');
        $data = $request->all();
        $item = Item::find($request->item_id);
        if ($item->qty >= $request->qty) {
            $data['user_id'] = $user->id;
            $data['depot_id'] = $item->depot_id;
            $data['status']  = $item->status;
            $delivery = Delivery::create($data);
            if ($delivery) {
                $item->update(['qty' => ((int)$item->qty - (int)$request->qty)]);
                return redirect()->back()->with('success', 'تم التسليم بنجاح');
            }
        }
        return redirect()->back()->with('failed', 'الكمية المطلوبة اكبر من العدد المتوفر');
    }
}
