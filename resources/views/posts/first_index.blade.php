<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="description" content="風景写真の記録、シェア、閲覧をすることが出来る画像投稿型SNSです。旅行先に困ったとき、このサイトの風景画像を見て惹かれた場所に赴くのもよし、このサイトを利用して旅行気分を味わうのもよし、お好きに利用ください。">
    <meta name="keywords" content="風景写真,旅行,SNS,インスタ,撮影場所,たびノート,日本の風景,風景,撮影,写真家,動物の写真,たび,旅,日本一周,シェア,さつえい,景色,けしき,写真,自然,公園">
    <meta charset="utf-8">
    <title>たびノート</title>
    <!-- Fonts --> 
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/first_index.css') }}">
    <link rel="icon" href="{{ secure_asset('img/旅ノートロゴ.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container01">
    <a href="{{ route('login') }}" class="btn btn-custom01">
  <span class="btn-custom01-front">ログイン</span>
  <i class="fas fa-angle-right fa-position-right"></i></a>
  <div class="hover-text">新規登録、ログインをすると写真の投稿や自分の投稿の振り返りをすることが出来ます。</div>
    </div>
    <div class="container01">
    <a href="{{ route('register') }}" class="btn btn-custom01">
  <span class="btn-custom01-front">新規登録</span>
  <i class="fas fa-angle-right fa-position-right"></i></a>
  <div class="hover-text">新規登録、ログインをすると写真の投稿や自分の投稿の振り返りをすることが出来ます。</div>
    </div>
    
       
                <a class='category_word'>
                    すべて
                </a>
            <label>
            <select class='custom-select sources'id="categorySelect" name="get[category_id]">
                <option value="none">ジャンル</option>
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
            </label>
        
        
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
                        
                  
                        
                        <p class="comment">{{ $post->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="paginate">
            {{ $posts->links('pagination::default') }}
        </div>
        
        <script src="{{ asset('js/first_index.js') }}"></script>
   
</body>
</html>