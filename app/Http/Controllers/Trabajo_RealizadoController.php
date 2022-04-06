<?php

namespace App\Http\Controllers;
use App\Models\Trabajo_Realizado;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class Trabajo_RealizadoController extends Controller
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
        return Trabajo_Realizado::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('fecha_inicio','carro','dueño','mecanico','fecha_termino','mano_obra');
        $validator = Validator::make($data, [
            'fecha_inicio' => 'required|max:255|string',
            'carro' => 'required|max:255|string',
            'dueño' => 'required|max:255|string',
            'mecanico' => 'required|max:255|string',
            'fecha_termino' => 'required|max:255|string',
            'mano_obra' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $trabajo = Trabajo_Realizado::create([
            'fecha_inicio' => $request->fecha_inicio,
            'carro' => $request->carro,
            'dueño' => $request->dueño,
            'mecanico' => $request->mecanico,
            'fecha_termino' => $request->fecha_termino,
            'mano_obra'=> $request->mano_obra,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $trabajo
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $trabajo = Trabajo_Realizado::find($id);
        if (!$trabajo) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $trabajo;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('fecha_inicio','carro','dueño','mecanico','fecha_termino','mano_obra');
        $validator = Validator::make($data, [
            'fecha_inicio' => 'required|max:255|string',
            'carro' => 'required|max:255|string',
            'dueño' => 'required|max:255|string',
            'mecanico' => 'required|max:255|string',
            'fecha_termino' => 'required|max:255|string',
            'mano_obra' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $trabajo = Trabajo_Realizado::findOrfail($id);
        $trabajo->update([
            'fecha_inicio' => $request->fecha_inicio,
            'carro' => $request->carro,
            'dueño' => $request->dueño,
            'mecanico' => $request->mecanico,
            'fecha_termino' => $request->fecha_termino,
            'mano_obra'=> $request->mano_obra,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $trabajo
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $trabajo = Trabajo_Realizado::findOrfail($id);
        $trabajo->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}