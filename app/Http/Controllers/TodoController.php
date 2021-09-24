<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Repositories\TodoRepository;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function index()
    {
        return $this->todoRepository->all();
    }

    public function show($id)
    {
        $todo = $this->todoRepository->get($id);
        return response()->json($todo);
    }

    public function store(Request $request)
    {
        try {
            $todo = $this->todoRepository->create($request->only('name','user_id'));
            return response()->json($todo);
        } catch (\Throwable $th) {
            return  response()->json($th->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $todo = $this->todoRepository->update($request->all(),$id);
            return response()->json($todo);
        } catch (\Throwable $th) {
            return  response()->json(500,$th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $todo = $this->todoRepository->get($id);
            if($todo){
                return $this->todoRepository->delete($id);
            }
        } catch (\Throwable $th) {
            return  response()->json($th->getMessage());
        }
    }
}
