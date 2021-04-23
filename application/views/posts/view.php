<h2><?= $post['title'] ?></h2>
<small><?= $post['created_at']?></small>
<div class="post-body">
    <?= $post['body'] ?>
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']): ?>

<hr>
<?= form_open('/posts/delete/' .$post['id']); ?>
    <input type="submit" value="delete" class="btn btn-danger">
<?= form_close() ?>
<a class="btn btn-default" href="edit/<?= $post['slug']?>">Edit</a>

<?php endif; ?>