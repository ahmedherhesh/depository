<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::whereParentId(null)->paginate(25);
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
        $user = session()->get('user');
        $data = $request->all();
        $data['user_id'] = $user->id;
        $category = Category::create($data);
        if ($category)
            return redirect()->back()->with('success', 'تم اضافة التصنيف بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = Item::whereCatId($id)->orWhere('sub_cat_id', $id)->latest()->paginate(18);
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
        $user = session()->get('user');
        $category = Category::whereId($id);
        if ($user->role == 'admin')
            $category = $category->first();
        else
            $category = $category->whereUserId($user->id)->first();
        return $category ? $category : '';
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
