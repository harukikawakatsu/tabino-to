<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
        public function store(Request $request, Post $post)
        {
            // バリデーションのルールを定義する場合は適宜追加してください
            $request->validate([
                'content' => 'required|string|max:255', // 例: コメント内容は必須で255文字以内
            ]);
    
            // コメントを作成し、投稿に関連付ける
            $comment = new Comment();
            $comment->content = $request->input('content');
            $comment->user_id = auth()->id(); // ログインユーザーのIDを取得する例
            $comment->post_id = $post->id;
            $comment->save();
    
            // コメント投稿後にリダイレクトするなど、適切な処理を追加してください
            return redirect()->back()->with('success', 'コメントを投稿しました');
        }
}
