<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image and Test Case</title>
</head>
<body>
    <h2>Upload Image and Test Case</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">Select image to upload:</label>
        <input type="file" name="image" id="image" accept="image/*"><br><br>
        
        <label for="testcase">Select test case to upload:</label>
        <input type="file" name="testcase" id="testcase" accept=".php"><br><br>
        
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>