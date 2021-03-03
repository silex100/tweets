<?php

namespace App\Router;

class Route
{
    private $_path;
    private $_callable;
    private $_matches = [];
    private $_params  = [];

    public function __construct($path, $callable)
    {
        $this->_path     = trim($path, '/');
        $this->_callable = $callable;
    }

    public function with($param, $regex)
    {
        $this->_params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }


    public function match($url)
    {
        $url   = trim($url, '/');
        $path  = preg_replace_callback('#:([\w]+)#', [$this, '_paramMatch'], $this->_path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->_matches = $matches;

        return true;
    }

    private function _paramMatch($match)
    {

        if (isset($this->_params[$match[1]])) {
            return  '('. $this->_params[$match[1]] .')'; 
        }
        return '([^/]+)';
    }

    public function getUrl($params)
    {
        $path = $this->_path;
        foreach ($params as $k => $v) {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }

    public function call()
    {

        if (is_string($this->_callable)) {
            $params = explode("#", $this->_callable);
            $controller  = "App\\Controller\\".$params[0] ."Controller";
            $controller = new $controller();

            return \call_user_func_array([$controller, $params[1]], $this->_matches);

        } else {
            return \call_user_func_array($this->_callable, $this->_matches);
        }
        
    }
}