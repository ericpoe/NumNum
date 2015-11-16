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
        $nums = range(1,9);

        while ($nums[0] < $this->min) {
            $nums = $this->iterateSpecial($nums);
        }

        return $nums;
    }

    private function iterateSpecial(array $oldNums)
    {
        $newNums = [];

        foreach ($oldNums as $num) {
            for ($i = 1; $i < 10; $i++) {
                $tryNum = ($num * 10) + $i;

                if ($tryNum > $this->max) {
                    return $newNums;
                }

                if ($this->isSpecial($tryNum)) {
                    $newNums[] = $tryNum;
                }
            }
        }
        return $newNums;
    }

    private function followsRule($num)
    {
        return 0 !== $num % 10 && 0 === $num % strlen($num);
    }
}
