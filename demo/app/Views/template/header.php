<html>
        <head>
                <title>AQademy</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <link rel="icon" href="<?php echo base_url("app/Views/images/a.ico"); ?>">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                <script src="<?php echo base_url('/assets/js/search-box.js'); ?>"></script>
                <script>
                    var searchUrl = "<?php echo base_url('/autocomplete'); ?>";
                </script>
                <script>
                    var postUrl = "<?php echo base_url('/post/')?>";
                </script>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <script>
                    function onSubmit(token) {
                        document.getElementById("demo-form").submit();
                    }
                </script>
                <style>
    #dropzone {
        border: 2px dashed #ccc;
        padding: 20px;
        width: 700px; /* Adjust the width as needed */
        margin-bottom: 20px;
        text-align: center;
    }

    #dropzone p {
        margin-top: 0;
    }
</style>
        </head>
        <body class="bg-light">
            <script>
                // Show select image using file input.
                function readURL(input) {
                    $('#default_img').show();
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#select')
                                .attr('src', e.target.result)
                                .width(300)
                                .height(200);

                        };

                        reader.readAsDataURL(input. files[0]);
                    }
                }
                $(document).ready(function() {
                    var scrollPosition = sessionStorage.getItem('scrollPosition');
                    if (scrollPosition != null) {
                        $(window).scrollTop(scrollPosition);
                        sessionStorage.removeItem('scrollPosition');
                    }
                });
            </script>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <!-- <a class="navbar-brand" href="#">
                    <img src="../app/Views/images/a.jpg" width="30" height="30" class="d-inline-block align-top" alt="">AQademy
                </a> -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>">AQademy</a>
                <?php if (session()->get('username')) { ?>
                    <form class="form-inline my-2 my-lg-0" action="<?= base_url('/searchPosts') ?>" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search-box" name="searchTitle">
                        <input type="hidden" id="post-id" name="postId">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    
                    <ul class="navbar-nav ml-auto">

                        <?php if (session()->get('username')) { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('/login'); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Notification</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                User
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>bookmarks">Bookmarks</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>user">Setting</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>login/logout"> Logout </a></li>
                                <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                </ul>
                            </li>

                        
                        <?php } else { ?>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('user/register_page'); ?>">Register</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
            
            <div class="container">


