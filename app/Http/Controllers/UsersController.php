<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' =>'List Semua User',
            'data'    => $users
        ], 200);
    }

    public function show($id)
    {
        $users = User::find($id);

        if ($users) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail User!',
                'data'      => $users
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'username' => 'required|string|max:40',
            'password' => 'required|string|max:120',
            'email' => 'required|email|max:50',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:120',
            'active' => 'required|integer',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $users = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'birth_date' => Carbon::parse($request->birth_date),
                'address' => $request->address,
                'active' => $request->active,
            ]);

            if ($users) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Disimpan!',
                    'data' => $users
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Disimpan!',
                ], 400);
            }

        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'username' => 'required|string|max:40',
            'password' => 'required|string|max:120',
            'email' => 'required|email|max:50',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:120',
            'active' => 'required|integer',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);

        } else {

            $users = User::whereId($id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'birth_date' => Carbon::parse($request->birth_date),
                'address' => $request->address,
                'active' => $request->active,
            ]);

            if ($users) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Diupdate!',
                    'data' => $users
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Diupdate!',
                ], 400);
            }

        }
    }
}