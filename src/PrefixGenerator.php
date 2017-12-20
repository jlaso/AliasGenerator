<?php

namespace JLaso;

class PrefixGenerator extends BaseGenerator
{
    // important question: coded alias is coupled to $base array
    protected $base = array (
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
    );

    protected $prefix;

    public function __construct($prefix = '', array $base = null, $maxdigits = 8, $grows = false)
    {
        parent::__construct($base, $maxdigits, $grows);
        $this->prefix = $prefix;
    }

    public function encode($id)
    {
        return $this->prefix.parent::encode($id);
    }

    public function decode($alias)
    {
        return parent::decode(preg_replace("/^".$this->prefix."/", "", $alias));
    }
}
