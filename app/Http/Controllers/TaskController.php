<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/**
 * タスク管理に関するコントローラ.
 * タスクの追加, 一覧, 更新, 削除などを行う.
 */
class TaskController extends Controller {
    /**
     * タスクを追加する.
     */
    public function add (Request $request) {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first();
        if (!isset($user_id)) return response('Not Found', 404);

        // 登録処理
        DB::table('tasks')->insert([
            'task_id' => uniqid(),
            'name' => $request->name,
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
    public function list (Request $request) {

    }

    /**
     * タスクを更新する.
     */
    public function update (Request $request) {

    }

    /**
     * タスクを削除する.
     */
    public function delete (Request $request) {

    }
}
