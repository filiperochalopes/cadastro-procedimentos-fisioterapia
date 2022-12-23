<?php

namespace App;

use Opis\ORM\Entity;

class Fisioterapeuta extends Entity
{
    public function name(): string
    {
        return $this->orm()->getColumn('name');
    }
}