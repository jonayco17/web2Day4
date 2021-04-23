<h2><?= $title ?></h2>
<?= validation_errors() ?>

<?= form_open('users/register') ?>

    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="password2">
    </div>
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Home Address</label>
        <input type="text" class="form-control" name="address">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>

<?= form_close() ?>