<?php

namespace App\Http\Controllers;
use App\Models\Tipo_Trabajo;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class Tipo_TrabajoController extends Controller
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
        return Tipo_Trabajo::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('nombre','descripcion');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'descripcion' => 'required|max:255|string',
            
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $tipo = Tipo_Trabajo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $tipo
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $tipo = Tipo_Trabajo::find($id);
        if (!$tipo) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $tipo;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nombre','descripcion');
        $validator = Validator::make($data, [
            'nombre' => 'requires|max:255|string',
            'descripcion' => 'requires|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $tipo = Tipo_Trabajo::findOrfail($id);
        $tipo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $tipo
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $tipo = Tipo_Trabajo::findOrfail($id);
        $tipo->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}