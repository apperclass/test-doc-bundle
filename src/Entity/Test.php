<?php

namespace Apperclass\TestDocBundle\Entity;

/**
 * Class Test
 *
 * @package Apperclass\TestDocBundle\Entity
 */
class Test
{


    const SHORTCUT_CLASS_NAME = 'ApperclassTestDocBundle:Test';
    const CLASS_NAME = 'Apperclass\\TestDocBundle\\Entity\\Test';

    /** @var integer */
    protected $id;
    /** @var string  */
    protected $url;
    /** @var string */
    protected $requestHeader;
    /** @var string */
    protected $requestBody;
    /** @var string */
    protected $responseHeader;
    /** @var string */
    protected $responseBody;
    /** @var string */
    protected $method;
    /** @var integer */
    protected $statusCode;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $requestBody
     */
    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
    }

    /**
     * @return string
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @param string $requestHeader
     */
    public function setRequestHeader($requestHeader)
    {
        $this->requestHeader = $requestHeader;
    }

    /**
     * @return string
     */
    public function getRequestHeader()
    {
        return $this->requestHeader;
    }

    /**
     * @param string $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param string $responseHeader
     */
    public function setResponseHeader($responseHeader)
    {
        $this->responseHeader = $responseHeader;
    }

    /**
     * @return string
     */
    public function getResponseHeader()
    {
        return $this->responseHeader;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }



}