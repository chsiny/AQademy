<?php
// Check if file was uploaded successfully
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // File upload successful
        echo "File uploaded successfully";
    } else {
        // File upload failed
        echo "Error uploading file";
    }
} else {
    // No file uploaded or error occurred
    echo "No file uploaded or error occurred";
}
?>