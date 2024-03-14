<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1 class="username">
            投稿者: {{ $user->name }}
        </h1>
        <h1 class="comment">
            {{ $post->comment }}
        </h1>
        <div class="image_url">
            <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
        </div>
        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        <div class="footer">
            <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集</a></div>
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>