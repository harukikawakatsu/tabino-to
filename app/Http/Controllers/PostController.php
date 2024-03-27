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
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
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
        
     
    public function show(Post $post)
        {
            $address = $post->location->address ?? null; // 投稿の住所を取得
            $user = $post->user; // 投稿のユーザー情報を取得
            return view('posts.show')->with(['post' => $post, 'user' => $user, 'address' => $address]);
        }
        
    public function main_show(Post $post)
        {
            $address = $post->location->address ?? null; // 投稿の住所を取得
            $user = $post->user; // 投稿のユーザー情報を取得
            return view('posts.main_show')->with(['post' => $post, 'user' => $user, 'address' => $address]);
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
                'post.address' => 'nullable|string|max:255', // 住所が空でも問題ないようにバリデーションルールを追加
                
            ];
        
            // カスタムエラーメッセージの定義
            $messages = [
                'image.required' => '(注）画像を選択してください。',
                'post.comment.required' => '（注）コメントを入力してください。',
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
        
            // 住所が空でない場合にのみ、座標を取得して保存
            if (!empty($input['address'])) {
                $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($input['address']) . '&key=AIzaSyDxY-KstgIdJ3b97xVDWl6U9lTdyreUQ-w');
                $geocode = json_decode($geocode);
                $latitude = $geocode->results[0]->geometry->location->lat;
                $longitude = $geocode->results[0]->geometry->location->lng;
        
                // 座標情報を保存
                $location = new Location;
                $location->latitude = $latitude;
                $location->longitude = $longitude;
                $location->address = $input['address'];
                $location->save();
        
                // Postインスタンスを保存
                $post = new Post;
                $post->fill($input);
                $post->image_url = $upload;
                $post->location_id = $location->id;
                $post->save();
            } else {
                // 住所が空の場合の処理
                $post = new Post;
                $post->fill($input);
                $post->image_url = $upload;
                $post->save();
                    }
                
                    return redirect('/posts/' . $post->id);
                        }
        
        
        public function edit(Category $category)
        {
            return view('posts.create')->with(['categories' => $category->get()]);
        }
    
        public function update(Request $request, Post $post)
        {
             // バリデーションルールの定義
            $rules = [
                'image' => 'required|image', // 画像が必須であることを示すバリデーションルール
                'post.comment' => 'required|string|max:255', // その他の必要なバリデーションルール
                'post.address' => 'nullable|string|max:255', // 住所が空でも問題ないようにバリデーションルールを追加
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
        
            // 住所が空でない場合にのみ、座標を取得して保存
            if (!empty($input['address'])) {
                $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($input['address']) . '&key=AIzaSyDxY-KstgIdJ3b97xVDWl6U9lTdyreUQ-w');
                $geocode = json_decode($geocode);
                $latitude = $geocode->results[0]->geometry->location->lat;
                $longitude = $geocode->results[0]->geometry->location->lng;
        
                // 座標情報を保存
                $location = new Location;
                $location->latitude = $latitude;
                $location->longitude = $longitude;
                $location->address = $input['address'];
                $location->save();
        
                // Postインスタンスを保存
                $post = new Post;
                $post->fill($input);
                $post->image_url = $upload;
                $post->location_id = $location->id;
                $post->save();
            } else {
                // 住所が空の場合の処理
                $post = new Post;
                $post->fill($input);
                $post->image_url = $upload;
                $post->save();
                    }
                
                    return redirect('/posts/' . $post->id);
                        
        }
        
        public function delete(Post $post)
            {
                $post->delete();
                return redirect('/');
            }
            
        public function myPosts(Post $post)
            {
                $user = Auth::user();
                $posts = $user->posts()->paginate(10); // ページネーションを含むユーザーの投稿を取得
            
                return view('posts.my-posts', ['posts' => $posts]);
            }
        
        // public function like(Post $post)
        //     {
        //         $user = Auth::user();
            
        //         // ユーザーがすでにいいねをしているかどうかを確認
        //         if ($user->hasLiked($post)) {
        //             return back()->with('error', '既にいいねしています');
        //         }
            
        //         // いいねを作成
        //         $like = new Like;
        //         $like->user_id = $user->id;
            
        //         // 重複をチェックしてから保存
        //         if ($post->likes()->save($like)) {
        //             return back()->with('success', 'いいねしました');
        //         } else {
        //             return back()->with('error', 'いいねに失敗しました');
        //         }
        //     }
        
        public function like(Post $post)
            {
                $user = Auth::user();
            
                // ユーザーがすでにいいねをしているかどうかを確認
                if ($user->hasLiked($post)) {
                    return back()->with('error', '既にいいねしています');
                }
            
                // いいねを作成
                $like = new Like;
                $like->user_id = $user->id;
            
                // 重複をチェックしてから保存
                if ($post->likes()->save($like)) {
                    // いいねが成功したら、投稿のいいね数を更新する
                    $post->count_goods = $post->likes()->count();
                    $post->save();
            
                    return back()->with('success', 'いいねしました');
                } else {
                    return back()->with('error', 'いいねに失敗しました');
                }
            }
            
            
        public function getLikesForPost(Post $post)
            {
                // 投稿に関連するいいね情報を取得
                $likes = $post->likes()->with('user')->get();
            
                // 取得したいいね情報をJSON形式で返す
                return response()->json($likes);
            }
}
