<h2><?= $title ?></h2>
<?php foreach($posts as $post) :?>
    <h3><?= $post['title'] ?></h3>
    <small><?= $post['created_at']?></small><br>
    <?= $post['body'] ?>
    <p><a href="<?= site_url('/posts/'.$post['slug']) ?>">
        Read More
    </a></p>
<?php endforeach; ?>