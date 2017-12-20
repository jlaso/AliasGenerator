<?php

namespace JLaso\Tests;

use JLaso\PrefixGenerator;

class PrefixGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $prefix = 'PRE';
        $generator = new PrefixGenerator($prefix);

        $id = 0;
        $coded = $generator->encode($id);
        $decoded = $generator->decode($coded);
        $this->assertEquals($id, $decoded);
        $this->assertStringStartsWith($prefix, $coded);
    }
}