<?= form_open('users/login') ?>

    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus >
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="password" required>
    </div> 
    <button type="submit" class="btn btn-primary btn-block">Log-in</button>

<?= form_close() ?>