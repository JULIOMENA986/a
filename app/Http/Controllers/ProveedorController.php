<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
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
        return Proveedores::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('nombre');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $proveedor = Proveedores::create([
            'nombre' => $request->nombre,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $proveedor
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $proveedor = Proveedores::find($id);
        if (!$proveedor) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $proveedor;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nombre');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $proveedor = Proveedores::findOrfail($id);
        $proveedor->update([
            'nombre' => $request->nombre,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $product
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $proveedor = Proveedores::findOrfail($id);
        $proveedor->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}