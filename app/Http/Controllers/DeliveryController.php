<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use App\Models\Item;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery()
    {
        $user = session()->get('user');
        $deliveries = Delivery::query();
        $qty = function ($item_return) {
            $num = 0;
            foreach ($item_return as $item_r) {
                $num += $item_r->qty;
            }
            return $num;
        };
        if ($user->role == 'admin')
            $deliveries = $deliveries->paginate(18);
        else
            $deliveries = $deliveries->whereUserId($user->id)->paginate(18);
        return view('items.deliveried-items', compact('deliveries','qty'));
    }
    public function _delivery(DeliveryRequest $request)
    {
        $user = session()->get('user');
        $data = $request->all();
        $item = Item::find($request->item_id);
        if ($item->qty >= $request->qty) {
            $data['user_id'] = $user->id;
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
