$(document).ready(function() {
    $('button#upvote-btn').click(function(e) {
      e.preventDefault(); // prevent default form submission
      var post_id = $(this).data('post-id'); // get the post ID from the button data attribute
      var url = $(this).data('url'); // get the URL to send the AJAX request to from the button data attribute
      var btn = $(this); // store the button element in a variable
      $.ajax({
        type: 'POST',
        url: url,
        data: { 'post_id': post_id },
        success: function(response) {
            console.log(response); // debug statement
            if (response.success) {
                var upvotes = parseInt(response.upvotes);
                $('small#upvote').text(upvotes);
                btn.prop('disabled', true); // disable the button after upvoting
            }
          },
        error: function() {
          alert('Error upvoting post.'); // display an error message if the AJAX request fails
        }
      });
    });
  });