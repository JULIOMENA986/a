<?php

namespace App\Http\Controllers;
use App\Models\Inventario;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class InventarioController extends Controller
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
        return Inventario::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('refacciones_fk','taller');
        $validator = Validator::make($data, [
            'refacciones_fk' => 'required|max:255|string',
            'taller' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $inventario = Inventario::create([
            '$refacciones_fk' => $request->$refacciones_fk,
            'taller' => $request->taller,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $inventario
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $inventario = Inventario::find($id);
        if (!$inventario) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $inventario;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('$refacciones_fk','taller');
        $validator = Validator::make($data, [
            '$refacciones_fk' => 'required|max:255|string',
            'taller' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $inventario = Inventario::findOrfail($id);
        $inventario->update([
            'refacciones_fk' => $request->refacciones_fk,
            'taller' => $request->taller,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $inventario
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $inventario = Inventario::findOrfail($id);
        $inventario->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}