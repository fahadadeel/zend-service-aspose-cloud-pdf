<?php

namespace ZendService\Aspose\Cloud\Pdf;
use ZendService\Aspose\Cloud\Exception\InvalidArgumentException;
use Zend\Http\Client as HttpClient;


class Converter extends AbstractAsposeApp {

    /**
     * fileName .
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $fileName = null;

    /**
     * saveFormat, format for the output file.
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $saveFormat = 'pdf';


    /**
     * Constructor.
     *
     * pass an array of options or Traversable object.
     *
     * @param  array|Traversable $options
     * @since  AsposeCloud 1.1
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
    }

    /**
     * Set File Name.
     *
     * @param  FileName $fileName
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this->fileName;
    }

    /**
     * Get File Name.
     *
     * @return fileName
     * @since  AsposeCloud 1.1
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set Save Format.
     *
     * @param  SaveFormat $saveFormat
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function setSaveFormat($saveFormat)
    {
        $this->saveFormat = $saveFormat;

        return $this->saveFormat;
    }

    /**
     * Get Save Format.
     *
     * @return saveFormat
     * @since  AsposeCloud 1.1
     */
    public function getSaveFomrat()
    {
        return $this->saveFormat;
    }

    /*
     * convert a particular page of pdf from storage to image with specified size
     * @param string $pageNumber
     * @param string $imageFormat
     * @param string $width
     * @param string $height
     */
    public function convertToImagebySize($pageNumber, $imageFormat, $width, $height)
    {
        //check whether file is set or not
        if ($this->fileName == '')
            throw new InvalidArgumentException('No file name specified');

        // build request uri
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages/' . $pageNumber . '?format=' . $imageFormat . '&width=' . $width . '&height=' . $height;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);
        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');
        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = $this->outputPath . Utils::getFileName($this->fileName) . '_' . $pageNumber . '.' . $imageFormat;

            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }
        else
            return $v_output;

    }

    /*
     * convert a particular page of pdf from storage to image with default size
     * @param string $pageNumber
     * @param string $imageFormat
     */

    public function convertToImage($pageNumber, $imageFormat)
    {
        //check whether file is set or not
        if ($this->fileName == '')
            throw new \Exception('No file name specified');

        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages/' . $pageNumber . '?format=' . $imageFormat;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);
        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');
        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = $this->outputPath . Utils::getFileName($this->fileName) . '_' . $pageNumber . '.' . $imageFormat;

            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }
        else
            return $v_output;
    }

    /*
    * convert a document by url to SaveFormat
    * @param string $url
    * @param string $format
    * @param string $outputFilename
    */

    public function convertByUrl($url='',$format='',$outputFilename='')
    {
        //check whether file is set or not
        if ($url == '')
            throw new InvalidArgumentException('Url not specified');

        $uri = $this->productUri . '/pdf/convert?url=' . $url . '&format='.$format;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        $responseStream = $this->httpClient->send()->getBody();


        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $this->saveFormat;
            }

            $outputPath = Utils::saveFile($responseStream, $this->outputPath . Utils::getFileName($outputFilename) . '.' . $format);

            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /*
    * convert a document to SaveFormat
    *
    */

    public function convert()
    {
        //check whether file is set or not
        if ($this->fileName == '')
            throw new InvalidArgumentException('No file name specified');

        $uri = $this->productUri . '/pdf/' . $this->fileName . '?format=' . $this->saveFormat;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $this->saveFormat;
            }

            $outputPath = Utils::saveFile($responseStream, $this->outputPath . Utils::getFileName($this->fileName) . '.' . $saveFormat);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /*
     * Convert PDF to different file format without using storage
     * $param string $inputFile
     * @param string $outputFilename
     * @param string $outputFormat
    */

    public function convertLocalFile($inputFile = '', $outputFilename = '', $outputFormat = '')
    {
        //check whether file is set or not
        if ($inputFile == '')
            throw new InvalidArgumentException('No file name specified');

        if ($outputFormat == '')
            throw new InvalidArgumentException('output format not specified');

        if (!file_exists($inputFile)) {
            throw new InvalidArgumentException('input file doesnt exist.');
        }


        $uri = $this->productUri . '/pdf/convert?format=' . $outputFormat;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        $responseStream = $this->httpClient->setFileUpload($inputFile, $outputFilename)->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            if ($outputFilename == '') {
                $outputFilename = Utils::getFileName($inputFile) . '.' . $saveFormat;
            }
            $outputPath = $this->outputPath . $outputFilename;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }
        else
            return $v_output;
    }

}