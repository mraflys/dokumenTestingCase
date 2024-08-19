<?php
if (isset($_POST['submit'])) {
    $target_dir = "./uploads/";
    
    // Create target directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $FileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    // Validate file types
    if ($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif") {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
    // Save the files
    $file_target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_target_file)) {
        echo "The files have been uploaded.";
    }
    if (file_exists($file_target_file)) {
        echo "The files have been uploaded.";
    }
    echo "OK";
}
?>
