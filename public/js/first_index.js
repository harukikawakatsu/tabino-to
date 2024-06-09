
        



<!--カテゴリごとのページに遷移出来る仕組み-->

    document.getElementById('categorySelect').addEventListener('change', function() {
        var categoryId = this.value;
        if (categoryId === 'all') {
            window.location.href = '/';
        } else {
            window.location.href = '/first_categories/' + categoryId;
        }
    });

<!--ジャンル「すべて」を保持するコード-->

    


    document.getElementById('categorySelect').addEventListener('change', function() {
        var categoryId = this.value;
        if (categoryId === 'all') {
            window.location.href = '/';
        } else {
            window.location.href = '/first_categories/' + categoryId;
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('categorySelect');
        const currentCategory = document.getElementById('currentCategory');

        // ページ読み込み時にカテゴリIDを取得して、それに基づいてカテゴリ名を表示
        const url = window.location.href;
        const categoryId = url.split('/').pop();
        if (categoryId !== '' && categoryId !== 'first_categories') {
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
    
    
    