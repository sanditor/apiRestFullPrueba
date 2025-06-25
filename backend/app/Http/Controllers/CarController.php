<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function index()
    {
        return response()->json(Car::all());
    }

    public function show($id)
    {
        return response()->json(Car::find($id));
    }

    public function store(Request $request)
    {
        $producto = Car::create($request->all());
        return response()->json($producto, 201);
    }

    public function update(Request $request, $id)
    {
        $producto = Car::findOrFail($id);
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
