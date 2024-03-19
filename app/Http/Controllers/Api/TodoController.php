<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        if ($todos->count() > 0) {
            return response()->json([
                'status' => 200,
                'todos' => $todos
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No todos found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'todo' => 'required|string|max:255' // Adjust max length as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $todo = Todo::create([
                'todo' => $request->todo,
            ]);

            if ($todo) {
                return response()->json([
                    'status' => 200,
                    'message' => "Todo created successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }
    public function destroy(int $id)
    {
        $todo = Todo::find($id);
    
        if ($todo) {
            $todo->delete();
            return response()->json([
                'status' => 200,
                'message' => "Todo deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such todo found'
            ], 404);
        }
    }
    
}
