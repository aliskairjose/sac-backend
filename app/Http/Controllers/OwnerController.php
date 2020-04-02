<?php

namespace App\Http\Controllers;

use App\Http\Resources\OwnerCollection;
use App\Owner;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = new OwnerCollection(Owner::all());
        } catch (Exception $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'message'   => 'Ha ocurrido un error',
                    'status'    => 400,
                    'error'     => $e->getMessage()
                ]
            );
        }

        return response()->json(
            [
                'isSuccess' => true,
                'status'    => 200,
                'objects'   => $data,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $path = '';

            $user = User::create(
                [
                    "name"          => $request->name . ' ' . $request->surname,
                    "email"         => $request->email,
                    'password'      => Hash::make($request->cedula),
                    'role_id'       => 2,
                    'building_id'   => $request->building_id
                ]
            );

            if ($request->hasFile('photo')) {
                $path = $request->photo->store('public/images/onwer/' . $request->cedula);
            }

            $owner = Owner::create(
                [
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'cedula' => $request->cedula,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'floor' => $request->floor,
                    'apartment' => $request->apartment,
                    'parking_lot' => $request->parking_lot,
                    'main' => false,
                    'building_id' => $request->building_id,
                    'user_id' => $user->id,
                    'photo' => $path,
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'message'   => 'Ha ocurrido un error',
                    'status'    => 400,
                    'error'     => $e->getMessage()
                ]
            );
        }
        return response()->json(
            [
                'isSuccess' => true,
                'status'    => 200,
                'message'   => 'Nuevo propietario registrado',
                'objects'   => $owner,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
