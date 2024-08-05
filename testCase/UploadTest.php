<?php
use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
    private $uploadDir = __DIR__ . '/../uploads/';
    private $imagePath = __DIR__ . '/test_image.jpg';
    private $testCasePath = __DIR__ . '/test_case.php';
    private $uploadScript = __DIR__ . '/../upload.php';

    protected function setUp(): void
    {
        // Ensure the upload directory exists
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        // Create a dummy image file
        file_put_contents($this->imagePath, '');
        // Create a dummy test case file
        file_put_contents($this->testCasePath, '<?php class DummyTest extends \PHPUnit\Framework\TestCase { public function testDummy() { $this->assertTrue(true); } }');
    }

    protected function tearDown(): void
    {
        // Clean up the uploaded files and directories
        array_map('unlink', glob($this->uploadDir . '*'));
        @rmdir($this->uploadDir);
        @unlink($this->imagePath);
        @unlink($this->testCasePath);
    }

    public function testUploadFiles()
    {
        $_FILES['image'] = [
            'name' => 'test_image.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => $this->imagePath,
            'error' => UPLOAD_ERR_OK,
            'size' => filesize($this->imagePath),
        ];

        $_FILES['testcase'] = [
            'name' => 'test_case.php',
            'type' => 'application/x-php',
            'tmp_name' => $this->testCasePath,
            'error' => UPLOAD_ERR_OK,
            'size' => filesize($this->testCasePath),
        ];

        $_POST['submit'] = 'Upload';

        // Capture the output of the upload script
        ob_start();
        include $this->uploadScript;
        $output = ob_get_clean();

        // Assert that the output contains the expected success message
        $this->assertStringContainsString('The files have been uploaded.', $output);

        // Assert that the files were moved to the correct location
        $this->assertFileExists($this->uploadDir . 'test_image.jpg');
        $this->assertFileExists($this->uploadDir . 'test_case.php');

        // Assert that PHPUnit was executed and returned a successful result
        $this->assertStringContainsString('OK', $output);
    }
}
