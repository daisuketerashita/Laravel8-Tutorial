<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

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

    //タスクの登録処理
    public function create(int $id,CreateTask $request){
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index',[
            'id' => $current_folder->id,
        ]);
    }

    //タスク編集画面の表示
    public function showEditForm(int $id,int $task_id){
        $task = Task::find($task_id);

        return view('tasks.edit',[
            'task' => $task,
        ]);
    }

    //タスクの編集処理
    public function edit(int $id, int $task_id, EditTask $request){
        //リクエストされた ID でタスクデータを取得（編集対象）
        $task = Task::find($task_id);

        //入力でーたの代入
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        //リダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
