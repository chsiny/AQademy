<div class="container mt-3">
  <?php if ($post) : ?>
    <h1><?php echo $post->title; ?></h1>
    <p><?php echo $post->content; ?></p>
    <p>Posted by <?php echo $post->username; ?> on <?php echo date('F j, Y, g:i a', strtotime($post->datetime)); ?></p>
    <label>Likes: </label>
    <small id="upvote"><?= $post->upvotes ?></small>
    <br>
    <button id="upvote-btn" class="btn btn-primary" data-post-id="<?= $post->postId ?>" data-url="<?= base_url('/upvote/'.$post->postId) ?>">Upvote</button>
    <hr>
    <h3>Comments</h3>
    <?php if ($comments) : ?>
      <?php foreach ($comments as $comment) : ?>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title"><?php echo $comment['username']; ?></h5>
            <p class="card-text"><?php echo $comment['content']; ?></p>
            <p class="card-text"><small class="text-muted">Posted on <?php echo date('F j, Y, g:i a', strtotime($comment['datetime'])); ?></small></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No comments yet.</p>
    <?php endif; ?>
    <hr>
    <h4>Add a comment</h4>
    <form method="post" action="<?php echo base_url('comments/create'); ?>">
      <div class="form-group">
        <input type="hidden" name="postId" value="<?php echo $post->postId; ?>">
        <label for="content">Comment</label>
        <textarea class="form-control" name="content" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  <?php else : ?>
    <p>Post not found.</p>
  <?php endif; ?>
</div>

<script src="<?= base_url('assets/js/upvote.js') ?>"></script>