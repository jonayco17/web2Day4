<p><a href="<?= site_url('/admin/create/') ?>">
        New User
</a></p>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user) :?>
                            <tr>
                                <td><?= $user['id']?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['password']?></td>
                                <td><?= $user['name']?></td>
                                <td><?= $user['address']?></td>
                                <td><?= $user['email']?></td>
                                <td><?= $user['type']?></td>
                                <td><?= $user['status']?></td>
                                <td>
                                    <?= form_open('admin/toggleStatus/' . $user['id']) ?>
                                        <input type="submit" value="Toggle Status" class="btn btn-primary">
                                    <?= form_close() ?>
                                    <p><a href="<?= site_url('/admin/edit/'.$user['id']) ?>">Edit</a></p>
                                    <?= form_open('admin/delete/' . $user['id']) ?>
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    <?= form_close() ?>
                                </td>   
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>