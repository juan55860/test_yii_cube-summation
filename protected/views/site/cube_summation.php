<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - CubeSummation';
$this->breadcrumbs=array(
    'CubeSummation',
);
?>

<h1>Cube Summation</h1>

<p>Please send the data problem</p>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'cube-summation-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model,'problem'); ?>
        <?php echo $form->textArea($model,'problem'); ?>
        <?php echo $form->error($model,'problem'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Send'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
