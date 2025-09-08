<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    //コレクションの説明
    //なぜここでコレクションを使っているか
    //コレクションについてもう少し詳しく。
    //配列操作に特化したクラス　とか　メソッドチェーンが使えるとは思うけど。
    //Collectionはクラスを入れられる。 配列はクラスを入れられない

    public function index()
    {
        $todos = $this->todo->all();
        //dd($todos);
        return view('todo.index', ['todos' => $todos]);
    }

    //view関数について
    //view関数は画面に表示したいbladeファイルを第一引数で指定し、第二引数に渡したいデータを連想配列の形で渡すことができます。

    public function create()
    {
        // TODO: 第1引数を指定
        return view('todo.create'); // 追記
    }

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();

        $this->todo->fill($inputs); // 変更
        $this->todo->save();

        return redirect()->route('todo.index');
    }
    //redirect()はredirectorクラスのインスタンスが返ってくる。それのrouteメソッドを呼び出している

    public function show($id)
    {
        $todo = $this->todo->find($id);
        //dd($todo->content);
        return view('todo.show', ['todo' => $todo]);
    }

    // TODO: ルートパラメータを引数に受け取る
    public function edit($id)
    {
        $todo = $this->todo->find($id);
        
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id) // 第1引数: リクエスト情報の取得　第2引数: ルートパラメータの取得
    {
        // TODO: リクエストされた値を取得
        $inputs = $request->all();  //返り値＝＞連想配列
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();
        
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}
