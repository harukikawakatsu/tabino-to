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
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
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
                        const likesList = likes.map(like => `<li class='parent-container'>
                            <div class='image'>
                                <img src="${like.user.image_url}" alt="User Image">
                            </div>
                            <div class='username'>
                                ${like.user.name}
                            </div>
                        </li>`).join('');
                        const likesWindow = window.open('', 'likesWindow', 'width=400,height=400');
                        likesWindow.document.body.innerHTML = `<h2>いいねした人</h2><ul>${likesList}</ul>`;
                        
                        // .image クラスにスタイルを適用
                        const images = likesWindow.document.querySelectorAll('.image');
                        images.forEach(image => {
                            image.style.width = '30px';
                            image.style.height = '30px';
                            image.style.overflow = 'hidden';
                            image.style.borderRadius = '50%';
                            image.style.marginRight = '10px'; /* 画像とユーザーネームの間に10pxの右側マージンを追加 */
                        });
                        
                        // .image img クラスにスタイルを適用
                        const imageImgs = likesWindow.document.querySelectorAll('.image img');
                        imageImgs.forEach(imageImg => {
                            imageImg.style.width = '100%';
                            imageImg.style.height = '100%';
                            imageImg.style.objectFit = 'cover';
                            imageImg.style.objectPosition = 'center';
                            imageImg.style.display = 'block';
                        });
                        
                        // .parent-container クラスにスタイルを適用
                        const parentContainers = likesWindow.document.querySelectorAll('.parent-container');
                        parentContainers.forEach(parentContainer => {
                            parentContainer.style.display = 'flex';
                            parentContainer.style.alignItems = 'center'; /* 垂直方向に中央揃え */
                            parentContainer.style.margin = '0';/* 外側の余白を削除 */
                            parentContainer.style.padding = '0';/* 内側の余白を削除 */
                        });
                        
                        // .username クラスにスタイルを適用
                        const usernames = likesWindow.document.querySelectorAll('.username');
                        usernames.forEach(username => {
                            username.style.display = 'inline-block';
                            username.style.fontSize = '11px'; /* ユーザー名のフォントサイズを調整 */
                            username.style.fontWeight = 'bold'; /* ユーザー名の太字設定 */
                        });
                        
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

<script>
    function toggleLike() {
        var likeButton = document.getElementById('like-button');
        likeButton.classList.toggle('liked');
    }
</script>
    </body>
    </x-app-layout>
</html>