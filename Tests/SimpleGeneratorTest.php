<?php

namespace JLaso\Tests;

use JLaso\SimpleGenerator;

class SimpleGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $generator = new SimpleGenerator();

        $id = 0;
        $coded = $generator->encode($id);
        $decoded = $generator->decode($coded);
        $this->assertEquals($id, $decoded);

        $this->assertEquals('aaaaaaaa', $coded);
    }
}