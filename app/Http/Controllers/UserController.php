<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() {
        $data = new UserCollection( User::all() );
        return response()->json(
            [
                'count'     => $data->count(),
                'isSuccess' => true,
                'data'      => $data
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store( Request $request ) {

        $user = new UserResource( User::updateOrCreate(
            [ 'cedula' => $request->cedula ],
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

        return response()->json(
            [
                'isSuccess' => true,
                'data'      => $user,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show( $id ) {
        try {
            $data = new UserResource( ( USer::findOrFail( $id ) ) );
        }
        catch ( \Exception $e ) {
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
                'data'      => $data,
            ]
        );
    }

    /**
     * Display the specified resource by cedula
     *
     * @param string $cedula
     * @return
     */
    public function showByCedula( $id ) {
        try {
            $data = new UserResource( ( User::where( 'cedula', $id ) )->firstOrFail() );
        }
        catch ( ModelNotFoundException $e ) {
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
                'data'      => $data
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
    public function update( Request $request, $id ) {

        $user = User::find( $id );

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->cedula = $request->cedula;
        $user->phone = $request->phone;
        $user->id_residency = $request->id_residency;
        $user->floor = $request->floor;
        $user->apartment = $request->apartment;
        $user->parking_lot = $request->parking_lot;
        $user->password = bcrypt( $request->password );
        $user->is_mb = $request->is_mb;
        $user->save();

        return response()->json(
            [
                'isSuccess' => true,
                'data'      => $user,
                'errorInfo' => null
            ]
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete( $id ) {
        $user = User::findOrFail( $id );
        $user->delete();

        return response()->json(
            [
                'isSuccess' => true,
            ]
        );
    }
}
