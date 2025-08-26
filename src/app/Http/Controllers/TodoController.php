<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        //dd('Hello World!');
        $todos = $todo->all();
        //dd($todos);<=ここまではOK
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        // TODO: 第1引数を指定
        return view('todo.create'); // 追記
    }
}
