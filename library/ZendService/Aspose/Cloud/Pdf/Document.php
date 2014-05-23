<?php

namespace ZendService\Aspose\Cloud\Pdf;
use Zend\Http\Client as HttpClient;
use ZendService\Aspose\Cloud\Exception\InvalidArgumentException;

class Document extends AbstractAsposeApp {

    /**
     * fileName .
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $fileName = null;

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


    /*
     * Gets the page count of the specified PDF document
     */
    public function getPageCount()
    {
        //build URI
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        return count($json->Pages->List);
    }

    /*
     * Merges two PDF documents
     * @param string $basePdf (name of the base/first PDF file)
     * @param string $newPdf (name of the second PDF file to merge with base PDF file)
     * @param string $startPage (page number to start merging second PDF: enter 0 to merge complete document)
     * @param string $endPage (page number to end merging second PDF: enter 0 to merge complete document)
     * @param string $sourceFolder (name of the folder where base/first and second input PDFs are present)
     */
    public function appendDocument($basePdf, $newPdf, $startPage = 0, $endPage = 0, $sourceFolder = '')
    {
        //check whether files are set or not
        if ($basePdf == '')
            throw new InvalidArgumentException('Base file not specified');
        if ($newPdf == '')
            throw new InvalidArgumentException('File to merge is not specified');

        //build URI to merge PDFs
        if ($sourceFolder == '')
            $uri = $this->productUri . '/pdf/' . $basePdf .
                    '/appendDocument?appendFile=' . $newPdf . ($startPage > 0 ? '&startPage=' . $startPage : '' ) .
                    ($endPage > 0 ? '&endPage=' . $endPage : '' );
        else
            $uri = $this->productUri . '/pdf/' . $basePdf .
                    '/appendDocument?appendFile=' . $sourceFolder . '/' . $newPdf .
                    ($startPage > 0 ? '&startPage=' . $startPage : '' ) .
                    ($endPage > 0 ? '&endPage=' . $endPage : '' ) .
                    '&folder=' . $sourceFolder;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('post');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        if ($json->Code == 200)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
     * Creates a PDF from HTML
     * @param string $pdfFileName (name of the PDF file to create)
     * @param string $htmlFileName (name of the HTML template file)
     */
    public function createFromHtml($pdfFileName, $htmlFileName)
    {
        //check whether files are set or not
        if ($pdfFileName == '')
            throw new InvalidArgumentException('PDF file name not specified');
        if ($htmlFileName == '')
            throw new InvalidArgumentException('HTML template file name not specified');

        //build URI to create PDF
        $uri = $this->productUri . '/pdf/' . $pdfFileName .
                '?templateFile=' . $htmlFileName . '&templateType=html';

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '')
        {
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Creates a PDF from XML
     * @param string $pdfFileName (name of the PDF file to create)
     * @param string $xsltFileName (name of the XSLT template file)
     * @param string $xmlFileName (name of the XML file)
     */
    public function createFromXml($pdfFileName, $xsltFileName, $xmlFileName)
    {
        //check whether files are set or not
        if ($pdfFileName == '')
            throw new InvalidArgumentException('PDF file name not specified');
        if ($xsltFileName == '')
            throw new InvalidArgumentException('XSLT file name not specified');
        if ($xmlFileName == '')
            throw new InvalidArgumentException('XML file name not specified');

        //build URI to create PDF
        $uri = $this->productUri . '/pdf/' . $pdfFileName . '?templateFile=' .
                $xsltFileName . '&dataFile=' . $xmlFileName . '&templateType=xml';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '')
        {

            return true;
        }
        else
            return $v_output;
    }

    /*
     * Gets the FormField count of the specified PDF document
     */
    public function getFormFieldCount()
    {
        //build URI
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/fields';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

       $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        return count($json->Fields->List);
    }

    /*
     * Gets the list of FormFields from the specified PDF document
     */
    public function getFormFields()
    {
        //build URI
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/fields';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        return $json->Fields->List;
    }

    /*
     * Gets a particular form field
     * $fieldName
     */
    public function getFormField($fieldName)
    {
        //build URI
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/fields/' . $fieldName;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        return $json->Field;
    }

    /*
     * Creates an Empty Pdf document
     * @param string $pdfFileName (name of the PDF file to create)
     */
    public function createEmptyPdf($pdfFileName)
    {
        //check whether files are set or not
        if ($pdfFileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to create PDF
        $uri = $this->productUri . '/pdf/' . $pdfFileName;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save PDF file on server
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Adds new page to opened Pdf document
     */
    public function addNewPage()
    {
        //check whether files are set or not
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to add page
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('put');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save PDF file on server
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Deletes selected page from Pdf document
     * $pageNumber
     */
    public function deletePage($pageNumber)
    {
        //check whether files are set or not
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to delete page
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages/' . $pageNumber;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('delete');

        //get response stream
        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save PDF file on server
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Moves selected page in Pdf document to new location
     * $pageNumber
     * $newLocation
     */
    public function movePage($pageNumber, $newLocation)
    {
        //check whether files are set or not
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to move page
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/pages/' . $pageNumber .
                '/movePage?newIndex=' . $newLocation;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('post');

        $responseStream = $this->httpClient->send()->getBody();

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save PDF file on server
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Get all the properties of the specified document	
     */
    public function getDocumentProperties()
    {
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to replace image
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/documentProperties';

            //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        $responseStream = $this->httpClient->send()->getBody();

        $response_arr = json_decode($responseStream);

        return $response_arr->DocumentProperties->List;
    }

    /*
     * Get specified properity of the document	
     * @param string $propertyName
     */
    public function getDocumentProperty($propertyName = '')
    {
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        if ($propertyName == '')
            throw new InvalidArgumentException('Property name not specified');

        //build URI to replace image
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/documentProperties/' . $propertyName;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('get');

        $responseStream = $this->httpClient->send()->getBody();

        $response_arr = json_decode($responseStream);

        return $response_arr->DocumentProperty;
    }

    /*
     * Remove all properties of the document	
     */
    public function removeAllProperties()
    {
        if ($this->fileName == '')
            throw new InvalidArgumentException('PDF file name not specified');

        //build URI to replace image
        $uri = $this->productUri . '/pdf/' . $this->fileName . '/documentProperties';

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('DELETE');

        $responseStream = $this->httpClient->send()->getBody();

        $response_arr = json_decode($responseStream);

        return $response_arr->Code == 200 ? true : false;
    }

    public function splitAllPages()
    {
        if ($this->fileName == '') {
            throw new InvalidArgumentException('File name not specified');
        }

        $uri = $this->productUri . '/pdf/' . $this->fileName . '/split';

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('post');

        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);
        $i = 1;

        if(is_array($json->Result->Documents))
        {
            foreach ($json->Result->Documents as $splitPage)
            {
                $splitFileName = basename($splitPage->Href);
                $uri = $this->productUri . '/storage/file/' . $splitFileName;

                $uri = Utils::sign($uri, $this->appSid, $this->appKey);

                $this->httpClient->setUri($uri);

                $this->httpClient->setMethod('get');

                $responseStream = $this->httpClient->send()->getBody();

                $fileName = $this->fileName . '_' . $i . '.pdf';
                $outputFile = $this->outputPath . $fileName;
                Utils::saveFile($responseStream, $outputFile);

                $i++;
            }
            return true;
        }
        else
        {
            return false;
        }

    }

    public function splitPages($from, $to)
    {
        if ($this->fileName == '') {
            throw new InvalidArgumentException('File name not specified');
        }

        $uri = $this->productUri . '/pdf/' . $this->fileName . '/split?from=' . $from . '&to=' . $to;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('post');

        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        $i = 1;

        if(is_array($json->Result->Documents))
        {
            foreach ($json->Result->Documents as $splitPage)
            {
                $splitFileName = basename($splitPage->Href);
                $uri = $this->productUri . '/storage/file/' . $splitFileName;

                $uri = Utils::sign($uri, $this->appSid, $this->appKey);

                $this->httpClient->setUri($uri);

                $this->httpClient->setMethod('get');

                $responseStream = $this->httpClient->send()->getBody();

                $fileName = $this->fileName . '_' . $i . '.pdf';
                $outputFile = $this->outputPath . $fileName;

                Utils::saveFile($responseStream, $outputFile);

                $i++;
            }

            return true;

        }
        else
        {
            return false;

        }

    }

    public function splitPagesToAnyFormat($from, $to, $format)
    {
        if ($this->fileName == '') {
            throw new InvalidArgumentException('File name not specified');
        }

        $uri = $this->productUri . '/pdf/' . $this->fileName . '/split?from=' . $from . '&to=' . $to . '&format=' . $format;

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);

        $this->httpClient->setMethod('post');

        $responseStream = $this->httpClient->send()->getBody();

        $json = json_decode($responseStream);

        $i = 1;

        if(is_array($json->Result->Documents))
        {
            foreach ($json->Result->Documents as $splitPage)
            {
                $splitFileName = basename($splitPage->Href);
                $uri = $this->productUri . '/storage/file/' . $splitFileName;

                $uri = Utils::sign($uri, $this->appSid, $this->appKey);

                $this->httpClient->setUri($uri);

                $this->httpClient->setMethod('get');

                $responseStream = $this->httpClient->send()->getBody();

                $fileName = $this->fileName . '_' . $i . '.' . $format;
                $outputFile = $this->outputPath . $fileName;

                Utils::saveFile($responseStream, $outputFile);

                $i++;
            }
            return true;
        }
        else
        {
            return false;
        }


    }

}