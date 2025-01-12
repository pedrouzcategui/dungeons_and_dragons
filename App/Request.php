<?php

namespace App;

class Request
{
    private $post;
    private $get;
    private $files;
    private $server;
    private $params;
    private $rawBody;

    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
        $this->server = $_SERVER;

        // Load raw input for JSON or other payloads
        $this->rawBody = file_get_contents('php://input');
    }

    public function input($key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function post($key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function get($key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function file($key)
    {
        return $this->files[$key] ?? null;
    }

    public function server($key, $default = null)
    {
        return $this->server[$key] ?? $default;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    // This function gets params from the URL
    public function getParam($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    // New: Get raw body data (useful for JSON payloads)
    public function getBody()
    {
        $contentType = $this->server('CONTENT_TYPE', '');

        if (strpos($contentType, 'application/json') !== false) {
            return json_decode($this->rawBody, true); // Decode JSON into an associative array
        }

        // Return raw body as a string for non-JSON content types
        return $this->rawBody;
    }
}
