<?php
/* @var $this EmployeesController */
/* @var $model Employees */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
    <?php if ($model->isNewRecord) { ?>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'emp_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'email',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'joining_date'); ?>
		<?php echo $form->textField($model,'joining_date'); ?>
		<?php echo $form->error($model,'joining_date',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'location',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hall'); ?>
		<?php echo $form->textField($model,'hall',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hall',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager1_id'); ?>
		<?php echo $form->textField($model,'manager1_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'manager1_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager2_id'); ?>
		<?php echo $form->textField($model,'manager2_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'manager2_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'created_by',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'modified_by',array('style'=>'color:red')); ?>
	</div>

	<div class="row buttons">
	<?php 
		$this->widget('zii.widgets.jui.CJuiButton', array(
		'name'=>'button1',
		'caption'=>'Create',
		'value'=>'asd1',
		'htmlOptions'=>array('class'=>'btn btn-info'),
		));

		 ?>
	</div>

<?php } else { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'emp_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'email',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'joining_date'); ?>
		<?php echo $form->textField($model,'joining_date'); ?>
		<?php echo $form->error($model,'joining_date',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'location',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hall'); ?>
		<?php echo $form->textField($model,'hall',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hall',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager1_id'); ?>
		<?php echo $form->textField($model,'manager1_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'manager1_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager2_id'); ?>
		<?php echo $form->textField($model,'manager2_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'manager2_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'created_by',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'modified_by',array('style'=>'color:red')); ?>
	</div>
<div class="row buttons">
<?php 
 $this->widget('zii.widgets.jui.CJuiButton', array(
		'name'=>'button1',
		'caption'=>'Save',
		'value'=>'asd1',
		'htmlOptions'=>array('class'=>'btn btn-info'),
		));
 ?>
	</div>
<?php }?>
<?php $this->endWidget(); ?>

</div><!-- form -->