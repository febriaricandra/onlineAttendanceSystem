<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //

    public function index()
    {
        $users = User::paginate(5);
        return response()->json([
            'success' => true,
            'message' => 'Daftar data user',
            'data' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data user',
            'data' => $user
        ], 200);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'nra' => $request->nra,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'password' => $request->password,
            'role' => "user",
        ]);

        if($user)
        {
            return response()->json([
                'success' => true,
                'message' => 'user berhasil di tambahkan',
                'data' => $user
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'user gagal di tambahkan',
                'data' => $user
            ], 409);
        }
    }
    
    public function update(Request $request, User $user)
    {
        $update = $user->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => $request->password,
            'role' => "user",
        ]);

        if($update)
        {
            return response()->json([
                'success' => true,
                'message' => 'user berhasil di update',
                'data' => $user
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'user gagal di update',
                'data' => $user
            ], 409);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'user berhasil di hapus',
            'data' => $user
        ], 200);
    }
}
