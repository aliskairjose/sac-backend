<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResidencyCollection;
use App\Residency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Residency as ResidencyResource;


class ResidencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = new ResidencyCollection(Residency::all());
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
    public function store(Request $request)
    {
        $residency = new ResidencyResource(Residency::updateOrCreate(
            ['email' => $request->email],
            [
                'name'       => $request->name,
                'state'      => $request->state,
                'providence' => $request->providence,
                'address'    => $request->address,
                'floors'     => $request->floors,
                'apartments' => $request->apartments,
                'rif'        => $request->rif,
                'id_contact' => $request->id_contact
            ]
        ));

        return response()->json(
            [
                'isSuccess' => true,
                'data'      => $residency,
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
            $data = new ResidencyResource((Residency::findOrFail($id)));
        } catch (\Exception $e) {
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $residency = Residency::find($id);

        $residency->name = $request->name;
        $residency->state = $request->state;
        $residency->providence = $request->providence;
        $residency->address = $request->address;
        $residency->floors = $request->floors;
        $residency->apartments = $request->apartments;
        $residency->rif = $request->rif;
        $residency->id_contact = $request->id_contact;
        $residency->save();
        return response()->json(
            [
                'isSuccess' => true,
                'data'      => $residency,
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
    public function delete($id)
    {
        $user = Residency::findOrFail($id);
        $user->delete();

        return response()->json(
            [
                'isSuccess' => true,
            ]
        );
    }
}
