<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='image_url'>
                       <a href="/posts/{{ $post->id }}">{{ $post->image_url }}</a>
                    </2>
                    <h2 class='count_goods'>{{ $post->count_goods }}</h2>
                    <p class='comment'>{{ $post->comment }}</p>
                </div>
            @endforeach
        </div>
    </body>
</html>