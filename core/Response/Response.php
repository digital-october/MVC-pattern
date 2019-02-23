<?php
/**
 * Created by PhpStorm.
 * User: friday
 * Date: 25.06.2017
 * Time: 12:45
 */

namespace Core\Response;

class Response
{
    protected $headers = [];
    protected $response;
    protected $statusCode = 200;

    public function header($headers)
    {
        if (is_array($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }
        return $this;
    }

    public function setStatusCode($code = 200)
    {
        $this->statusCode = $code;
        return $this;
    }

    public function exec()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
        http_response_code($this->statusCode);
    }

    public function setBody($mixed)
    {
        $this->body = $mixed;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

}