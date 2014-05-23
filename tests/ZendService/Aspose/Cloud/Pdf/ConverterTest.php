<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */

namespace ZendServiceTest\Aspose\Cloud\Pdf;

use ZendService\Aspose\Cloud\Pdf\Converter;
use Zend\Http\Client as HttpClient;
use PHPUnit_Framework_TestCase as TestCase;


class ConverterTest extends TestCase
{

    public function testConvertToImagebySize()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $converter = new Converter(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $converter->setFileName('test_file_on_storage.pdf');

        $converter->convertToImagebySize('1','gif','400','500');

        $this->assertFileExists(__DIR__ . '\\_files\\outputFolder\\test_file_on_storage_1.gif');

    }

    public function testConvertToImage()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $converter = new Converter(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $converter->setFileName('aspose_form.pdf');

        $converter->convertToImage('1','jpeg');

        $this->assertFileExists(__DIR__ . '\\_files\\outputFolder\\aspose_form_1.jpeg');

    }

    public function testConvertByUrl()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $converter = new Converter(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $converter->setSaveFormat('tiff');
        $converter->convertByUrl('http://manual.deltascripts.com/docs//18.pdf','tiff','AsposeBlog.tiff');

        $this->assertFileExists(__DIR__ . '\\_files\\outputFolder\\AsposeBlog.tiff');

    }

    public function testConvert()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $converter = new Converter(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $converter->setFileName('test_file_on_storage.pdf');
        $converter->setSaveFormat('tiff');
        $converter->convert();

        $this->assertFileExists(__DIR__ . '\\_files\\outputFolder\\test_file_on_storage.tiff');
    }

    public function testConvertLocalFile()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $converter = new Converter(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $inputFileName = __DIR__ . '\\_files\\inputFolder\\test_file.pdf';

        $converter->convertLocalFile($inputFileName,'AsposeTestFile.doc','doc');

        $this->assertFileExists(__DIR__ . '\\_files\\outputFolder\\AsposeTestFile.doc');


    }



}
