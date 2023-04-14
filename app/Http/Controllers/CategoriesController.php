<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all categories and return it to categories page
        $categories = categories::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return to  create categories page
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation on request come from create category page
        $request->validate([
            'name' => 'required|unique:categories,name,'.$request->id,
            'description' => 'required',

        ],[
            'name.required' =>'Please enter the category name',
            'name.unique' =>'The category already exists, please enter another category',
            'description.required' =>'Please enter the category description',
        ]);

        // add record to categories table in database
        categories::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        session()->flash('add', 'Category added successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = categories::find($id);
        return view('admin.categories.edit',compact('category','id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validation on request come from create category page
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'required',

        ],[
            'name.required' =>'Please enter the category name',
            'name.unique' =>'The category already exists, please enter another category',
            'description.required' =>'Please enter the category description',
        ]);
        $categories = categories::find($id);

        //update category in categories table
        $categories->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        session()->flash('edit', 'The category updated successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //delete record from database
        categories::find($request->id)->delete();
        session()->flash('delete', 'The category deleted successfully');
        return redirect()->route('categories.index');
    }
}
