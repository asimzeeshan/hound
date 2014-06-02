<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configurations-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<h1>System Configurations</h1>",
	));
	
?>
	<p class="note"> <span class="required"></span> </p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'title',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_name'); ?>
		<?php echo $form->textField($model,'from_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'from_name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_email'); ?>
		<?php echo $form->textField($model,'from_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'from_email',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bcc'); ?>
		<?php echo $form->textField($model,'bcc',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'bcc',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_email'); ?>
		<?php echo $form->textField($model,'notify_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'notify_email',array('style'=>'color:red')); ?>
	</div>
<?php if (!$model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'records_per_page'); ?>
		<?php echo $form->dropDownList($model,'records_per_page',$model->getRecordsOptions()); ?>
		<?php echo $form->error($model,'records_per_page',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created_by'); ?>
		<?php //echo $form->textField($model,'created_by'); ?>
		<?php //echo $form->error($model,'created_by',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified_by'); ?>
		<?php echo $form->hiddenField($model,'modified_by',array('value'=>Yii::app()->user->id)); ?>
		<?php echo $form->error($model,'modified_by',array('style'=>'color:red')); ?>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
		if($model->isNewRecord){
			$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'button1',
			'caption'=>'Creat',
			'value'=>'asd1',
			'htmlOptions'=>array('class'=>'btn btn-info'),
			));
		}else {
			$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'button1',
			'caption'=>'Save Changes',
			'value'=>'asd1',
			'htmlOptions'=>array('class'=>'btn btn-info'),
			));
		}
		?>
	</div>
<?php $this->endWidget();?>
<?php $this->endWidget(); ?>

</div><!-- form -->