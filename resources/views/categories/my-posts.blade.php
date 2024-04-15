<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    <x-app-layout>
    <x-slot name="header">
        　<span id="currentCategory"></span>に関連する投稿です
        　<select id="categorySelect" name="get[category_id]">
　　<option value="none">ジャンルを選べます</option>
　　<option value="all">すべて</option>
    <option value="1">山</option>
    <option value="2">川</option>
    <option value="3">公園</option>
    <option value="4">植物</option>
    <option value="5">都市</option>
    <option value="6">動物</option>
    <option value="7">空</option>
    <option value="8">夜</option>
    <option value="9">星</option>
    <option value="10">建築物</option>
</select>
    </x-slot>
    <body>
        
        <a href='/my-posts'>自分の投稿を見る</a>
        
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                  <div class='parent-container'>
                    <h2 class='image'>
                       <img src="{{ $post->user->image_url }}" alt="User Image">
                    </h2>
                    <h2 class='username'>
                        <p>{{ $post->user->name }}</p>
                    </h2>
                  </div>
                    <h2 class='image_url'>
                       <a href="/posts/{{ $post->id }}">
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/></a>
                <a href="/my_categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    </2>
                    
                    
                    
                    <form action="/posts/{{ $post->id }}/likes" method="post">
                        @csrf
                        <!--<button type="submit" {{ Auth::user()->hasLiked($post) ? 'disabled' : '' }}>いいね</button>-->
                        <button id="like-button" class="like-button" onclick="toggleLike()" {{ Auth::user()->hasLiked($post) ? 'disabled' : '' }}>
                            <span class="heart-icon">&#10084;</span>{{ $post->count_goods }}
                            <span class="like-text"></span>
                        </button>
                    </form>
                    <h2 class='count_goods'>
                        <button class="show-likes" data-post-id="{{ $post->id }}">いいねした人</button>
                    </h2>
                    
                    <p class='comment'>{{ $post->comment }}</p>
                </div>
                <!-- 削除ボタン -->
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                </form>
            @endforeach
        </div>
        <div class='paginate'>
           {{ $posts->links('pagination::default') }}
        </div>
        
<script src="{{ asset('js/my-posts.js') }}"></script>
    </body>
    </x-app-layout>
</html>