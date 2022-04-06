<?php

namespace App\Http\Controllers;
use App\Models\Factura;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
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
        return Factura::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('cobranza_fk','cliente');
        $validator = Validator::make($data, [
            'cobranza_fk' => 'required|max:255|string',
            'cliente' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $factura = Factura::create([
            '$cobranza_fk' => $request->$cobranza_fk,
            'cliente' => $request->cliente,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $factura
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $factura;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('$cobranza_fk','cliente');
        $validator = Validator::make($data, [
            '$cobranza_fk' => 'required|max:255|string',
            'cliente' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $factura = Factura::findOrfail($id);
        $factura->update([
            'cobranza_fk' => $request->cobranza_fk,
            'cliente' => $request->cliente,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $factura
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $factura = Factura::findOrfail($id);
        $factura->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}