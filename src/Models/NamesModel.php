<?php

declare(strict_types=1);

namespace App\Models;

use Exception;

class NamesModel
{

    protected array $names = [
        'Niko',
        'John',
    ];

    /**
     * @throws Exception
     */
    public function getNameByIndex(int $index){
        if (!key_exists($index, $this->names)){
            throw new Exception('Name with index '.$index.' was not found');
        }
        return $this->names[$index];
    }
}