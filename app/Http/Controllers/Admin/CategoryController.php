<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Category::with('portfolios')->orderBy('position', 'asc')->get();
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'position' => 'required|numeric',
            'slug' => 'required',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'position' => $request->position,
            'slug' => $request->slug,
        ]);
        return response()->json([
            'message' => 'Category Stored',
        ])->setStatusCode(200);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $request->validate([
            'category_name' => 'required',
            'slug' => 'required',
            'position' => 'required|numeric',

        ]);


        Category::where('id', $id)->update([
            'category_name' => $request->category_name,
            'slug' => $request->slug,
            'position' => $request->position,
        ]);
        return response()->json([
            'message' => 'Category Updated',
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Category::where('id', $id)->delete();

        return response()->json([
            'message' => 'Category Deleted',
        ])->setStatusCode(200);
    }
}
