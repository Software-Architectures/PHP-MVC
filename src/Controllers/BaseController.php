<?php

declare(strict_types=1);

namespace App\Controllers;

use Exception;

abstract class BaseController
{
    /**
     * @throws Exception
     */
    public function render(string $view, array $data = []): void
    {
        extract($data);
        if(!file_exists(__DIR__.'/../Views/'.$view.'.php')){
            throw  new Exception('View '.$view.' was not found');
        }
        require_once __DIR__.'/../Views/'.$view.'.php';
    }
}