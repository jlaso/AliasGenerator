<?php

namespace JLaso\Tests;

use JLaso\AliasGenerator;

class AliasGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $maxdigits = 8;
        $generator = new AliasGenerator(null, $maxdigits);

        $id = 12345678;
        $coded = $generator->encode($id);
        $decoded = $generator->decode($coded);
        $this->assertEquals($id, $decoded);
        $this->assertLessThan(PHP_INT_MAX, $generator->maxId());
        $this->assertGreaterThan($maxdigits * $maxdigits, $generator->maxId());
        $this->assertEquals($maxdigits, strlen($generator->maxAlias()));
    }

    public function testError()
    {
        $this->expectException(\InvalidArgumentException::class);

        $generator = new AliasGenerator(
            array(
                '012345',
                '0123456',
            )
        );
    }
}