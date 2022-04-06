<?php

namespace App\Http\Controllers;
use App\Models\Cobranza;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CobranzaController extends Controller
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
        return Cobranza::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('trabajo_realizado_fk');
        $validator = Validator::make($data, [
            'trabajo_realizado_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $cobranza = Cobranza::create([
            '$trabajo_realizado_fk' => $request->$trabajo_realizado_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $cobranza
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $cobranza = Cobranza::find($id);
        if (!$cobranza) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $cobranza;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('$trabajo_realizado_fk');
        $validator = Validator::make($data, [
            '$trabajo_realizado_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $cobranza = Cobranza::findOrfail($id);
        $cobranza->update([
            'trabajo_realizado_fk' => $request->trabajo_realizado_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $cobranza
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $cobranza = Cobranza::findOrfail($id);
        $cobranza->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}