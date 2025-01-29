<?php

declare(strict_types=1);

namespace App;

use App\Controllers\BaseController;
use Exception;

class Router
{
    protected array $routes = [];

    public function add(string $method, string $path, string $controller)
    {
        $this->routes[$method][$path] = $controller;
    }

    public function dispatch(): void
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        if (!$this->routeExists($path, $method)){
            throw  new Exception('Route does not exist');
        }
        $controller = $this->routes[$method][$path];
        if ($this->isCallable($controller)){
            (new $controller)();
        }
    }

    protected function isCallable(string $controller):true
    {
        try{

            $reflection = new \ReflectionClass($controller);
        }
        catch (\Throwable){
            throw new Exception('Controller '.$controller.' Does not exist');
        }
        if(!$reflection->hasMethod('__invoke')){
            throw new Exception('Controller '.$controller.' is not invokable');
        }
        $method = $reflection->getMethod('__invoke');
        if(! $method->isPublic() ){
            throw new Exception('__invoke method on '.$controller.' controller is not public');
        }
        if(!$reflection->isSubclassOf(BaseController::class)){
            throw new Exception('Controller '.$controller.' is not subclass of BaseController');
        }
        return true;

    }

    protected function routeExists(string $path, string $method): bool
    {
        return $this->routes[$method] && isset($this->routes[$method][$path]);
    }
}