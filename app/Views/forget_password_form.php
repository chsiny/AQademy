<?= form_open(base_url('send_verification')) ?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" class="form-control"required></input>
    </div>
    <button type="submit" class="btn btn-primary">Send Verification</button>
<?= form_close() ?>