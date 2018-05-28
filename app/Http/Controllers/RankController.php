<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        DB::table('users')->orderBy('total_score', 'desc')->take(10)->get();
    }
}
