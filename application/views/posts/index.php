<?php foreach($posts as $post) :?>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $post['title'] ?></h3><br>
            <small><?= $post['created_at']?></small>
            <p class="card-text"><?= $post['body'] ?></p>
            <p class="card-link"><a href="<?= site_url('/posts/'.$post['slug']) ?>">
                Read More
            </a></p>
        </div>
    </div>
<?php endforeach; ?>