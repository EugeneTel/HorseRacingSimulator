<?php

namespace App\Entity;

abstract class AbstractEntity
{
    /**
     * Convert fields to array
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}