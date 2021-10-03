<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class TaskController extends Controller
{
    //一覧画面の表示
    public function index(){
        $folders = Folder::all();

        return view('tasks.index',['folders' => $folders]);
    }
}
