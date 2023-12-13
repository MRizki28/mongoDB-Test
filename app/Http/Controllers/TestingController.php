<?php

namespace App\Http\Controllers;

use App\Models\TestingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestingController extends Controller
{
    public function getAllData()
    {
        $data = TestingModel::all();
        return response()->json([
            'message' => 'success ni',
            'data' => $data
        ]);
    }

    public function createData(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'name' => 'required',
            'alamat' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ]);
        }
        try {
            $data = new TestingModel;
            $data->name = $request->input('name');
            $data->alamat = $request->input('alamat');
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' =>' failed'
            ]);
        }

        return response()->json([
            'message' => 'success create data' ,
            'data' => $data
        ]);
        
        
    }
}
