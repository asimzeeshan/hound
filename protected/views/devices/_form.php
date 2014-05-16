<?php
/* @var $this DevicesController */
/* @var $model Devices */
/* @var $form CActiveForm */
?>

<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'devices-form',
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
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emp_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ip_address',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mac_address'); ?>
		<?php echo $form->textField($model,'mac_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mac_address',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hostname'); ?>
		<?php echo $form->textField($model,'hostname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hostname',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line_manager'); ?>
		<?php echo $form->textField($model,'line_manager',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line_manager',array('style'=>'color:red')); ?>
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
		<?php echo $form->labelEx($model,'opt'); ?>
		<?php echo $form->textField($model,'opt',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'opt',array('style'=>'color:red')); ?>
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
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emp_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ip_address',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mac_address'); ?>
		<?php echo $form->textField($model,'mac_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mac_address',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hostname'); ?>
		<?php echo $form->textField($model,'hostname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'hostname',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line_manager'); ?>
		<?php echo $form->textField($model,'line_manager',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line_manager',array('style'=>'color:red')); ?>
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
		<?php echo $form->labelEx($model,'opt'); ?>
		<?php echo $form->textField($model,'opt',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'opt',array('style'=>'color:red')); ?>
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