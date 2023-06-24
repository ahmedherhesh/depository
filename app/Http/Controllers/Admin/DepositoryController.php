<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depository;
use App\Models\Item;
use Illuminate\Http\Request;

class DepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositories = Depository::all();
        return view('admin.depositories', compact('depositories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'min' => 'عدد الأحرف يجب ان يكون 3 على الأقل'
        ]);

        $depository = Depository::create($request->all());
        if ($depository)
            return redirect()->back()->with('success', 'تم اضافة المخزن بنجاح');
        return redirect()->back()->with('failed', 'حدث خطأ ما حاول مرة أخرى');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = Item::whereDepotId($id)->paginate(18);
        return view('items.items', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'min' => 'عدد الأحرف يجب ان يكون 3 على الأقل'
        ]);

        $depository = Depository::find($id);
        if ($depository) {
            $depository->update($request->all());
            return redirect()->back()->with('success', 'تم تعديل المخزن بنجاح');
        }

        return redirect()->back()->with('failed', 'هذا المخزن غير موجود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depository = Depository::find($id);
        if ($depository) {
            $depository->delete($id);
            return redirect()->back()->with('success', 'تم حذف المخزن بنجاح');
        }
        return redirect()->back()->with('failed', 'هذا المخزن غير موجود'); //
    }
}
