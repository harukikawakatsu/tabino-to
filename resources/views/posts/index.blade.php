<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <x-slot name="header">
        　トップページへようこそ
    </x-slot>
    <body>
        <a href='/login'>ログイン</a>
        <a href='/register'>新規登録</a>
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='username'>
                        <p>投稿者: {{ $post->user->name }}</p>
                    </h2>
                    <h2 class='image_url'>
                       <a href="/posts/{{ $post->id }}">{{ $post->image_url }}</a>
                    </2>
                    <h2 class='count_goods'>{{ $post->count_goods }}</h2>
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
        <a href='/posts/create'>create</a>
        <!--ほんとはフッターに登録したい-->
        ログインユーザー名{{ Auth::user()->name }}
        <!--ほんとはフッターに登録したい-->
        <script>
            function deletePost(id) {
                        'use strict'
                
                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
             }
        </script>
    </body>
    </x-app-layout>
</html>