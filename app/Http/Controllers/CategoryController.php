<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Category $category)
        {
            return view('categories.index')->with(['posts' => $category->getByCategory()]);
        }


    public function my_posts(Category $category)
{
    $user = Auth::user();
    $posts = $user->posts()->where('category_id', $category->id)->paginate(10); // ページネーションを含むユーザーの特定カテゴリー投稿を取得
    
    return view('categories.my-posts', ['posts' => $posts]);
}
}
