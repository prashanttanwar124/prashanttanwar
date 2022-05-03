<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\PageSeo;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PageSeo::orderBy('id', 'desc')->get();
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

        // return $request->metaTags['title'];
        $request->validate([
            'url' => 'required|unique:page_seos,url,' . $request->id,
            'metaTags.title' => 'required',
            // 'metaTags.description' => 'required',
            // 'metaTags.image' => 'required',
        ]);

        PageSeo::insert([
            'url' => $request->url,
            'metaTags' => json_encode($request->metaTags),
        ]);

        return response()->json([
            'message' => 'SEO Stored',
        ])->setStatusCode(200);
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
            'url' => 'required|unique:page_seos,url,' . $request->id,
            'metaTags.title' => 'required',
            // 'metaTags.description' => 'required',
            // 'metaTags.image' => 'required',

        ]);

        PageSeo::where('id', $id)->update([
            'url' => $request->url,
            'metaTags' => json_encode($request->metaTags),
        ]);

        return response()->json([
            'message' => 'SEO Updated',
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PageSeo::where('id', $id)->delete();

        return response()->json([
            'message' => 'SEO Deleted',
        ])->setStatusCode(200);
    }
}
