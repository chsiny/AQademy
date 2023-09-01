<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors during file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
      $tempFilePath = $file['tmp_name'];
      $destination = 'uploads/' . $file['name'];

      // Move the uploaded file to the desired destination
      move_uploaded_file($tempFilePath, $destination);

      echo 'File uploaded successfully.';
    } else {
      echo 'Error uploading the file.';
    }
  }
}
?>