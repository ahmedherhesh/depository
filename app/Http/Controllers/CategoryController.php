<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends MasterController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::whereParentId(null);
        if (!$this->isAdmin())
            $cats->allowed();
        $cats = $cats->paginate(18);
        return view('categories.categories', ['cats' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user()->id;
        $data['depot_id'] = $this->user()->depot_id;
        if ($this->isAdmin())
            $data['depot_id'] = $request->depot_id;
        $category = Category::create($data);
        if ($category)
            return redirect()->back()->with('success', 'تم اضافة التصنيف بنجاح');
        return redirect()->back()->with('failed','حدث خطأ ما حول مره اخرى');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = Item::enabled()->whereCatId($id)->orWhere('sub_cat_id', $id)->latest();
        if (!$this->isAdmin())
            $items->allowed();
        $items = $items->paginate(18);
        return view('categories.category', ['items' => $items]);
    }

    public function subCategories($parent_id)
    {
        $sub_categories = Category::whereParentId($parent_id)->get();
        return response()->json($sub_categories);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function getCategory($id)
    {
        $category = Category::whereId($id);
        if (!$this->isAdmin())
            $category->whereUserId($this->user()->id);
        $category = $category->first();
        return $category;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request)
    {
        $category = $this->getCategory($request->category_id);
        $category->update($request->all());
        if (!$category) return redirect()->back();
        return redirect()->back()->with('success', 'تم تحديث التصنيف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->getCategory($id);
        if ($category) {
            $category_delete = $category->delete();
            if ($category_delete)
                return redirect()->back()->with('success', 'تم حذف التصنيف بنجاح');
        }
        return redirect()->back();
    }
}
