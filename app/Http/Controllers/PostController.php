<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


/**
 * Post一覧を表示する
 * 
 * @param Post Postモデル
 * @return array Postモデルリスト
 */
 
class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
        {
            return view('posts.index')->with(['posts' => $post->getByLimit()]);
             //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
             //getbylimitでデータ取得数を制限出来るようにしている。
        }
}
