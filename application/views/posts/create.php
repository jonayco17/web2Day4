<h2><?= $title ?></h2>

<?= validation_errors()?>

<?= form_open('posts/create')?>
    <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea id="editor1" class="form-control" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-default ">Submit</button>
<?= form_close() ?>