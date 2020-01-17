<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = new UserCollection(User::all());
        return response()->json(
            [
                'isSuccess' => true,
                'count'     => $data->count(),
                'status'    => 200,
                'object'    => $data,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        try {
            $data = User::create($request->all());
        } catch (\Exception $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'message'   => 'Ha ocurrido un error',
                    'status'    => 400,
                ]
            );
        }

        return response()->json(
            [
                'isSuccess' => true,
                'message'   => 'El usuario ha sido creado con exito!.',
                'status'    => 200,
                'data'      => $data,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $data = new UserResource((User::findOrFail($id)));
        } catch (\Exception $e) {
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
                'objects'    => $data,
            ]
        );
    }

    /**
     * Display the specified resource by cedula
     *
     * @param string $cedula
     * @return
     */
    public function showByCedula($id)
    {
        try {
            $data = new UserCollection((User::where('cedula', $id))->get());
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'errorInfo' => $e,
                ]
            );
        }

        return response()->json(
            [
                'isSuccess' => true,
                'objects'   => $data
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {

        try {
           /*  $data = User::findOrFail($id);
            $data->update($request->all()); */
            $user = new UserResource( User::updateOrCreate(
                [ 'id' => $request->id ],
                [
                    'name'         => $request->name,
                    'surname'      => $request->surname,
                    'cedula'       => $request->cedula,
                    'phone'        => $request->phone,
                    'email'        => $request->email,
                    'id_residency' => $request->id_residency,
                    'floor'        => $request->floor,
                    'apartment'    => $request->apartment,
                    'parking_lot'  => $request->parking_lot,
                    'password'     => bcrypt( $request->password ),
                    'is_mb'        => $request->is_mb
                ]
            ) );
        } catch (\Exception $e) {
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
                'message'   => 'EL usuario se ha actualizado con exito!.',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $data = User::find($id);
            $data->delete();
        } catch (\Exception $e) {
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
                'message'   => 'El usuario ha sido eliminado!.',
                'status'    => 200,
            ]
        );
    }
}
