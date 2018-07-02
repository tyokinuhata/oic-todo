<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function me (Request $request)
    {
        // トークンに対応するユーザ情報の取得
        $user = User::where('token', $request->token)->first();
        if (!isset($user)) {
            return response('Not Found', 404);
        }

        return $user;
    }
}
