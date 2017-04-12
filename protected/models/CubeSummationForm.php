<?php

class CubeSummationForm extends CFormModel
{
    // CONST LIMIT CONSTRAINTS
    const MIN_VALUE_TEST_CASES = 1, MAX_VALUE_TEST_CASES = 50;

    private $cube;

    public $cases = [];

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
            $this->addErrorForTestCases();
            return false;
        }
        $this->createCases();
        if (!$this->reviewEachCase()){
            $this->addErrorForTestCaseFormed();
            return false;
        }

        if (count($this->cases)!= $this->testCases) {
            $this->addErrorForTestCasesSended();
            return false;
        }
        return true;
    }

    private function createCases()
    {
        $problem = 0;
        for ($i = 1; $i < count($this->input); $i++) {
            $case = explode(" ", $this->input[$i]);
            if ($this->validateOperations($case[0])=== false) {
                array_push($this->cases, ["test" => $this->input[$i], "problems" => [] ]);
                $problem +=1 ;
            }
            else {
                array_push($this->cases[$problem-1]["problems"], $this->input[$i]);
            }
        }
    }


    /**
     * @return bool
     */
    private function reviewEachCase()
    {
        foreach ($this->cases as $case) {
            $operations = explode(" ", $case['test']);
            if($operations[1] != count($case["problems"])){
                return false;
            }
        }
        return true;
    }

    public function resolve()
    {
        $this->fillCubeWithZeros($this->dimension );
    }

    /**
     * @return bool
     */
    private function validateTestCases()
    {
        return $this->testCases >= self::MIN_VALUE_TEST_CASES && $this->testCases <= self::MAX_VALUE_TEST_CASES;
    }

    /**
     *
     */
    private function validateDimensions()
    {

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

    private function addErrorForTestCases()
    {
        $this->addError('problem', 'the test cases should be between '. self::MIN_VALUE_TEST_CASES .' to ' . self::MAX_VALUE_TEST_CASES);
    }

    private function addErrorForTestCasesSended()
    {
        $this->addError('problem', 'the units test cases are different that the sended');
    }

    private function addErrorForTestCaseFormed()
    {
        $this->addError('problem', 'the test cases are bad created');
    }
}