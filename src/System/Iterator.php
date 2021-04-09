<?php

namespace App\System;

class Iterator implements \Iterator, \ArrayAccess
{
    /**
     * @var int
     */
    protected int $index = 0;

    /**
     * @var array
     */
    protected array $iteratorData = [];

    /**
     * \Iterator interface methods
     */

    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * @return bool
     */
    public function current(): bool
    {
        return $this->iteratorData[$this->index];
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->index;
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->iteratorData[$this->index]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->iteratorData);
    }

    /**
     * @return void
     */
    public function prev()
    {
        $this->index--;
    }

    /**
     * \ArrayAccess interface methods
     */

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->iteratorData[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->iteratorData[$offset] ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->iteratorData[] = $value;
        } else {
            $this->iteratorData[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->iteratorData[$offset]);
    }

}