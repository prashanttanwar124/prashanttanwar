<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::orderBy('id', 'desc')->get();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::where('id', $id)->delete();

        return response()->json([
            'message' => 'Contact Form Delete',
        ])->setStatusCode(200);
    }
}
