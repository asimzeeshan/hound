<?php
/* @var $this EmailTemplatesController */
/* @var $model EmailTemplates */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-templates-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

    <?php if (!$model->isNewRecord) { ?>

    <div class="row">
        <?php echo $form->labelEx($model,'created'); ?>
        <?php echo $model->created; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'created_by'); ?>
        <?php echo $model->CreatedBy->name(); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'modified'); ?>
        <?php echo $model->modified; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'modified_by'); ?>
        <?php echo $model->ModifiedBy->name(); ?>
    </div>

	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->