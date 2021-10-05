<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task;

class TaskController extends Controller
{
    //一覧画面の表示
    public function index(int $id){
        //全てのフォルダを取得する
        $folders = Folder::all();

        //選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        //選ばれたフォルダに紐づくタスクを取得する
        $tasks = $current_folder->tasks()->get();

        return view('tasks.index',[
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }

    //タスク作成画面の表示
    public function showCreateForm(int $id){
        return view('tasks.create',['folder_id' => $id]);
    }
}
