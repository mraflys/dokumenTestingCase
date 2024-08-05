<?php

use PHPUnit\Framework\TestCase;

class ImageUploadTest extends TestCase
{
    public function testImageUpload()
    {
        // Dummy test to ensure PHPUnit is working correctly
        $this->assertTrue(true);
    }

    public function testImageFileExists()
    {
        // Check if the uploaded image file exists in the uploads directory
        $uploadedImagePath = __DIR__ . '/../uploads/test_image.jpg';
        $this->assertFileExists($uploadedImagePath, 'The uploaded image file does not exist.');
    }

    public function testTestCaseFileExists()
    {
        // Check if the uploaded test case file exists in the uploads directory
        $uploadedTestCasePath = __DIR__ . '/../uploads/test_case.php';
        $this->assertFileExists($uploadedTestCasePath, 'The uploaded test case file does not exist.');
    }
}
