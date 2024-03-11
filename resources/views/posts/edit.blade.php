<!-- body内だけを表示しています。 -->
<body>
    <h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='comment'>
                <h2>コメント</h2>
                <input type='text' name='post[comment]' value="{{ $post->comment }}">
            </div>
            <div class='image_url'>
                <h2>写真</h2>
                <input type='file' name='post[image_url]' value="{{ $post->image_url }}">
            </div>
            <input type="submit" value="保存">
        </form>
    </div>
</body>