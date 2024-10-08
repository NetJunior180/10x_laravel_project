<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Asegúrate de que el modelo Product esté importado

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         // Obtener todos los productos
         $products = Product::all();
         return response()->json($products); // Devolverlos como JSON (o puedes devolver una vista)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         // Validar los datos del producto
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo producto
        $product = Product::create($validatedData);

        // Retornar respuesta
        return response()->json($product, 201); // 201 Created
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
        // Obtener el producto por ID
        $product = Product::findOrFail($id);
        return response()->json($product); // Devolverlo como JSON
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
        // Validar los datos del producto
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Encontrar el producto y actualizarlo
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Retornar respuesta
        return response()->json($product); // Devolver el producto actualizado

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
        // Encontrar el producto y eliminarlo
        $product = Product::findOrFail($id);
        $product->delete();

        // Retornar respuesta
        return response()->json(null, 204); // 204 No Content
    }
}
