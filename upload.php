<?php
if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    
    // Create target directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $testCaseFileType = strtolower(pathinfo($_FILES["testcase"]["name"], PATHINFO_EXTENSION));

    // Validate file types
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
    if ($testCaseFileType != "php") {
        die("Sorry, only PHP files are allowed for test cases.");
    }

    // Save the files
    $image_target_file = $target_dir . basename($_FILES["image"]["name"]);
    $testcase_target_file = $target_dir . basename($_FILES["testcase"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_target_file) &&
        move_uploaded_file($_FILES["testcase"]["tmp_name"], $testcase_target_file)) {
        echo "The files have been uploaded.";

        // Run PHPUnit on the uploaded test case
        $command = "phpunit " . escapeshellarg($testcase_target_file);
        $output = shell_exec($command);
        echo "<pre>$output</pre>";
    } else {
        echo "Sorry, there was an error uploading your files.";
    }
}
?>
