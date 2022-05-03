<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Review::orderBy('position', 'asc')->get();
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
            'user_post' => 'required',
            'position' => 'required|numeric',
            'message' => 'required',
            'client_image' => 'required',
        ]);

        $imageName = time() . '.' . (explode('/', (explode(';', $request->client_image))[0]))[1];
        Image::make($request->client_image)->save('media/review_image/' . $imageName);



        Review::insert([
            'name' => $request->name,
            'user_post' => $request->user_post,
            'position' => $request->position,
            'message' => $request->message,
            'client_image' => '/media/review_image/' . $imageName
        ]);
        return response()->json([
            'message' => 'Review Stored',
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
            'name' => 'required',
            'user_post' => 'required',
            'position' => 'required|numeric',
            'message' => 'required',
        ]);


        if ($request->update_image) {

            $old_image =  Review::select('client_image')->where('id', $request->id)->first();
            unlink(ltrim($old_image['client_image'], '/'));

            $imageName = time() . '.' . (explode('/', (explode(';', $request->client_image))[0]))[1];
            Image::make($request->client_image)->save('media/review_image/' . $imageName);

            Review::where('id', $id)->update([
                'name' => $request->name,
                'user_post' => $request->user_post,
                'message' => $request->message,
                'client_image' => '/media/review_image/' . $imageName
            ]);

            return response()->json([
                'message' => 'Review Updated',
            ])->setStatusCode(200);
        }


        Review::where('id', $id)->update([
            'name' => $request->name,
            'user_post' => $request->user_post,
            'position' => $request->position,
            'message' => $request->message,
        ]);
        return response()->json([
            'message' => 'Review Updated',
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
        Review::where('id', $id)->delete();

        return response()->json([
            'message' => 'Review Deleted',
        ])->setStatusCode(200);
    }
}
