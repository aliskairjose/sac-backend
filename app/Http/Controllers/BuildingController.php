<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingCollection;
use App\Building;
use App\Http\Resources\Building as ResourcesBuilding;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = new BuildingCollection(Building::all());
        return response()->json(
            [
                'isSuccess' => true,
                'status'    => 200,
                'objects'   => $data,
                'counts'    => $data->count()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = Building::create($request->all());
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
                'message'   => 'La residencia se ha sido creada con exito!.',
                'status'    => 200,
                'objects'   => $data,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {

            $data = new ResourcesBuilding(Building::findOrFail($id));
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
                'objects'   => $data,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Building::findOrFail($id)->update($request->all());
        } catch (\Exception $e) {
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
                'message'   => 'La residencia se ha actualizada con exito!.',
                'objects'   => $data
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $data = Building::findOrFail($id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'status'    => 400,
                    'message'   => 'No hubo coincidencia en la busqueda!.',
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
                'message'   => 'La residencia ha sido eliminada!.',
            ]
        );
    }
}
