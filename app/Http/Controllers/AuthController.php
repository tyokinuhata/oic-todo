<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/**
 * 認証に関するコントローラ.
 * サインイン, サインアップなどの制御を行う.
 */
class AuthController extends Controller {
    /**
     * ユーザID, パスワード, パスワード(確認)を取得する.
     * 登録可能であれば登録して成功したことを通知し, 登録不可能であれば登録せずにエラーを返す.
     */
    public function register(Request $request) {
        // 入力されたパスワードとパスワード(確認)が正しいかどうか
        if ($request->password === $request->confirmPassword) return response('Conflict', 409);

        // まだ使用されていないユーザIDかどうか
        $exist = User::where('user_id', $request->userId)->first();
        if ($exist) return response('Authorized', 401);

        return response('OK', 200);
    }

    public function token (Request $request) {

    }

    public function destroy (Request $request) {

    }
}
