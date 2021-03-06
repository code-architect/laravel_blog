<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Backend\BackendBaseController\BackendBaseController;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends BackendBaseController
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->orderBy('id', 'desc')->paginate($this->pageLimit);
        return view("backend.category.index", compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('backend.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());
        return redirect(route('category.index'))->with('message', 'New category has been created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::findOrFail($id)->update($request->all());
        return redirect(route('category.index'))->with('message', 'Category was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->posts->count() === 0)
        {
            Category::findOrFail($id)->delete();
            return redirect(route('category.index'))->with('message', 'Category Has been successfully deleted.');
        }
        return redirect(route('category.index'))->with('warning-message', 'Category cannot be deleted, related posts are depended on this category!');
    }
}
