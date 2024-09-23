<?php
use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
    private $uploadDir = __DIR__ . '/../uploads/';
    private $imagePath = __DIR__ . '/test_image.jpg';
    private $testCasePath = __DIR__ . '/test_case.php';
    private $uploadScript = __DIR__ . '/../controllers/upload.php';

    public function testUploadFiles()
    {
        $fileName = 'test_image.jpg';
        $filePath = $this->uploadDir . './' . $fileName;
        file_put_contents($filePath, 'test content'); 
        $_FILES['file'] = [
            'name' => 'test_image.jpg',
            'type' => 'image/png',
            'tmp_name' => $filePath,
            'error' => UPLOAD_ERR_OK,
            'size' => filesize($filePath),
        ];        
        $_POST['submit'] = 'Upload';
        // Capture the output of the upload script
        ob_start();
        include $this->uploadScript;
        $output = ob_get_clean();
        // Assert that the output contains the expected success message
        $this->assertStringContainsString('The files have been uploaded.', $output);

        // Assert that the files were moved to the correct location
        $this->assertFileExists($this->uploadDir . $fileName);

        // Assert that PHPUnit was executed and returned a successful result
        $this->assertStringContainsString('OK', $output);
    }
}
