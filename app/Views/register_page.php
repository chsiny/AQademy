<?= validation_list_errors() ?>

<?php echo form_open(base_url().'user/register'); ?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
<?php echo form_close(); ?>