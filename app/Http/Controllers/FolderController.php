<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    //新規作成画面の表示
    public function showCreateForm(){
        return view('folders.create');
    }

    //新規フォルダ登録処理
    public function create(CreateFolder $request){
        //インスタンスの生成
        $folder = new Folder();
        //タイトルに入力値を代入
        $folder->title = $request->title;
        //データベースに書き込む
        $folder->save();

        //リダイレクト
        return redirect()->route('tasks.index',['id' => $folder->id]);
    }
}
