<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

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
        
            /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
    public function show(Post $post)
        {
            return view('posts.show')->with(['post' => $post]);
         //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
        }
        
    public function create()
        {
            return view('posts.create');
        }
        
    public function store(Request $request, Post $post)
        {
            $input = $request['post'];
            // $input['user_id'] = Auth::id(); // ログインユーザーのIDを取得して代入
            $post->fill($input)->save();
            return redirect('/posts/' . $post->id);
        }
        public function edit(Post $post)
        {
            return view('posts.edit')->with(['post' => $post]);
        }
    
        public function update(Request $request, Post $post)
        {
            $input_post = $request['post'];
            $post->fill($input_post)->save();
        
            return redirect('/posts/' . $post->id);
        }
}
