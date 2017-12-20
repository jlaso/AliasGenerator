<?php

namespace JLaso;

interface GeneratorInterface
{
    /**
     * @param integer $value
     * @return string
     */
    public function encode($value);

    /**
     * @param string $value
     * @return integer
     */
    public function decode($value);
}