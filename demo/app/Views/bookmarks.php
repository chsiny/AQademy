<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
        <h1>Bookmarks:</h1>
        </div>
    </div>
    <br>

    <div class="row post-container">
    <?php if ($posts) : ?>
        <?php foreach ($posts as $post) : ?>
            <?php if ($post['isComment'] == 0) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $post['title'] ?>
                                <a href="<?php echo base_url('bookmarks/' . $post['postId']); ?>" data-post-id="<?= $post['postId'] ?>" class="bookmarkDeleteBtn btn btn-outline-danger btn-sm float-right">Delete</a>
                            </h5>
                            <p class="card-text">By <?= $post['username'] ?></p>
                            <p style="font-size:12px" class="card-text"><?= $post['datetime'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('post/' . $post['postId']); ?>" class="btn btn-sm btn-outline-info">View</a>
                                </div>
                                <small class="text-muted">Likes: <?= $post['upvotes'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
      <p>No bookmarks yet.</p>
    <?php endif; ?>

    </div>

</div>