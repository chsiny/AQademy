<!DOCTYPE html>
<html>
<head>
    <!-- week 6  -->
    <title>Email</title>
</head>
    <body>
    <?= form_open('email/send') ?>
        <div class="form-group">
            <label for="receiver">To:</label>
            <input type="email" name="receiver" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sender">From:</label>
            <input type="email" name="sender" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
    <?= form_close() ?>
    </body>
</html>