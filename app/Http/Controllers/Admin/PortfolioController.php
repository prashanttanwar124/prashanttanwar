<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;


class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data =  Portfolio::with('category')->orderBy('position', 'asc')->get();
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
            'name' => 'required',
            'portfolio_image' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'link' => 'required',
            'position' => 'required|numeric',
        ]);


        $imageName = time() . '.' . (explode('/', (explode(';', $request->portfolio_image))[0]))[1];
        Image::make($request->portfolio_image)->save('media/portfolio_image/' . $imageName);


        Portfolio::insert([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'link' => $request->link,
            'position' => $request->position,
            'portfolio_image' => '/media/portfolio_image/' . $imageName
        ]);
        return response()->json([
            'message' => 'Portfolio Stored',
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
            'name' => 'required',
            'portfolio_image' => 'required',
            'category_id' => 'required',
            'link' => 'required',
            'position' => 'required|numeric',
        ]);



        if ($request->update_image) {

            $old_image =  Portfolio::select('portfolio_image')->where('id', $request->id)->first();
            unlink(ltrim($old_image['portfolio_image'], '/'));

            $imageName = time() . '.' . (explode('/', (explode(';', $request->portfolio_image))[0]))[1];
            Image::make($request->portfolio_image)->save('media/portfolio_image/' . $imageName);

            Portfolio::where('id', $id)->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'link' => $request->link,
                'description' => $request->description,
                'position' => $request->position,
                'portfolio_image' => '/media/portfolio_image/' . $imageName
            ]);

            return response()->json([
                'message' => 'Portfolio Updated',
            ])->setStatusCode(200);
        }

        Portfolio::where('id', $id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'link' => $request->link,
            'position' => $request->position,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Costumer Updated',
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
        unlink(ltrim($request->portfolio_image, '/'));
        Portfolio::where('id', $id)->delete();

        return response()->json([
            'message' => 'Portfolio Deleted',
        ])->setStatusCode(200);
    }
}
