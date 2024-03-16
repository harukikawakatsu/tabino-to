<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Cloudinary;  //use宣言するのを忘れずに
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
/**
 * Post一覧を表示する
 * 
 * @param Post Postモデル
 * @return array Postモデルリスト
 */
 
class PostController extends Controller
{
   
    public function index(Post $post)
        {
            
            $posts = $post->getPaginateByLimit(); // ページネーションを含む投稿を取得

            return view('posts.index', ['posts' => $posts]);
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
            //          // バリデーションルールの定義
            // $rules = [
            //     'image' => 'required|image', // 画像が必須であることを示すバリデーションルール
            //     'post.comment' => 'required|string|max:255', // その他の必要なバリデーションルール
            //     // 他のフォームフィールドに対するバリデーションルールを追加できます
            // ];
        
            // // カスタムエラーメッセージの定義
            // $messages = [
            //     'image.required' => '画像を選択してください。',
            //     'post.comment.required' => 'コメントを入力してください。',
            //     // 他のエラーメッセージも必要に応じて追加できます
            // ];
        
            // // バリデーション実行
            // $validator = Validator::make($request->all(), $rules, $messages);
        
            // // バリデーションが失敗した場合
            // if ($validator->fails()) {
            //     return redirect('/posts/create') // バリデーションエラーが発生した際のリダイレクト先を指定します
            //         ->withErrors($validator) // エラーメッセージをセッションに保存します
            //         ->withInput(); // 入力値をセッションに保存します
            // }
        
            // // 画像が送信されているか確認
            // if ($request->hasFile('image')) {
            //     // 画像の処理を行う
            //     $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            //     $post->image_url = $image_url;
            // }
        
            // // その他の処理
            // $input = $request->input('post');
            
            
            // $post->fill($input)->save();
            
            // // return redirect('/posts/' . $post->id);
            
            // // Geocoding APIを使用して座標を取得
            // $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($request->input('post.address')).'&key=AIzaSyDxY-KstgIdJ3b97xVDWl6U9lTdyreUQ-w');
            // $geocode = json_decode($geocode);
            // $latitude = $geocode->results[0]->geometry->location->lat;
            // $longitude = $geocode->results[0]->geometry->location->lng;
            
            // // 座標情報を保存
            // $location = new Location;
            // $location->latitude = $latitude;
            // $location->longitude = $longitude;
            // $location->address = $request->input('post.address'); // 追加された行
            // $location->save();
            
            // $post = new Post;
            // $post->fill($input);
            // $post->location_id = $location->id;
            // $post->save();
            
            // return redirect('/posts/' . $post->id);
           
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
                $image = $request->file('image')->getRealPath();
                $upload = Cloudinary::upload($image)->getSecurePath();
            } else {
                $upload = null;
            }
        
            // その他の処理
            $input = $request->input('post');
        
            // Geocoding APIを使用して座標を取得
            $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($request->input('post.address')) . '&key=AIzaSyDxY-KstgIdJ3b97xVDWl6U9lTdyreUQ-w');
            $geocode = json_decode($geocode);
            $latitude = $geocode->results[0]->geometry->location->lat;
            $longitude = $geocode->results[0]->geometry->location->lng;
        
            // 座標情報を保存
            $location = new Location;
            $location->latitude = $latitude;
            $location->longitude = $longitude;
            $location->address = $request->input('post.address'); // 追加された行
            $location->save();
        
            // Postインスタンスを保存
            $post = new Post;
            $post->fill($input);
            $post->image_url = $upload; // 画像の URL をセット
            $post->location_id = $location->id;
            $post->save();
        
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
