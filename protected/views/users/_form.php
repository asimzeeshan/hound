<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php
	if(!$model->isNewRecord){
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Update System User ".$model->id."</h1>",
		));
	} else {
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Create System User</h1>",
		));
	}
	
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'first_name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'last_name',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'username',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password',array('style'=>'color:red')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'email',array('style'=>'color:red')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'roles'); ?>
		<?php echo $form->dropDownList($model,'roles', $model->getRolesOptions()); ?>
		<?php echo $form->error($model,'roles',array('style'=>'color:red')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->checkBox($model,'status');
			   echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status',array('style'=>'color:red')); ?>
	</div>
    
    <?php if (!$model->isNewRecord) { ?>
    <div class="row">
        <?php echo $form->labelEx($model,'last_login'); ?>
        <?php echo $model->last_login; ?>
    </div>

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
        <?php echo $form->hiddenField($model,'modified_by',array('value'=>Yii::app()->user->id)); ?>
    </div>

	<?php } ?>

	<div class="row buttons">
		<?php 
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