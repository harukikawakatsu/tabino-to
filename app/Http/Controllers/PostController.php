<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Cloudinary;  //use宣言するのを忘れずに

/**
 * Post一覧を表示する
 * 
 * @param Post Postモデル
 * @return array Postモデルリスト
 */
 
class PostController extends Controller
{
    // public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    //     {
    //         return view('posts.index')->with(['posts' => $post->getByLimit()]);
    //          //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    //          //getbylimitでデータ取得数を制限出来るようにしている。
    //     }
    
    public function index(Post $post)
        {
            $posts = $post->getByLimit(); // 投稿を取得
        
            // 投稿に関連するユーザー情報も取得して一緒にビューに渡す
            return view('posts.index')->with(['posts' => $posts->load('user')]);
        }
        
            /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
    public function show(Post $post)
        {
            return view('posts.show')->with(['post' => $post, 'user' => $post->user]);
         //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
        }
        
    public function create()
        {
            return view('posts.create');
        }
        
    public function store(Request $request, Post $post)
        {
            $input = $request['post'];
            //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            // dd($image_url);  //画像のURLを画面に表示
            // $input = $request->input();//チャットGPTが追加したもの
            $input += ['image_url' => $image_url];  //追加
            // $input['image_url'] = $image_url;
            
            
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
        
        public function delete(Post $post)
            {
                $post->delete();
                return redirect('/');
            }
        
}
