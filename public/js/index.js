// index.js
import axios from 'axios'; // axiosをインポート

document.addEventListener('DOMContentLoaded', function () {
    const showCommentsButtons = document.querySelectorAll('.show-comments');

    showCommentsButtons.forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const commentForm = document.getElementById(`comment-form-${postId}`);
            if (commentForm.style.display === 'none') {
                commentForm.style.display = 'block';
                getCommentsForPost(postId)
                    .then(comments => {
                        const commentsList = comments.map(comment => `
                            <div class='comment'>
                                <div class='parent-container'>
                                    <h2 class='image'>
                                        <img src="${comment.user.image_url}" alt="User Image">
                                    </h2>
                                    <h2 class='username'>
                                        ${comment.user.name}
                                    </h2>
                                </div>
                                <p>${comment.content}</p>
                            </div>
                        `).join('');
                        const commentsWindow = window.open('', 'commentsWindow', 'width=400,height=400');
                        commentsWindow.document.body.innerHTML = `<h2>コメント</h2>${commentsList}`;
                    })
                    .catch(error => {
                        console.error('Error fetching comments:', error);
                    });
            } else {
                commentForm.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('form[id^="add-comment-form"]').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            axios.post('/comments', formData) // axios.post を使用してコメントを追加
                .then(response => {
                    const postId = response.data.post_id;
                    return getCommentsForPost(postId);
                })
                .then(comments => {
                    const commentsList = comments.map(comment => `
                        <div class='comment'>
                            <div class='parent-container'>
                                <h2 class='image'>
                                    <img src="${comment.user.image_url}" alt="User Image">
                                </h2>
                                <h2 class='username'>
                                    ${comment.user.name}
                                </h2>
                            </div>
                            <p>${comment.content}</p>
                        </div>
                    `).join('');
                    const commentsWindow = window.open('', 'commentsWindow', 'width=400,height=400');
                    commentsWindow.document.body.innerHTML = `<h2>コメント</h2>${commentsList}`;
                })
                .catch(error => {
                    console.error('Error adding comment:', error);
                });
        });
    });

    function getCommentsForPost(postId) {
        return axios.get(`/posts/${postId}/comments`) // axios.get を使用してコメントを取得
            .then(response => response.data)
            .catch(error => {
                console.error('Error fetching comments:', error);
                throw error; // エラーを再スローして catch で処理できるようにする
            });
    }
});
