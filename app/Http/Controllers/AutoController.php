<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Auto;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AutoController extends Controller
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
        return Auto::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('modelo','año','matricula','dueño_fk');
        $validator = Validator::make($data, [
            'modelo' => 'required|max:255|string',
            'año' => 'required|max:255|string',
            'matricula' => 'required|max:255|string',
            'dueño_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $auto = Auto::create([
            'modelo' => $request->modelo,
            'año' => $request->año,
            'matricula' => $request->matricula,
            'dueño_fk' => $request->dueño_fk,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $auto
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $auto = Auto::find($id);
        if (!$auto) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $auto;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('modelo','año','matricula','dueño_fk');
        $validator = Validator::make($data, [
            'modelo' => 'required|max:255|string',
            'año' => 'required|max:255|string',
            'matricula' => 'required|max:255|string',
            'dueño_fk' => 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $auto = Auto::findOrfail($id);
        $auto->update([
            'nombre' => $request->nombre,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $auto
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $auto = Auto::findOrfail($id);
        $auto->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}