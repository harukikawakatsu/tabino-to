<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>たびノート</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="icon" href="{{ secure_asset('img/旅ノートロゴ.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/my-posts.css') }}">
</head>
<body>
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
        
        <div class="posts">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="parent-container">
                        <h2 class="image">
                            <img src="{{ $post->user->image_url }}" alt="User Image">
                        </h2>
                        <h2 class="username">
                            <p>{{ $post->user->name }}</p>
                        </h2>
                    </div>
                    
                    <div class="separator">
                        <a href="/posts/{{ $post->id }}">
                            <img class="image_url" src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                        </a>
                        
                        <div class="yokonarabi">
                            <a class="category" href="/my_categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            
                            <form action="/posts/{{ $post->id }}/likes" method="post">
                                @csrf
                                <button id="like-button" class="like-button" onclick="toggleLike()" {{ Auth::user()->hasLiked($post) ? 'disabled' : '' }}>
                                    <span class="heart-icon">&#10084;</span>{{ $post->count_goods }}
                                    <span class="like-text"></span>
                                </button>
                            </form>
                            
                            <h2 class="count_goods">
                                <button class="show-likes" data-post-id="{{ $post->id }}">いいねした人</button>
                            </h2>
                        </div>
                        
                        <p class="comment">{{ $post->comment }}</p>
                    </div>
                    
                    <!-- 削除ボタン -->
                    <form class="btn01" action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                    </form>
                </div>
            @endforeach
        </div>
        
        <div class="paginate">
            {{ $posts->links('pagination::default') }}
        </div>
        
        <script src="{{ asset('js/my-posts.js') }}"></script>
    </x-app-layout>
</body>
</html>