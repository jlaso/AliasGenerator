<?php

namespace JLaso;

abstract class BaseGenerator implements GeneratorInterface
{
   protected $base = array();

    /** @var int */
    private $n = 0;   // holds base-n of the invoked class, calculated at run-time
    /** @var int */
    private $l = 0;   // holds the number of cycling bases for each n-digit
    /** @var integer */
    private $maxdigits;
    /** @var boolean */
    private $grows;

    const GROWS = true;
    const DONT_GROW = false;

    /**
     * @param array $base
     * @param int $maxdigits
     * @param bool $grows
     * @throws \Exception
     */
    function __construct(array $base = null, $maxdigits = 8, $grows = false) {

        if ($base) {
            $this->base = $base;
        }
        $this->maxdigits = $maxdigits;
        $this->grows = $grows;
        $this->l = count($this->base);

        // checks if base array is correctly formed, i.e. same length for
        // all elements and  non-repeated chars
        for($i=0;$i<$this->l;$i++){
            $aux = strlen($this->base[$i]);
            if($this->n){  // now check same sized elements
                if($aux<>$this->n) {
                    throw new \InvalidArgumentException("Different size for element 0 and " . $i);
                }
            }else
                $this->n = $aux;
        }
        // now check non-repeated chars in each array element
        for($i=0;$i<$this->l;$i++){
            $yet = '';

            for($j=0;$j<$this->n;$j++){  // $this->n because we determined at previous step all elements have same size
                $c = substr($this->base[$i], $j, 1);
                if(strpos($yet, $c)) {
                    $decored = str_replace($c, " ->$c<- ", $this->base[$i]);
                    throw new \Exception("Element $i has element ($c) repeated, ||$decored||");
                }
                $yet .= $c;
            }
        }
    }

    /**
     * encodes numeric id in n-based version
     * @param integer $id
     * @return string
     * @throws \Exception
     */
    public function encode($id){
        if(!$this->grows && $id>$max = $this->maxId())
            throw new \Exception("Limit id($id) for {$this->maxdigits} digits({$max}) in ".get_called_class()."->encode, possible lost of information");
        $ret = '';
        $aux = $id;
        $bit = 0;
        while(($this->grows && $aux) || $this->maxdigits>$bit){
            $a = $aux % $this->n;
            $ret .= substr($this->base[$bit % $this->l],$a,1);
            $aux = ($aux-$a)/$this->n;
            $bit++;
        }
        return $ret;
    }

    /**
     * decodes an alias obtained previously with encode and returns the id that originates this alias
     * @param string $alias
     * @return integer
     */
    public function decode($alias){
        $id = 0;
        $n = strlen($alias);
        $x = 1;
        for($bit=0;$bit<$n;$bit++){
            $c = substr($alias,$bit,1);
            $v = strpos($this->base[$bit % $this->l],$c);
            $id += $v * $x;
            $x *= $this->n;
        }

        return $id;
    }

    /**
     * calculates the last alias can be encoded with the current base
     * @return string
     */
    public function maxAlias(){
        $alias = '';
        for ($bit=0;$bit<$this->maxdigits;$bit++){
            $alias .= substr($this->base[$bit % $this->l],-1);
        }
        return $alias;
    }

    /**
     * calculates the last id can be encoded with the current base
     * @return integer
     */
    public function maxId(){
        return pow($this->n, $this->maxdigits);
    }
}
