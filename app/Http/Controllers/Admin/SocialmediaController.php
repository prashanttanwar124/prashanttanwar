<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\SocialMedia;
use App\Http\Controllers\Controller;

class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SocialMedia::orderBy('id', 'desc')->get();
        return $data;
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
        $rules = [
            'whatsapp' => 'required',
            'address_link' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            //
            'experience.*.title' => 'required',
            'experience.*.year' => 'required',
            'experience.*.description' => 'required',
            //
            'education.*.title' => 'required',
            'education.*.year' => 'required',
            'education.*.description' => 'required',
            //
            'languages_skills.*.name' => 'required',
            'languages_skills.*.percentage' => 'required',
            //
            'coding_skills.*.name' => 'required',
            'coding_skills.*.percentage' => 'required',
            //
            'knowledge.*.title' => 'required',
            //
            'my_services.*.icon' => 'required',
            'my_services.*.title' => 'required',
            'my_services.*.description' => 'required',
        ];

        $customMessages = [
            'required' => 'This field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        SocialMedia::where('id', $id)->update([
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'youtube' => $request->youtube,
            'address_link' => $request->address_link,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'instagram' => $request->instagram,
            'about_me' => $request->about_me,
            'experience' => $request->experience,
            'education' => $request->education,
            'languages_skills' => $request->languages_skills,
            'coding_skills' => $request->coding_skills,
            'knowledge' => $request->knowledge,
            'my_services' => $request->my_services,
        ]);

        return response()->json([
            'message' => 'Social Modia Link Updated',
        ])->setStatusCode(200);
    }
}
