<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data =  Client::orderBy('position', 'asc')->get();
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
            'client_image' => 'required',
            'client_name' => 'required',
            'link' => 'required',
            'position' => 'required|numeric',
        ]);


        $imageName = time() . '.' . (explode('/', (explode(';', $request->client_image))[0]))[1];
        Image::make($request->client_image)->save('media/client_image/' . $imageName);


        Client::insert([
            'client_name' => $request->client_name,
            'position' => $request->position,
            'link' => $request->link,
            'client_image' => '/media/client_image/' . $imageName
        ]);
        return response()->json([
            'message' => 'Client Stored',
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
            'client_image' => 'required',
            'client_name' => 'required',
            'link' => 'required',
            'position' => 'required|numeric',
        ]);

        // $checkUnique =  Client::where('brand_name', $request->brand_name)->get();


        if ($request->update_image) {

            $old_image =  Client::select('client_image')->where('id', $request->id)->first();
            unlink(ltrim($old_image['client_image'], '/'));

            $imageName = time() . '.' . (explode('/', (explode(';', $request->client_image))[0]))[1];
            Image::make($request->client_image)->save('media/client_image/' . $imageName);

            Client::where('id', $id)->update([
                'client_name' => $request->client_name,
                'position' => $request->position,
                'link' => $request->link,
                'client_image' => '/media/client_image/' . $imageName
            ]);

            return response()->json([
                'message' => 'Client Updated',
            ])->setStatusCode(200);
        }

        Client::where('id', $id)->update([
            'client_name' => $request->client_name,
            'position' => $request->position,
            'link' => $request->link,
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
        unlink(ltrim($request->client_image, '/'));
        Client::where('id', $id)->delete();

        return response()->json([
            'message' => 'Client Deleted',
        ])->setStatusCode(200);
    }
}
