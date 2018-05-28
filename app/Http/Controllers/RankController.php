<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/**
 * ランキングに関するコントローラ.
 * ランキングの取得などを行う.
 */
class RankController extends Controller
{
    /**
     * 全ユーザ中の上位10位までのスコアを返す.
     */
    public function list() {
        return User::orderBy('total_score', 'desc')->take(100)->get();
    }
}
