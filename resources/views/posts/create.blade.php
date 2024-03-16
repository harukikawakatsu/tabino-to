<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>tabino-to</title>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBFpv91YFKQTqIsHlVuvzoSmzf1J81DBL4&language=ja"></script>
    
    <style>
html { height: 100% }
body { height: 100% }
#map { height: 50%; width: 50%}
</style>
</head>
<body>
    <x-app-layout>
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
    </x-app-layout>
    
    <div id="map"></div>

    <script>
        var MyLatLng = new google.maps.LatLng(35.6811673, 139.7670516);
        var Options = {
            zoom: 15,      //地図の縮尺値
            center: MyLatLng,    //地図の中心座標
            mapTypeId: 'roadmap'   //地図の種類
        };
        var map = new google.maps.Map(document.getElementById('map'), Options);
    </script>
</body>
</html>