<script>
function updateFields(data){
    $('#email_subject').val(data.value1);
    //$('textarea').html(data.value2);
	//tinyMCE.setContent(data.value2);
	tinymce.get('textarea').setContent(data.value2);
}
</script>
<?php
/* @var $this AbuselistController */
/* @var $model EmailTemplates */
/* @var $form CActiveForm */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-templates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'to'); ?>
		<?php echo $form->textField($model,'to',array('value'=>$employee_data->emp_manager_email,'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'to'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'cc'); ?>
		<?php echo $form->textField($model,'cc',array('value'=>'noc@nxvt.com, mis@nxb.com.pk','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cc'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'bcc'); ?>
		<?php echo $form->textField($model,'bcc',array('value'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'bcc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'template_id'); ?>
		<?php echo $form->dropDownList($model,'id', CHtml::listData(EmailTemplates::model()->findAll(), 'id', 'title'), 
		array(
		'empty'=>'Select Type',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('emailLogs/showmailtemplates'), //url to call.
		'success'=>'updateFields',        
        'dataType' => 'json',	
		'data' =>  array('template_id' => 'js:$(this).val()'),	
		//Style: CController::createUrl('currentController/methodToCall')
		//'data'=>'js:{template_id_test:1}'
		//leave out the data key to pass all form values through
		))); 
		?>
		<?php echo $form->error($model,'template_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255,'id'=>'email_subject')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php 
			echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50, 'id' => 'textarea'));
			/*$this->widget('application.extensions.tinymce.ETinyMce',
            array('editorTemplate'=>'full','name'=>'EmailTemplates[body]','id'=>'mailtemplateBody')); */
		?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save', array( 'onClick' => 'tinyMCE.triggerSave();' )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->