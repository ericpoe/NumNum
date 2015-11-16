<?php
namespace NumNum;

class NumNum
{
    private $min;
    private $max;

    public function __construct($min = 111111111, $max = 999999999)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function isSpecial($num)
    {
        for ($i = 0; $i < strlen($num); $i++) {
            $testNum = substr($num, 0, $i + 1);

            $numArr = str_split($testNum);
            if (false === (count($numArr) === count(array_unique($numArr)))) {
                return false;
            }

            if (false === $this->followsRule($testNum)) {
                return false;
            }
        }
        return true;
    }

    public function findSpecial()
    {
        $ans = [];

        for ($num = $this->min; $num <= $this->max; $num++) {
            if ($this->isSpecial($num)) {
                $ans[] = $num;
            }
        }

        return $ans;
    }

    private function followsRule($num)
    {
        return 0 !== $num % 10 && 0 === $num % strlen($num);
    }
}
