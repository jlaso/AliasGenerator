<?php

/**
 * @author Joseluis Laso <info@joseluislaso.es>
 *
 */

namespace app\models\alias;


class AliasGenerator
{
    // only one important question: if you code alias for url and you store in
    // database, don't change the $base array, because if you decode stored alias
    // do you not obtain original id, understod?
    private $base = array (
        // the purpose of this aparent disorder is to obtain a pseudo-random
        // alias, an alias that can be decoded and get original id
        '#VaRCSc,ev0fNj;k9HDGlmT.obPq7rIs-Ytux5yzAgB_E4pFihUJnK3LMd&O1Q6XZ',
        'JK3LMN&!tuvx5yzABC_DE4FGHIOP1QRSTUV6XYZabc,de0fghij;k9lmn.opq7rs-',
        'STUV6XYZabc,de0fghij;k9lmK3LMNn.opq7rs-!tuv&OP1QRx5yzABC_DE4FGHIJ',
        'OP1QR;k9lmn.opq7rsSTdzABC_DEuJK3LMN4FGHe0fghij!t-&vx5yUV6XYZabc,I',
        'lmn.op_DE4FGHe0fghij!tuJK3LMNvx5q7rsSTdzABC,I-&OPyUV6XYZabc1QR;k9',
        'vx5yzABC_DE4FGHUV6XYZ;k9lmn.opq7rs-&OP1QRSTde0fghij!tuabc,IJK3LMN',
        'TdzABC,I-&OPyUV6XYZabc1QR;k9lmn.op_DE4FGHe0fghij!tuJK3LMNvx5q7rsS',
        'QRSTde0fghij!tuabc,IJK3LMNvx5yzABC_DE4FGHUV6XYZ;k9lmn.opq7rs-&OP1',
        '4FGHe0fghij!t-&OP1QR;k9lmn.opq7rsSTdzABC_DEuJK3LMNvx5yUV6XYZabc,I',
        'q7rsSTdzABC,I-&OPyUV6XYZabc1QR;k9lmn.op_DE4FGHe0fghij!tuJK3LMNvx5',
        // can you continue or not, because is cycled in code, for digit 11th
        // it starts at 0
    );

    // this holds base-n of this class, calculated at run-time
    private $n = 0;

    // this holds number of cycling bases for each n-digit
    private $l = 0;

    // convention for last parameter encode function
    const GROWS = true;

    /**
     * Checks if the base array is ok, and if not throws exception indicating this
     */
    function __construct() {
        // first gets the base array from config, if any
        $digits = $this->base;
        if ($digits)
            $this->base = $digits;

        $this->l = count($this->base);
        // check now if array base is correctly formed, i.e. same lenght for
        // all elements and  non-repeated chars
        for($i=0;$i<$this->l;$i++){
            $aux = strlen($this->base[$i]);
            if($this->n){  // now check same sized elements
                if($aux<>$this->n)
                    throw new \Exception("Not same sized for element 0 and ".$i);
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
     * @param byte $maxdigits
     * @param boolean $grows
     * @return string
     */
    public function encode($id, $maxdigits = 8, $grows = false){
        if(!$grows && $id>$max = $this->maxId($maxdigits))
            throw new \Exception("Limit id($id) for $maxdigit digits($max) in JaitecAliasBundle->encode, possible lost of information");
        $ret = '';
        $aux = $id;
        $bit = 0;
        while(($grows && $aux) || $maxdigits>$bit){
            $a = $aux % $this->n;
            $ret .= substr($this->base[$bit % $this->l],$a,1);
            $aux = ($aux-$a)/$this->n;
            $bit++;
        }
        return $ret;
    }

    /**
     * decodes an alias obtained previously with encode and returns the id that originates this alias
     * @param strig $alias
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
     * calculats the last alias can be formed with n-digits
     * @param integer $maxdigits
     * @return string
     */
    public function maxAlias($maxdigits=8){
        $alias = '';
        for ($bit=0;$bit<$maxdigits;$bit++){
            $alias .= substr($this->base[$bit % $this->l],-1);
        }
        return $alias;
    }

    /**
     * calculates the id that applies for the last alias can be formed
     * @param integer $maxdigits
     * @return integer
     */
    public function maxId($maxdigits=8){
        return pow($this->n, $maxdigits);
    }
}
