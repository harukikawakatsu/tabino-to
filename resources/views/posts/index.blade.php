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
        　トップページへようこそ
    </x-slot>
    <body>
        
        <a href='/my-posts'>自分の投稿を見る</a>
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='username'>
                        <p>投稿者: {{ $post->user->name }}</p>
                    </h2>
                    <h2 class='image_url'>
                       <a href="/posts/{{ $post->id }}">
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/></a>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    </2>
                    
                    
                    <h2 class='count_goods'>
                        いいね！{{ $post->count_goods }}
                        <button class="show-likes" data-post-id="{{ $post->id }}">いいねした人</button>
                    </h2>
                    <form action="/posts/{{ $post->id }}/likes" method="post">
                        @csrf
                        <button type="submit" {{ Auth::user()->hasLiked($post) ? 'disabled' : '' }}>いいね</button>
                    </form>
                    
                    
                    <p class='comment'>コメント：{{ $post->comment }}</p>
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
            {{ $posts->links() }}
        </div>
        <script>
            function deletePost(id) {
                        'use strict'
                
                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
             }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const showLikesButtons = document.querySelectorAll('.show-likes');
        
                showLikesButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const postId = this.getAttribute('data-post-id');
                        getLikesForPost(postId)
                            .then(likes => {
                                const likesList = likes.map(like => `<li>${like.user.name}</li>`).join('');
                                const likesWindow = window.open('', 'likesWindow', 'width=400,height=400');
                                likesWindow.document.body.innerHTML = `<h2>いいねした人</h2><ul>${likesList}</ul>`;
                            })
                            .catch(error => {
                                console.error('Error fetching likes:', error);
                            });
                    });
                });
        
                function getLikesForPost(postId) {
                    return new Promise((resolve, reject) => {
                        fetch(`/posts/${postId}/likes`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                resolve(data);
                            })
                            .catch(error => {
                                reject(error);
                            });
                    });
                }
            });
</script>
    </body>
    </x-app-layout>
</html>