<?php
use NumNum\NumNum;

class NumNumTest extends PHPUnit_Framework_TestCase
{
    public function testChar1DivisibleBy1()
    {
        $num = 2;

        $numnum = new NumNum();

        $this->assertTrue($numnum->isSpecial($num));
    }

    public function testFirst2CharsDivisibleBy2()
    {
        $numnum = new NumNum();

        $this->assertFalse($numnum->isSpecial(11));
        $this->assertTrue($numnum->isSpecial(92));
    }

    public function testFirst3CharsDivisibleBy3()
    {
        $numnum = new NumNum();

        $this->assertFalse($numnum->isSpecial(122));
        $this->assertTrue($numnum->isSpecial(123));
    }

    public function testFirst5CharsDivisibleBy5()
    {
        $numnum = new NumNum();

        $this->assertFalse($numnum->isSpecial(12345));
        $this->assertTrue($numnum->isSpecial(12365));
    }

    public function testNoNumberUnderTenIs0()
    {
        $numnum = new NumNum();

        $this->assertFalse($numnum->isSpecial(10));
        $this->assertFalse($numnum->isSpecial(102));
    }

    public function testFindAllNumbersThatSatisfyRule()
    {
        $numnum = new NumNum(10, 20);

        $expected = [12, 14, 16, 18];
        $actual = $numnum->findSpecial();

        $this->assertEquals($expected, $actual);

        $numnum2 = new NumNum(120, 130);

        $expected = [123, 126, 129];
        $actual = $numnum2->findSpecial();
        $this->assertEquals($expected, $actual);
    }

    public function testAllDigitsInNumberAreUnqiue()
    {
        $numnum = new NumNum(20, 50);

        $expected = [
            24, 26, 28,
            32, 34, 36, 38,
            42, 46, 48];
        $actual = $numnum->findSpecial();

        $this->assertEquals($expected, $actual);
    }
}
