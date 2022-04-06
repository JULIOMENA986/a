<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Taller;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class TallerController extends Controller
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
        return Taller::get();
    }

    public function store(Request $request)
    {
        $data = $request->only('sucursal','direccion');
        $validator = Validator::make($data, [
            'sucursal' => 'required|max:255|string',
            'direccion'=> 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $taller = Taller::create([
            'sucursal' => $request->sucursal,
            'direccion' => $request->direccion,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $taller
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $taller = Taller::find($id);
        if (!$taller) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        
        return $taller;
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('sucursal','direccion');
        $validator = Validator::make($data, [
            'sucursal' => 'required|max:255|string',
            'direccion'=> 'required|max:255|string',
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }
        $taller = Taller::findOrFail($id);
        $taller->update([
            'sucursal' => $request->sucursal,
            'direccion' => $request->direccion,
        ]);
        return response()->json([
            'message' => 'Product created',
            'data' => $taller
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $taller = Taller::findOrfail($id);
        $taller->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
