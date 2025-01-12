<?php

namespace App;

use App\Views\View;

class Router
{
    protected $routes = [];
    protected $params = [];


    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getParam($key)
    {
        return $this->params[$key] ?? null;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute('GET', $route, $controller, $action);
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute('POST', $route, $controller, $action);
    }

    public function put($route, $controller, $action)
    {
        $this->addRoute('PUT', $route, $controller, $action);
    }

    public function delete($route, $controller, $action)
    {
        $this->addRoute('DELETE', $route, $controller, $action);
    }

    protected function addRoute($method, $route, $controller, $action)
    {
        // Convert route parameters (e.g., :id) to regex patterns
        $pattern = preg_replace('/:[a-zA-Z0-9_]+/', '([^/]+)', $route);
        $this->routes[$method][$pattern] = [
            'controller' => $controller,
            'action' => $action,
            'original' => $route
        ];
    }

    public function dispatch($uri, $method)
    {
        $request = new Request();

        if (!isset($this->routes[$method])) {
            View::render('405.php');
            return;
        }

        foreach ($this->routes[$method] as $pattern => $route) {
            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match
                $routeParams = [];

                // Map route keys to matched values
                preg_match_all('/:([a-zA-Z0-9_]+)/', $route['original'], $paramKeys);
                if (!empty($paramKeys[1])) {
                    foreach ($paramKeys[1] as $index => $key) {
                        $routeParams[$key] = $matches[$index] ?? null;
                    }
                }

                $controller = new $route['controller']();
                $request->setParams($routeParams);

                $action = $route['action'];
                $controller->$action($request);
                return;
            }
        }

        View::render('404');
    }
}
