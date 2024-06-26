<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>たびノート</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="icon" href="{{ secure_asset('img/旅ノートロゴ.png') }}" type="image/x-icon">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <<a class='category_word'>
            <span id="currentCategory"></span>
        </a>
        <label>
            <select class='custom-select sources' id="categorySelect" name="get[category_id]" class="category-select">
                <option value="none" class="category-option">ジャンル</option>
                <option value="all" class="category-option">すべて</option>
                <option value="1" class="category-option">山</option>
                <option value="2" class="category-option">川</option>
                <option value="3" class="category-option">公園</option>
                <option value="4" class="category-option">植物</option>
                <option value="5" class="category-option">都市</option>
                <option value="6" class="category-option">動物</option>
                <option value="7" class="category-option">空</option>
                <option value="8" class="category-option">夜</option>
                <option value="9" class="category-option">星</option>
                <option value="10" class="category-option">建築物</option>
            </select>
        </label>
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
                        <a href="/main_posts/{{ $post->id }}">
                            <img class="image_url" src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                        </a>
                        
                        <div class="yokonarabi">
                            <a class="category" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            
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
                </div>
            @endforeach
        </div>
        
        <div class="paginate">
            {{ $posts->links('pagination::default') }}
        </div>
        
        <script src="{{ asset('js/index.js') }}"></script>
    </x-app-layout>
</body>
</html>