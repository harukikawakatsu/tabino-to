<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/main_show.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFpv91YFKQTqIsHlVuvzoSmzf1J81DBL4&callback=initMap" async defer></script>
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
            <a href="/">戻る</a>
            
        </div>
       
       <div id="map" style="height: 400px;"></div>
       
        <script>
    // ページがロードされるたびにinitMap()関数を実行する
    window.onload = function() {
        initMap();
    };

    
    function initMap() {
            @if ($post->location)
                var latitude = {{ $post->location->latitude }};
                var longitude = {{ $post->location->longitude }};
            @else
                var latitude = null;
                var longitude = null;
            @endif
        
            var center = { lat: latitude, lng: longitude };
        
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: center
            });
        
            if (latitude && longitude) {
                var marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map: map,
                    title: '{{ $post->comment }}'
                });
            }
        }
        </script>
        <div class="comments">
    <h2>コメント</h2>
    
    <!-- コメント投稿フォーム -->
    <form action="/posts/{{ $post->id }}/comments" method="post">
        @csrf
        <textarea name="content" rows="3" placeholder="コメントを入力してください"></textarea>
        <button class="comment_button" type="submit">投稿</button>
    </form>
    
    <!-- コメント表示 -->
    @foreach($post->comments as $comment)
        <div class="comment">
            <div class="comment-user">
                <div class="comment_image">
                <img src="{{ $comment->user->image_url }}" alt="{{ $comment->user->name }}">
                </div>
                <div class="comment_name">
                <span>{{ $comment->user->name }}</span>
                </div>
            </div>
            <div>&nbsp;:&nbsp;</div>
            <div class="comment-content">
                {{ $comment->content }}
            </div>
            <div>&nbsp;:&nbsp;</div>
            <div class="comment-updated_at">
                {{ $comment->updated_at }}
            </div>
        </div>
    @endforeach
</div>
    </body>
    </x-app-layout>
     
    
   
    
    
</html>