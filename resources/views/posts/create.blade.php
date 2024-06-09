<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>たびノート</title>
    <link rel="icon" href="{{ secure_asset('img/旅ノートロゴ.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <x-app-layout>
        <!-- コメントと写真の両方を含むフォーム -->
        <form class="form" action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            
            
            
            <div class="image_url">
                <h2>写真</h2>
                <input type="file" name="image">
            </div>
            
            <div class="comment">
                <h2>コメント</h2>
                <textarea name="post[comment]" placeholder="写真の情報を自由に記述してください[必須]"></textarea>
            </div>
            <div class="category">
                <h2>カテゴリー</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="address">
                <h2>住所</h2>
                <input type="text" name="post[address]" placeholder="場所や住所を入力してください">
            </div>
            
            <!-- ユーザーのIDを表示する -->
            <input type="hidden" name="post[user_id]" value="{{ Auth::id() }}">
            
            <input type="submit" value="投稿"/>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        
        <div class="btn01">
            <a href="/posts">戻る</a>
        </div>
    </x-app-layout>
</body>
</html>