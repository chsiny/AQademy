<?= validation_list_errors() ?>

<?php echo form_open(base_url().'user/reset_password'); ?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="newPassword">Password</label>
        <input type="password" name="newPassword" class="form-control">
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Reset password</button>
<?php echo form_close(); ?>