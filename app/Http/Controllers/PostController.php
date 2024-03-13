<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Cloudinary;  //use宣言するのを忘れずに
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
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
     
        public function create(Category $category)
        {
            return view('posts.create')->with(['categories' => $category->get()]);
        }
        
    public function store(Request $request, Post $post)
        {
                     // バリデーションルールの定義
            $rules = [
                'image' => 'required|image', // 画像が必須であることを示すバリデーションルール
                'post.comment' => 'required|string|max:255', // その他の必要なバリデーションルール
                // 他のフォームフィールドに対するバリデーションルールを追加できます
            ];
        
            // カスタムエラーメッセージの定義
            $messages = [
                'image.required' => '画像を選択してください。',
                'post.comment.required' => 'コメントを入力してください。',
                // 他のエラーメッセージも必要に応じて追加できます
            ];
        
            // バリデーション実行
            $validator = Validator::make($request->all(), $rules, $messages);
        
            // バリデーションが失敗した場合
            if ($validator->fails()) {
                return redirect('/posts/create') // バリデーションエラーが発生した際のリダイレクト先を指定します
                    ->withErrors($validator) // エラーメッセージをセッションに保存します
                    ->withInput(); // 入力値をセッションに保存します
            }
        
            // 画像が送信されているか確認
            if ($request->hasFile('image')) {
                // 画像の処理を行う
                $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $post->image_url = $image_url;
            }
        
            // その他の処理
            $input = $request->input('post');
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
