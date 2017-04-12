<?php

class CubeSummationForm extends CFormModel
{
    // CONST LIMIT CONSTRAINTS
    const MIN_VALUE_TEST_CASES = 1, MAX_VALUE_TEST_CASES = 50;

    private $cube;

    private $cases;

    private $testCases;

    private $dimension;

    public $input;

    public $problem;

    public function rules()
    {
        return [['problem', 'required']];
    }

    /**
     * @return null|string
     */
    public function validateInput()
    {
        $this->input = explode("\n", $this->problem);
        $this->testCases = trim($this->input[0]);
        if (!$this->validateTestCases()) {
            $this->addErrorForInvalidDimension();
            return false;
        }

        return true;
    }

    public function resolve(){
        $this->fillCubeWithZeros($this->dimension );
        $this->testCases = $this->getProblem($this->input);
    }

    /**
     * @return bool
     */
    private function validateTestCases()
    {
        return $this->testCases >= self::MIN_VALUE_TEST_CASES && $this->testCases <= self::MAX_VALUE_TEST_CASES;
    }

    private function addErrorForInvalidDimension()
    {
        $this->addError('problem', 'the dimension should be between '. self::MIN_VALUE_TEST_CASES .' to ' . self::MAX_VALUE_TEST_CASES);
    }

    /**
     *
     */
    private function validateDimesions(){

    }

    /**
     * @param $operation
     * @return bool
     */
    private function validateOperations($operation)
    {
        return $operation === 'UPDATE' || $operation  === 'QUERY';
    }

    /**
     * @param $dimension
     */
    private function fillCubeWithZeros($dimension)
    {
        for($i =0; $i<$dimension; $i++) {
            for($j =0; $j<$dimension; $j++) {
                for($k =0; $k<$dimension; $k++) {
                    $this->cube[$i][$j][$k] = 0;
                }
            }
        }
    }
}