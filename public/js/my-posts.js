//削除機能のダイヤログ
            function deletePost(id) {
                        'use strict'
                
                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
             }
        

//いいね機能
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


//いいね機能２
    function toggleLike() {
        var likeButton = document.getElementById('like-button');
        likeButton.classList.toggle('liked');
    }

<!--カテゴリごとのページに遷移出来る仕組み-->

    document.getElementById('categorySelect').addEventListener('change', function() {
        var categoryId = this.value;
        if (categoryId === 'all') {
            window.location.href = '/';
        } else {
            window.location.href = '/categories/' + categoryId;
        }
    });

<!--ジャンル「すべて」を保持するコード-->

    


    document.getElementById('categorySelect').addEventListener('change', function() {
        var categoryId = this.value;
        if (categoryId === 'all') {
            window.location.href = '/my-posts';
        } else {
            window.location.href = '/my_categories/' + categoryId;
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('categorySelect');
        const currentCategory = document.getElementById('currentCategory');

        // ページ読み込み時にカテゴリIDを取得して、それに基づいてカテゴリ名を表示
        const url = window.location.href;
        const categoryId = url.split('/').pop();
        if (categoryId !== '' && categoryId !== 'categories') {
            const categoryOption = categorySelect.querySelector(`option[value="${categoryId}"]`);
            if (categoryOption) {
                currentCategory.textContent = categoryOption.textContent;
            }
        }

        // カテゴリが選択されたときにカテゴリ名を更新
        categorySelect.addEventListener('change', function () {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            if (selectedOption.value === 'all') {
                currentCategory.textContent = '';
            } else {
                currentCategory.textContent = selectedOption.textContent;
            }
        });
    });