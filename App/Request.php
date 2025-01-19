<?php

namespace App;

class Request
{
    private $post;
    private $get;
    private $server;
    private $params;
    private $rawBody;

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function getGet()
    {
        return $this->get;
    }

    public function setGet($get)
    {
        $this->get = $get;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function setServer($server)
    {
        $this->server = $server;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getRawBody()
    {
        return $this->rawBody;
    }

    public function setRawBody($rawBody)
    {
        $this->rawBody = $rawBody;
    }

    public function __construct()
    {
        $this->setPost($_POST);
        $this->setGet($_GET);
        $this->setServer($_SERVER);
        $this->setRawBody(file_get_contents('php://input'));
    }

    // Funcion genérica para obtener datos del body.
    public function input($key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    // Funcion genérica para obtener datos del body SOLO si es mediante el verbo POST.
    public function post($key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    // Funcion genérica para obtener datos del body SOLO si es mediante el verbo GET.
    public function get($key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    // Funcion para obtener llaves del objeto SERVER
    public function server($key, $default = null)
    {
        return $this->server[$key] ?? $default;
    }

    // Funcion para obtener algun parametro del objeto params (helper usado en las rutas)
    public function getParam($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    // Obtiene el body de requests de tipo JSON.
    public function getBody()
    {
        $contentType = $this->server('CONTENT_TYPE', '');

        if (strpos($contentType, 'application/json') !== false) {
            return json_decode($this->rawBody, true);
        }

        return $this->rawBody;
    }
}
