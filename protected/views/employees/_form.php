<?php
/* @var $this EmployeesController */
/* @var $model Employees */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ip_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mac_address'); ?>
		<?php echo $form->textField($model,'mac_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mac_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hostname'); ?>
		<?php echo $form->textField($model,'hostname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hostname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line_manager'); ?>
		<?php echo $form->textField($model,'line_manager',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line_manager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hall'); ?>
		<?php echo $form->textField($model,'hall',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hall'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opt'); ?>
		<?php echo $form->textField($model,'opt',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'opt'); ?>
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