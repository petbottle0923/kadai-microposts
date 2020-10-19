<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function show_favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $favorites = $user->my_favorite()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
        ]);
    }
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのポストをお気に入りする
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのポストをお気に入りから外する
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    
}