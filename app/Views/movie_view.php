<!DOCTYPE html>
<html>
    <head>
        <title>MongoDB Mnipulation in CI4</title>
</head>
<body>
    <h1>MongoDB Manipulation:</h1>

    <?php
    // echo $mvs;
    foreach($mvs as $m)
    {
        echo 'Title: '.$m->title.'('.$m->year.')'.' made in '.$m->countries[0];
        echo '<hr>';
    }
    ?>
    </body>
    </html>