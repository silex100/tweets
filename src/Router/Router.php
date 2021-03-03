<?php

namespace App\Router;

use Exception;

class Router
{
    private $_url;
    private $_routes = [];
    private $_namedRoutes = [];

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function get($path, $callable,  $name = null)
    {
        return $this->_add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->_add($path, $callable, $name, 'POST');
    }

    public function put($path, $callable, $name = null)
    {
        return $this->_add($path, $callable, $name, 'PUT');
    }

    public function delete($path, $callable, $name = null)
    {
        return $this->_add($path, $callable, $name, 'DELETE');
    }


    private function _add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->_routes[$method][] = $route;

        if (is_string($callable) && $name == null) {
            $name = $callable;
        }

        if ($name) {
            $this->_namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function url($name, $params = [])
    {

        if (!isset($this->_namedRoutes[$name]) ) {
            throw new RouterException("No route matches this name");
        }

        return $this->_namedRoutes[$name]->getUrl($params);
    }

    public function run()
    {

        if (!isset($this->_routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->match($this->_url)) {
                return $route->call();
            }

        }

        throw new  RouterException('No matching routes'); 
    }
}