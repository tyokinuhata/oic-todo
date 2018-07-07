<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Task;

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
        Task::create([
            'task_id' => uniqid(),
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
            'score' => 0,
            'user_id' => $user_id,
            'reopen_at' => Carbon::now()
        ]);

        return response('OK', 200);
    }

    /**
     * 完了タスク一覧を取得する
     */
    public function complete(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // タスクの取得
        $tasks = Task::where('user_id', $user_id)->where('completed', true)->latest('closed_at')->get();

        return response($tasks, '200');
    }

    /**
     * 未完了タスク一覧を取得する
     */
    public function incomplete(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // タスクの取得
        $tasks = Task::where('user_id', $user_id)->where('completed', false)->latest('reopen_at')->get();

        // 現在獲得可能なスコアの計算
        foreach ($tasks as $task) {
            $diff = Carbon::now()->diffInDays(Carbon::parse($task->reopen_at));

            if ($diff <= 1) $score = 100;
            else if ($diff <= 3) $score = 70;
            else if ($diff <= 7) $score = 30;
            else if ($diff <= 30) $score = -30;
            else $score = -100;

            $task->acceptable_score = $score;
        }

        return response($tasks, '200');
    }

    /**
     * タスクを更新する.
     */
    public function update(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // 更新処理
        Task::where('task_id', $request->task_id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response('OK', 200);
    }

    /**
     * タスクを削除する.
     */
    public function delete(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // トータルスコアの再計算
        $score = Task::select('score')->where('task_id', $request->task_id)->first()->score;
        User::where('token', $request->token)->decrement('total_score', $score);

        // 削除処理
        $task = Task::where('task_id', $request->task_id)->first();
        $task->delete();

        return response('OK', 200);
    }

    /**
     * タスクを完了する.
     */
    public function close(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // 現在時刻とタスク生成時刻の差分
        $created_at = Task::select('reopen_at')->where('task_id', $request->task_id)->first()->reopen_at;
        $diff = Carbon::now()->diffInDays(Carbon::parse($created_at));

        // スコアの計算
        if ($diff <= 1) $score = 100;
        else if ($diff <= 3) $score = 70;
        else if ($diff <= 7) $score = 30;
        else if ($diff <= 30) $score = -30;
        else $score = -100;

        // ボーナスポイントの計算
        $bonus = mt_rand(-20, 20);
        $score += $bonus;

        // 更新処理
        Task::where('task_id', $request->task_id)->update([
            'completed' => true,
            'closed_at' => Carbon::now(),
            'score' => $score
        ]);
        User::where('token', $request->token)->increment('total_score', $score);

        return response('OK', 200);
    }

    /**
     * タスクを再度未完了状態にする
     */
    public function reopen(Request $request)
    {
        // トークンに対応するユーザIDの取得
        $user_id = User::select('user_id')->where('token', $request->token)->first()->user_id;
        if (!isset($user_id)) {
            return response('Not Found', 404);
        }

        // スコアの取得
        $score = Task::select('score')->where('task_id', $request->task_id)->first()->score;

        // 更新処理
        Task::where('task_id', $request->task_id)->update([
            'completed' => false,
            'reopen_at' => Carbon::now(),
            'score' => 0
        ]);
        User::where('token', $request->token)->decrement('total_score', $score);

        return response('OK', 200);
    }
}
