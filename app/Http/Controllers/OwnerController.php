<?php

namespace App\Http\Controllers;

use App\Http\Resources\OwnerCollection;
use App\Imports\Owner as ImportsOwner;
use App\Owner;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
                    'role_id'       => 3,
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

    public function uploadPhoto(Request $request, $id)
    {
        try {
            if ($request->hasFile('photo')) {

                $path = $request->photo->store('public/images/profile/' . $id);
                $data = Owner::findOrFail($id);
                $data->photo = $path;
                $data->save();
            } else {
                return response()->json(
                    [
                        'isSuccess' => false,
                        'status'    => 400,
                        'message'   => 'Error',
                    ]
                );
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'status'    => 400,
                    'message'   => $e->getMessage(),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'status'    => 400,
                    'message'   => $e->getMessage(),
                ]
            );
        }

        return response()->json(
            [
                'isSuccess' => true,
                'status'    => 200,
                'message'   => 'Imagen actualizada con exito',
                'objects'   => $data
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userId($id)
    {
        try {
            $owner = Owner::getbyuser($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'isSuccess' => true,
                    'message'   => 'No se encontro registro',
                    'status'    => 200,
                    'error'     => $e->getMessage()
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
                'status' => 200,
                'objects' => $owner
            ]
        );
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

        try {
            $owner = Owner::findOrFail($id);

            $owner->name = $request->name;
            $owner->surname = $request->surname;
            $owner->email = $request->email;
            $owner->phone = $request->phone;
            $owner->cedula = $request->cedula;
            $owner->floor = $request->floor;
            $owner->apartment = $request->apartment;
            $owner->parking_lot = $request->parking_lot;

            if ($request->hasFile('photo')) {
                $path = $request->photo->store('public/images/onwer/' . $request->cedula);
                $owner->photo = $path;
            }

            $owner->save();
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
                'message'   => 'Registro actualizado!',
            ]
        );
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

    /**
     * Importacion de propietarios por excel
     */
    public function import(Request $request)
    {
        return response()->json(
            [
                'isSuccess' => true,
                'status' => 200,
                'objects' => $request->all()
            ]
        );

        try {
            Excel::import(new ImportsOwner, request()->file('file'));
        } catch (Exception $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'status'    => 400,
                    'message'   => $e,
                ]
            );
        }
        return response()->json(
            [
                'isSuccess' => true,
                'status'    => 200,
            ]
        );
    }
}
