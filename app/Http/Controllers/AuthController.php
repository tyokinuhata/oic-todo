<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

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
        if ($request->password === $request->confirm_password) return response('Conflict', 409);

        // まだ使用されていないユーザIDかどうか
        $exist = User::where('user_id', $request->user_id)->first();
        if ($exist) return response('Authorized', 401);

        // 登録処理
        DB::table('users')->insert([
            'user_id' => $request->user_id,
            'password' => password_hash($request->password, PASSWORD_DEFAULT)
        ]);

        $token = password_hash(strval(time()) + $request->user_id + $request->password, PASSWORD_DEFAULT);
        User::where('user_id', $request->user_id)->where('password', password_hash($request->password, PASSWORD_DEFAULT))->update([ 'token' => $token ]);
        return response('OK', 200);
    }

    /**
     * ユーザID, パスワードを取得する.
     * ユーザIDとパスワードが正しければトークンを返し, サインインする.
     * 正しくなければトークンを返さず, エラーを返す.
     */
    public function token (Request $request) {
        // 入力されたユーザIDとパスワードが正しいかどうか
        $exist = User::where('user_id', $request->user_id)->where('password', $request->password)->first();
        if ($exist) {
            $token = password_hash(strval(time()) + $request->user_id + $request->password, PASSWORD_DEFAULT);
            User::where('user_id', $request->user_id)->where('password', password_hash($request->password, PASSWORD_DEFAULT))->update([ 'token' => $token ]);
            return response($token, 200);
        } else {
            return response('Authorized', 401);
        }
    }

    /**
     * アクセストークンを取得し, 該当するアクセストークンをDBから削除し, サインアウトする.
     * 成功すれば成功したことを通知し, 失敗すればエラーを返す.
     */
    public function destroy (Request $request) {
        $exist = User::where('token', $request->token)->first();
        if ($exist) {
            User::where('token', $request->token)->update([ 'token' => null ]);
            return response('OK', 200);
        } else {
            return response('Bad Request', 400);
        }
    }
}
