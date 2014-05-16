<?php
$this->pageTitle = 'Change Password';
$this->breadcrumbs=array(
	'Change Password',
);
?>
<?php if(Yii::app()->user->hasFlash('changePassword')): ?>
<?php echo Yii::app()->user->getFlash('changePassword'); ?>
<?php endif;?>
<h1>Change Password</h1>
	<?php
	$form = $this->beginWidget(
		'CActiveForm',
		array(
			'id'=>'changepassword-form',
			
		)
	);
	?>

	<p>Fields with * are required.</p>
		
	<div>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password',array('style'=>'color:red')); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'new_Password'); ?>
		<?php echo $form->passwordField($model,'new_Password'); ?>
		<?php echo $form->error($model,'new_Password',array('style'=>'color:red')); ?>
	</div>
        
        <div>
		<?php echo $form->labelEx($model,'confirm_Password'); ?>
		<?php echo $form->passwordField($model,'confirm_Password'); ?>
		<?php echo $form->error($model,'confirm_Password',array('style'=>'color:red')); ?>
	</div>
	<div>
        <?php 
 $this->widget('zii.widgets.jui.CJuiButton', array(
		'name'=>'button1',
		'caption'=>'Change Password',
		//'value'=>'asd1',
		'htmlOptions'=>array('class'=>'btn btn-primary'),));
?>
<?php $this->endWidget();?>
	</div>


