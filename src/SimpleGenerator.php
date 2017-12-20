<?php

namespace JLaso;

class SimpleGenerator extends BaseGenerator
{
    // important question: coded alias is coupled to $base array
    protected $base = array (
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
    );
}
