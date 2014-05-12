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
<p><?php //echo CHtml::link('Employees with out ID List', array('/devices/withoutEmpIdList'))?> </p>
<h1>Manage Devices</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'devices-grid',
	'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(  
            'name'=>'emp_id',
			'type' => 'raw',
            'value'=>array($this,'gridMisNotifyColumn')
        ),

		'name',
		'ip_address',
		'mac_address',
		'hostname',
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
