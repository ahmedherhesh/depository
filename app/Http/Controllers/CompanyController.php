<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies', compact('companies'));
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

        $company = Company::create($request->all());
        if ($company)
            return redirect()->back()->with('success', 'تم اضافة الشركة بنجاح');
        return redirect()->back()->with('failed', 'حدث خطأ ما حاول مرة أخرى');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = Item::whereCompanyId($id)->paginate(18);
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

        $company = Company::find($id);
        if ($company) {
            $company->update($request->all());
            return redirect()->back()->with('success', 'تم تعديل اسم الشركة بنجاح');
        }

        return redirect()->back()->with('failed', 'هذا اسم الشركة غير موجود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete($id);
            return redirect()->back()->with('success', 'تم حذف الشركة بنجاح');
        }
        return redirect()->back()->with('failed', 'هذا الشركة غير موجود'); //
    }
}
