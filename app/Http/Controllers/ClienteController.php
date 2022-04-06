<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
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
        return Cliente::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('nombre','numero_tel','correo');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'numero_tel'=> 'required|max:255|string',
            'correo'=> 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'numero_tel' => $request->numero_tel,
            'correo' => $request->correo,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $cliente
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $cliente;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nombre','numero_tel','correo');
        $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'numero_tel'=> 'required|max:255|string',
            'correo'=> 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre' => $request->nombre,
            'numero_tel' => $request->numero_tel,
            'correo' => $request->correo,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $cliente
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrfail($id);
        $cliente->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
