<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Form</title>
</head>
<body>

<?php if (isset($validation)): ?>
  <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>
<?= form_open_multipart(base_url() . 'upload/upload_file') ?>
    <label for="title">Item Name</label>
    <input type="text" name="title" size="20">
    <br><br>
    <input type="file" name="userfile" size="20">
    <br><br>
    <input type="submit" value="upload">
</form>

</body>
</html>


