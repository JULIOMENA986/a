<?php

namespace App\Http\Controllers;
use App\Models\Traslado;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class TrasladoController extends Controller
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
        return Traslado::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('refaccion_fk','inicio','destino','fecha_entrega');
        $validator = Validator::make($data, [
            'refaccion_fk' => 'required|max:255|string',
            'inicio' => 'required|max:255|string',
            'destino' => 'required|max:255|string',
            'fecha_entrega' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $traslado = Traslado::create([
            'refaccion_fk' => $request->refaccion_fk,
            'inicio' => $request->inicio,
            'destino' => $request->destino,
            'fecha_entrega' => $request->fecha_entrega,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $traslado
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $traslado = Traslado::find($id);
        if (!$traslado) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $traslado;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('refaccion_fk','inicio','destino','fecha_entrega');
        $validator = Validator::make($data, [
            'refaccion_fk' => 'required|max:255|string',
            'inicio' => 'required|max:255|string',
            'destino' => 'required|max:255|string',
            'fecha_entrega' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $traslado = Traslado::findOrfail($id);
        $traslado->update([
            'refaccion_fk' => $request->refaccion_fk,
            'inicio' => $request->inicio,
            'destino' => $request->destino,
            'fecha_entrega' => $request->fecha_entrega,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $traslado
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $traslado = Traslado::findOrfail($id);
        $traslado->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}