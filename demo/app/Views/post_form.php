<br>
<br>
<div class="row">
    <div class="col-md-12">
      <h1>Add a new post:</h1>
    </div>
  </div>
  <br>

<form method="post" action="<?php echo base_url('addPost/create_post'); ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <?php if (isset($validation)): ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <br>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
<!-- <script src="<?php echo base_url('/assets/js/dropzone.js'); ?>"></script> -->