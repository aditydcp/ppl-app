<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UnitTest extends TestCase
{
    public function testOne(): void
    {
        $this->assertTrue(false);
    }

    /**
     * @depends testOne
     */
    public function testTwo(): void
    {
    }
}