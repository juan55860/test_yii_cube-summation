<?php

class CubeSummationForm extends CFormModel
{
    public $problem;

    public function rules()
    {
        return [['problem', 'required']];
    }
}