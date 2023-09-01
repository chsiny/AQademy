<div class="container mt-5">
<h1>User Profile</h1>
<br><br>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
      <!-- <h1>User Profile</h1> -->
      <div class="profile-picture">
        <!-- <img src="<?php echo base_url('writable/uploads/328792.jpeg'); ?>" alt="Profile Picture" width="200" height="200"> -->
        <?php if ($user->profilePicture): ?>
          <img src="<?php echo base_url('writable/uploads/' . $user->profilePicture); ?>" alt="Profile Picture" width="200" height="200">
        <?php else: ?>
          <img src="<?php echo base_url('writable/uploads/328792.jpeg'); ?>" alt="Default Profile Picture" width="200" height="200">
        <?php endif; ?>
      </div>

<?php if (isset($validation)): ?>
  <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>
<!-- <?php echo form_open_multipart(base_url() . 'upload/profile_picture'); ?>
    <div class="form-group">
        <label for="profile-picture">Profile Picture</label>
        
        <input type="file" name="profile_picture" id="profile-picture" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Upload Profile Picture</button> -->
    <form method="post" action="<?php echo base_url() . 'upload/profile_picture'; ?>" id="upload-form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="profile-picture">Profile Picture</label>
        <div class="dropzone" id="dropzone">
            <p>Drag and drop image here or click to select image</p>
            <input type="file" name="profile_picture" id="profile-picture" class="form-control-file">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Upload Profile Picture</button>
</form>



<!-- <?php echo form_close(); ?> -->
        <div class="card-header"><?php echo $user->username; ?>'s Profile</div>
        <div class="card-body">
          <p><strong>Username:</strong> <?php echo $user->username; ?></p>
          <p><strong>Email:</strong> <?php echo $user->email; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    // Get the dropzone element
    var dropzone = document.getElementById('dropzone');

    // Prevent default behavior for drag and drop events
    dropzone.addEventListener('dragenter', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    dropzone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var files = e.dataTransfer.files;
        var input = document.getElementById('profile-picture');
        input.files = files;
    });

    // Submit the form when the button is clicked
    document.getElementById('upload-form').addEventListener('submit', function(e) {
        // Check if files were selected through drag and drop
        var input = document.getElementById('profile-picture');
        if (input.files.length === 0) {
            e.preventDefault();
            alert('Please select a file to upload.');
        }
    });
</script>
