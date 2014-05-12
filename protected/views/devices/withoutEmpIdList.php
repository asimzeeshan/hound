<?php
/* @var $this DevicesController */
/* @var $model Devices */

$this->breadcrumbs=array(
	'Devices'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#devices-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<p><?php //echo CHtml::link('Back', array('/devices/admin'))?> </p>
<h1>Employees without ID </h1>

 
<div class="flash-success">
    
</div>
 

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'devices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php 
echo "<br/>";
$this->widget('zii.widgets.jui.CJuiButton', array(
		'name'=>'button1',
		'caption'=>'Send Email',
		'value'=>'asd1',
		'htmlOptions'=>array('class'=>'btn btn-primary'),));
?>
<?php if(Yii::app()->user->hasFlash('withoutEmpIdList')): ?>
<?php echo Yii::app()->user->getFlash('withoutEmpIdList'); ?>
<?php endif; ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'devices-grid',
	'dataProvider'=>$model->searchlistWithoutEmpId(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'emp_id',
		'name',
		'ip_address',
		'mac_address',
		'hostname',
		 array(
        'id'=>'checkbox',
        'class'=>'CCheckBoxColumn',
        'selectableRows' => '10',
		'name'=>'id'
    ),
	
		/*
		'description',
		'line_manager',
		'location',
		'hall',
		'opt',
		'created',
		'created_by',
		'modified',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));
	
 ?>
 <?php 
 $this->widget('zii.widgets.jui.CJuiButton', array(
		'name'=>'button1',
		'caption'=>'Send Email',
		'value'=>'asd1',
		'htmlOptions'=>array('class'=>'btn btn-primary'),));
 //echo CHtml::submitButton('caption');?>
<?php $this->endWidget();?>