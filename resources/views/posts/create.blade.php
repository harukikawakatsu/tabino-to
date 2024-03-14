<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>tabino-to</title>
</head>
<x-app-layout>
<body>
    <h1>Blog Name</h1>

    <!-- コメントと写真の両方を含むフォーム -->
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="comment">
            <h2>コメント</h2>
            <textarea name="post[comment]" placeholder="写真の情報を自由に記述してください"></textarea>
        </div>
        
        <div class="image_url">
            <h2>写真</h2>
            <input type="file" name="image">
        </div>
        
        <div class="category">
            <h2>Category</h2>
            <select name="post[category_id]">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- ユーザーのIDを表示する -->
        <input type="hidden" name="post[user_id]" value="{{ Auth::id() }}">
        
        <input type="submit" value="投稿"/>
    </form>

    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</x-app-layout>
</html>