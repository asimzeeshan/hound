<?php
/* @var $this ManagersController */
/* @var $model Managers */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'managers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php
	if(!$model->isNewRecord){
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Update Mangers ".$model->id."</h1>",
		));
	} else {
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Create Mangers</h1>",
		));
	}
	
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email',array('style'=>'color:red')); ?>
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