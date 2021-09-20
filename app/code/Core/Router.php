<?php

namespace Core;

use Core\Request;

class Router
{
    public function loadPage()
    {
        $request = new Request();
        $path = $request->getRequestUri();

        $urlParams = $this->parseUrl($path);
        $controllerClass = $urlParams['class'];
        $method = $urlParams['method'];
        $param = $urlParams['param'];

        $controller = new $controllerClass;
        $controller->$method($param);
    }

    private function parseUrl($path)
    {
        $urlParams = [
            'class' => $this->getControllerClass('home', false),
            'method' => 'index',
            'param' => null
        ];

        $path = trim($path, '/');

        if ($path) {
            $path = explode('/', $path);


            if ($path[0] === 'api') {
                $parameterCount = 1;
                $api = true;
            } else {
                $parameterCount = 0;
                $api = false;
            }

            if (isset($path[$parameterCount])) {

                if (class_exists($this->getControllerClass($path[$parameterCount], $api))) {
                    $urlParams['class'] = $this->getControllerClass($path[$parameterCount], $api);

                    if (isset($path[$parameterCount + 1])) {
                        $urlParams['method'] = $path[$parameterCount + 1];

                        if(method_exists($urlParams['class'], $urlParams['method'])) {
                            if (isset($path[$parameterCount + 2])) {
                                $urlParams['param'] = $path[$parameterCount + 2];
                            }
                        } else {
                            $urlParams['class'] = $this->getControllerClass('error', $api);
                            $urlParams['method'] = 'index';
                        }
                    }
                } else {
                    $urlParams['class'] = $this->getControllerClass('error', $api);
                    $urlParams['method'] = 'index';
                }
            }
        }

        return $urlParams;
    }

    protected function getControllerClass($name, $api)
    {
        if ($api) {
            return '\Controller\Api\\'.ucfirst($name).'Controller';
        }

        return '\Controller\\'.ucfirst($name).'Controller';
    }
}
