<div class="container">
    <br><br>
  <div class="row">
    <div class="col-md-12">
      <h1>Posts</h1>
      <a href="<?php echo base_url('/addPost'); ?>" class="btn btn-primary float-right">Add New Post</a>
    </div>
  </div>
  <br>
    <div class="row post-container">
        <?php foreach ($posts as $post) : ?>
            <?php if ($post['isComment'] == 0) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $post['title'] ?>
                                <a data-post-id="<?= $post['postId'] ?>" class="bookmarkBtn btn btn-outline-success btn-sm float-right">Bookmark</a>
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
        <div id="loading-spinner" class="col-md-12 text-center" style="display:none;">
            <i class="fa fa-spinner fa-spin fa-3x"></i>
        </div>

    </div>

</div>

<script>
    
    var start = <?= count($posts) ?>;
  $(window).scroll(function() {

    console.log('scrolling');
    console.log($(document).height());
    console.log($(window).scrollTop());
    console.log($(window).height());
    console.log(start);
    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
    if($(window).scrollTop() + 752.01 > $(document).height()) {
        
        $('#loading-spinner').show();
           // ajax call get data from server and append to the div
        $.ajax({
            url: '<?= base_url('/posts/loadPosts') ?>',
            method: 'POST',
            data: {start:start},
            success: function(response){
                console.log(response);
                start += 3;
                $('.post-container').append(response);
                if(response.trim() == '') {
                    $('#load-more-btn').attr('disabled', true);
                }
            },
            complete: function() {
                // hide loading spinner
                $('#loading-spinner').hide();
            }
        });
    }
});
</script>


