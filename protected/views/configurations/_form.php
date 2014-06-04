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
	<div class="row">
		<?php echo $form->labelEx($data,'title'); ?>
		<?php echo $form->textField($data,'title',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($data,'title',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'from_name'); ?>
		<?php echo $form->textField($data,'from_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($data,'from_name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'from_email'); ?>
		<?php echo $form->textField($data,'from_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($data,'from_email',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'bcc'); ?>
		<?php echo $form->textField($data,'bcc',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($data,'bcc',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'notify_email'); ?>
		<?php echo $form->textField($data,'notify_email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($data,'notify_email',array('style'=>'color:red')); ?>
	</div>
<?php if (!$data->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($data,'records_per_page'); ?>
		<?php echo $form->dropDownList($data,'records_per_page',$data->getRecordsOptions()); ?>
		<?php echo $form->error($data,'records_per_page',array('style'=>'color:red')); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($data,'modified_by',array('value'=>Yii::app()->user->id)); ?>
        <?php echo $form->hiddenField($data,'id',array('value'=>$data->id)); ?>
		<?php echo $form->error($data,'modified_by',array('style'=>'color:red')); ?>
	</div>
<?php } ?>

	<div class="row buttons">
	<?php 
		if($data->isNewRecord){
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