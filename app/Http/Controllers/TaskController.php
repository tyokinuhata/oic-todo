<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

/**
 * タスク管理に関するコントローラ.
 * タスクの追加, 一覧, 更新, 削除などを行う.
 */
class TaskController extends Controller
{
    /**
     * タスクを追加する.
     */
    public function add(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // 登録処理
        DB::table('tasks')->insert([
            'task_id' => uniqid(),
            'title' => $request->title,
            'description' => $request->description,
            'state' => 'incomplete',
            'score' => 0,
            'user_id' => $user_id
        ]);

        return response('OK', 200);
    }

    /**
     * タスク一覧を取得する.
     */
    public function list(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first();
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // タスクの取得
        $tasks = DB::select('tasks')->where('user_id', $user_id)->get();

        return response($tasks, '200');
    }

    /**
     * タスクを更新する.
     */
    public function update(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first();
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // 更新処理
        Task::where('task_id', $request->task_id)->update([
            'title' => $request->name,
            'description' => $request->description,
            'state' => $request->state,
            'score' => $request->score,
        ]);

        return response('OK', 200);
    }

    /**
     * タスクを削除する.
     */
    public function delete(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first();
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // 削除処理
        $task = Task::where('task_id', $request->task_id)->first();
        $task->delete();

        return response('OK', 200);
    }
}
