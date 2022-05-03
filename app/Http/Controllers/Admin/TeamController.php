<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data =  Team::orderBy('position', 'asc')->get();
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
            'member_image' => 'required',
            'member_post' => 'required',
            'position' => 'required|numeric',
        ]);


        $imageName = time() . '.' . (explode('/', (explode(';', $request->member_image))[0]))[1];
        Image::make($request->member_image)->save('media/team_image/' . $imageName);


        Team::insert([
            'name' => $request->name,
            'member_post' => $request->member_post,
            'position' => $request->position,
            'member_image' => '/media/team_image/' . $imageName
        ]);
        return response()->json([
            'message' => 'Team Stored',
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
            'member_image' => 'required',
            'member_post' => 'required',
            'position' => 'required|numeric',
        ]);

        // $checkUnique =  Team::where('brand_name', $request->brand_name)->get();


        if ($request->update_image) {

            $old_image =  Team::select('member_image')->where('id', $request->id)->first();
            unlink(ltrim($old_image['member_image'], '/'));

            $imageName = time() . '.' . (explode('/', (explode(';', $request->member_image))[0]))[1];
            Image::make($request->member_image)->save('media/team_image/' . $imageName);

            Team::where('id', $id)->update([
                'name' => $request->name,
                'member_post' => $request->member_post,
                'position' => $request->position,
                'member_image' => '/media/team_image/' . $imageName
            ]);

            return response()->json([
                'message' => 'Team Updated',
            ])->setStatusCode(200);
        }

        Team::where('id', $id)->update([
            'name' => $request->name,
            'member_post' => $request->member_post,
            'position' => $request->position,
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
        unlink(ltrim($request->member_image, '/'));
        Team::where('id', $id)->delete();

        return response()->json([
            'message' => 'Team Deleted',
        ])->setStatusCode(200);
    }
}
