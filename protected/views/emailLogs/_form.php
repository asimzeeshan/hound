<?php
/* @var $this EmailLogsController */
/* @var $model EmailLogs */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-logs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php
	if(!$model->isNewRecord){
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Update EmailLogs ".$model->id."</h1>",
		));
	} else {
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Create EmailLogs</h1>",
		));
	}
	
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'template_id'); ?>
		<?php echo $form->textField($model,'template_id'); ?>
		<?php echo $form->error($model,'template_id',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_to'); ?>
		<?php echo $form->textField($model,'email_to',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_to',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_cc'); ?>
		<?php echo $form->textField($model,'email_cc',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_cc',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subject',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_id',array('style'=>'color:red')); ?>
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
			'caption'=>'Save',
			'value'=>'asd1',
			'htmlOptions'=>array('class'=>'btn btn-info'),
			));
		}
		 ?>
	</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->