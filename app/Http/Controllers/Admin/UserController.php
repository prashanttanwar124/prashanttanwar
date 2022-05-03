<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  User::orderBy('id', 'asc')->get();
        return $data;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);



        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'message' => 'User Stored',
        ])->setStatusCode(200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            // 'password' => ['required', 'string', 'min:8'],
        ]);



        User::where('id', $id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            // 'password' => Hash::make($request['password']),
        ]);
        return response()->json([
            'message' => 'User Updated',
        ])->setStatusCode(200);
    }


    public function destroy(Request $request, $id)
    {
        User::where('id', $id)->delete();

        return response()->json([
            'message' => 'User Deleted',
        ])->setStatusCode(200);
    }
}
