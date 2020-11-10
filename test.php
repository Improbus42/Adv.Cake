<?php
require "revertCharacters.php";

use PHPUnit\Framework\TestCase;

class test extends TestCase
{
    public function testFailure()
    {
        $text = 'Тевирп! Онвад ен ьсиледив.';
        $this->assertSame($text, revertCharacters("Привет! Давно не виделись."));
    }
}
