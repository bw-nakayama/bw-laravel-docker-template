<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $this->todo->all();
        //dd($todos);<=ここまではOK
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        // TODO: 第1引数を指定
        return view('todo.create'); // 追記
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $this->todo->fill($inputs); // 変更
        $this->todo->save();

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.show', ['todo' => $todo]);
    }
}
