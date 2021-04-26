<h2><?= $title ?></h2>
<p><a href="<?= site_url('/admin/create/') ?>">
        New User
</a></p>


<?php foreach($users as $user) :?>
    <small>id no.<?= $user['id']?></small>
    <h3><?= $user['username'] ?></h3>
    <small>Password <?= $user['password']?></small><br>
    <p>Full Name: <?= $user['name']?></p>
    <p>Home Address: <?= $user['address']?></p>
    <p>E-mail: <?= $user['email']?></p>
    <hr>
    <p>Type: <?= $user['type']?></p>
    <p>Status: <?= $user['status']?></p>
    
    <?= form_open('admin/toggleStatus/' . $user['id']) ?>
        <input type="submit" value="Toggle Status" class="btn btn-primary">
    <?= form_close() ?>
    <hr>
    <p><a href="<?= site_url('/admin/edit/'.$user['id']) ?>">
        Edit
    </a></p>
    <?= form_open('admin/delete/' . $user['id']) ?>
        <input type="submit" value="Delete" class="btn btn-danger">
    <?= form_close() ?>
<?php endforeach; ?>