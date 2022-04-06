<?php

namespace App\Http\Controllers;
use App\Models\Refacciones;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class RefaccionesController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $token = $request->header('Authorization');
        if($token != '')
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return Refacciones::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('nombre','stock','proveedor_fk');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'stock' => 'required|max:255|string',
            'proveedor_fk' => 'required|max:255|string',
            
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $refaccion = Refacciones::create([
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'proveedor_fk' => $request->proveedor_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $refaccion
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $refaccion = Refacciones::find($id);
        if (!$refaccion) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $refaccion;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nombre','stock','proveedor_fk');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'stock' => 'required|max:255|string',
            'proveedor_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $refaccion = Refacciones::findOrfail($id);
        $refaccion->update([
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'proveedor_fk' => $request->proveedor_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $refaccion
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $refaccion = Refacciones::findOrfail($id);
        $refaccion->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}