<?= validation_errors() ?>

<?= form_open('admin/update') ?>
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" value="<?= $user['password'] ?>">
    </div>
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" name="name" value="<?= $user['id'] ?>" value="<?= $user['name'] ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
    </div>
    <div class="form-group">
        <label>Home Address</label>
        <input type="text" class="form-control" name="address" value="<?= $user['address'] ?>">
    </div>
    <label for="type">Type</label>
    <select class="form-select" name="type">
        <option value="member" <?php echo($user['type'] === 'member' ? 'selected' : ''); ?>>Member</option>
        <option value="admin" <?php echo($user['type'] === 'admin' ? 'selected' : ''); ?>>Admin</option>
    </select>
    <label for="satatus">Status</label>
    <select class="form-select" name="status">
        <option value="pending" <?php echo($user['status'] === 'pending' ? 'selected' : ''); ?>>Pending</option>
        <option value="approved" <?php echo($user['status'] === 'approved' ? 'selected' : ''); ?>>Approved</option>
    </select>
    
    <button type="submit" class="btn btn-primary">Update</button>

<?= form_close() ?>