<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

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
        //ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);

        //リダイレクト
        return redirect()->route('tasks.index',['id' => $folder->id]);
    }
}
