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

use ZendService\Aspose\Cloud\Pdf\Document;
use Zend\Http\Client as HttpClient;
use PHPUnit_Framework_TestCase as TestCase;


class DocumentTest extends TestCase
{

    public function testGetPageCount()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $document->setFileName('test_file.pdf');

        $result = $document->getPageCount();

        $this->assertInternalType('int',$result);

    }

    public function testAppendDocument()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $document->setFileName('test_file.pdf');

        $result = $document->appendDocument('test_file.pdf','test_file_on_storage.pdf');

        $this->assertTrue(true,$result);
    }

    public function testCreateFromHtml()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $result = $document->createFromHtml('aspose_test.pdf','aspose_test.html');

        $this->assertTrue(true,$result);
    }

    public function testCreateFromXml()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $result = $document->createFromXml('Simple.pdf','Simple.xslt','Simple.xml');

        $this->assertTrue(true,$result);

    }

    public function testGetFormFieldCount()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('Fields.pdf');

        $result = $document->getFormFieldCount();

        $this->assertInternalType('int',$result);

    }

    public function testGetFormFields()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('Fields.pdf');

        $result = $document->getFormFields();

        $this->assertInternalType('array',$result);

    }

    public function testGetFormField()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('Fields_filled.pdf');

        $result = $document->getFormField('Your_First_Name');

        $this->assertInstanceOf('stdClass',$result);
    }

    public function testCreateEmptyPdf()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $result = $document->createEmptyPdf('Aspose_new_pdf.pdf');

        $this->assertTrue(true,$result);

    }

    public function testAddNewPage()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('Aspose_new_pdf');

        $result = $document->addNewPage();

        $this->assertTrue(true,$result);
    }

    public function testDeletePage()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('Fields_filled.pdf');

        $result = $document->deletePage('1');

        $this->assertTrue(true,$result);

    }

    public function testMovePage()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->movePage('1','2');

        $this->assertTrue(true,$result);

    }

    public function testGetDocumentProperties()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->getDocumentProperties();

        $this->assertInternalType('array',$result);
    }

    public function testGetDocumentProperty()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->getDocumentProperty('Author');

        $this->assertInstanceOf('stdClass',$result);
    }

    public function testRemoveAllProperties()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->removeAllProperties();

        $this->assertTrue(true,$result);

    }

    public function testSplitAllPages()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->splitAllPages();

        $this->assertTrue(true,$result);

    }

    public function testSplitPages()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->splitPages('2','3');

        $this->assertTrue(true,$result);
    }

    public function testSplitPagesToAnyFormat()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $document = new Document(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));

        $document->setFileName('aspose_form.pdf');

        $result = $document->splitPagesToAnyFormat('2','3','gif');

        $this->assertTrue(true,$result);


    }


}
