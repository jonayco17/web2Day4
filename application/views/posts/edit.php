<?= validation_errors()?>

<?= form_open('posts/update')?>
    <input type="hidden" name="id" value="<?= $post['id']?>">
    <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="<?= $post['title']?>">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea id="editor1" class="form-control" name="body"><?= $post['body']?></textarea>
    </div>
    <button type="submit" class="btn btn-default ">Submit</button>
<?= form_close() ?>