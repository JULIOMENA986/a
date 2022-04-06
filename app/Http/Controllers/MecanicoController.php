<?php

namespace App\Http\Controllers;
use App\Models\Mecanico;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class MecanicoController extends Controller
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
        return Mecanico::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('nombre','taller_fk');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'taller_fk' => 'required|max:255|string',
            
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $mecanico = Mecanico::create([
            'nombre' => $request->nombre,
            'taller_fk' => $request->taller_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $mecanico
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $mecanico = Mecanico::find($id);
        if (!$mecanico) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $mecanico;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nombre','taller_fk');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'taller_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $mecanico = Mecanico::findOrfail($id);
        $mecanico->update([
            'nombre' => $request->nombre,
            'taller_fk' => $request->taller_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $mecanico
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $mecanico = Mecanico::findOrfail($id);
        $mecanico->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}