<?php

namespace App;

use App\Views\View;

class Router
{

    // Existen rutas y parametros. Las rutas son strings que son almacenados para luego identificar la redirección a la vista correcta. Los parametros son valores dinámicos que pueden existir en dichas rutas.
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

    // Añade rutas de tipo GET
    public function get($route, $controller, $action)
    {
        $this->addRoute('GET', $route, $controller, $action);
    }

    // Añade rutas de tipo POST
    public function post($route, $controller, $action)
    {
        $this->addRoute('POST', $route, $controller, $action);
    }

    // Añade rutas de tipo PUT
    public function put($route, $controller, $action)
    {
        $this->addRoute('PUT', $route, $controller, $action);
    }

    // Añade rutas de tipo DELETE
    public function delete($route, $controller, $action)
    {
        $this->addRoute('DELETE', $route, $controller, $action);
    }

    // Función que se encarga de añadir rutas a la clase, al igual que convertir parámetros en keys del array.
    protected function addRoute($method, $route, $controller, $action)
    {
        $pattern = preg_replace('/:[a-zA-Z0-9_]+/', '([^/]+)', $route);
        $this->routes[$method][$pattern] = [
            'controller' => $controller,
            'action' => $action,
            'original' => $route
        ];
    }

    // Función que se usa para "despachar" una ruta. Es decir, para elegir cual ruta mostrar. En este caso realiza una busqueda dependiendo del patrón y del verbo deseado, y luego genera un controlador y ejecuta la determinada acción.
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

        // Si no consigue ninguna ruta, generará un 404 por defecto.
        View::render('404');
    }
}
