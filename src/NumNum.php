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

    /**
     * Shows if a specific number follows the rules to be special
     *
     * @param int $num
     * @return bool
     */
    public function isSpecial($num)
    {
        for ($i = 0; $i < strlen($num); $i++) {
            $testNum = substr($num, 0, $i + 1);

            $numArr = str_split($testNum);

            if ($this->digitsAreNotUnique($numArr)) {
                return false;
            }

            if ($this->isNotDivisible($testNum)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Looks for an array of numbers that are special
     *
     * @return array
     */
    public function findSpecial()
    {
        $nums = range(1,9);
        $minNotFound = true;

        while ($minNotFound) {
            $newNums = $this->iterateSpecial($nums);

            if (empty($newNums)) {
                $minNotFound = false;
            } else {
                $nums = $newNums;
            }
        }

        return $nums;
    }

    /**
     * @param array $oldNums
     * @return array
     */
    private function iterateSpecial(array $oldNums)
    {
        $newNums = [];

        $nums = $this->reduceArr($oldNums);

        foreach ($nums as $num) {
            for ($i = 1; $i < 10; $i++) {
                $tryNum = ($num * 10) + $i;

                if ($tryNum <= $this->max && $this->isSpecial($tryNum)) {
                    $newNums[] = $tryNum;
                }

                if ($tryNum > $this->max) {
                    return $newNums;
                }
            }
        }
        return (empty($newNums)) ? $nums : $this->reduceArr($newNums);
    }

    /**
     * @param int $num
     * @return bool
     */
    private function followsRule($num)
    {
        return 0 !== $num % 10 && 0 === $num % strlen($num);
    }

    /**
     * @param array $numArr
     * @return bool
     */
    private function digitsAreNotUnique(array $numArr)
    {
        return count($numArr) !== count(array_unique($numArr));
    }

    /**
     * @param int $testNum
     * @return bool
     */
    private function isNotDivisible($testNum)
    {
        return false === $this->followsRule($testNum);
    }

    private function getLastElementOf(array $arr)
    {
        return array_slice($arr, -1)[0];
    }

    /**
     * Reduce the array by discarding numbers that will lead to the outside of the min/max
     * @param array $arr
     * @return array
     */
    private function reduceArr(array $arr)
    {
        $arr = $this->reduceToMin($arr);
        $arr = $this->reduceToMax($arr);

        return $arr;
    }

    /**
     * @param array $arr
     * @return array
     */
    private function reduceToMin(array $arr)
    {
        $firstElem = $arr[0];
        $numOfInts = strlen((string) $firstElem);

        while ($firstElem < substr($this->min, 0, $numOfInts)) {
            array_shift($arr);
            $firstElem = $arr[0];
        }
        return $arr;
    }

    /**
     * @param array $arr
     * @return array
     */
    private function reduceToMax(array $arr)
    {
        $lastElem = $this->getLastElementOf($arr);
        $numOfInts = strlen((string) $lastElem);

        while ($lastElem > substr($this->max, 0, $numOfInts)) {
            array_pop($arr);
            $lastElem = $this->getLastElementOf($arr);
        }
        return $arr;
    }
}
