<?php

include_once realpath('../../../../Bootstrap.php');


/**
 * Managing Files using Aspose Cloud Pdf
 *
 * The primary goal of the Zend Framework Aspose Cloud Pdf component is to convert pdf file into different formats.
 *
 * In this demo application, Pdf file is converted to image by size.
 *

 */
 
use ZendService\Aspose\Cloud\Pdf\Converter;
use Zend\Http\Client as HttpClient;

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
var_dump($converter->convertByUrl('http://manual.deltascripts.com/docs//18.pdf','tiff','AsposeBlog.tiff'));