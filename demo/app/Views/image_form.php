<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Manipulation</title>
</head>
<body>
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>  
        <img src="<?php echo $original; ?>" alt="Original Image."> 
        <li>name: <?= esc($original_info->getBasename()) ?></li>
        <?php echo $original_info;?>
        <li>size: <?= esc($original_info->getSizeByUnit('kb')) ?> KB</li>
        <li>extension: <?= esc($original_info->guessExtension()) ?></li>        
        <img src="<?php echo $crop; ?>" alt="Cropped Image.">
        <img src="<?php echo $rot; ?>" alt="Rotated Image.">        
    <?php endif; ?>

    <?= form_open_multipart('image/upload') ?>
        <div class="form-group">
            <label for="image">Select an Image!!<br></label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Upload</button>
    <?= form_close() ?>
    <a href="<?php echo base_url('image/getFiles') ?>">Show All Image Files</a>
    <a href="<?php echo base_url('image/zipFiles') ?>">Zip All Image Files</a>
    <a href="<?php echo base_url('image/delFiles') ?>">Delete All Image Files</a>
    <?php if (isset($files)): ?>
        <h2>List of Files in Folder</h2>
	    <ul>
        <?php foreach ($files as $file): ?>
            <li><?php echo $file ?></li>
        <?php endforeach; ?>
        </ul>               
    <?php endif; ?>
    
</body>
</html>