<?php

namespace App\System;

class Collection extends Iterator
{
    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->iteratorData = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->iteratorData;
    }
}