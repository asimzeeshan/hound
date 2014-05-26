<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Employees', 'url'=>array('index')),
	array('label'=>'Create Employees', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employees-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



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
<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Manage Employees</h1>",
		));
		
	?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employees-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'emp_id',
		'name',
		'email',
		'joining_date',
		'location',
		'hall',
		array(
		'name'=>'manager1_id',
		'type'=>'raw',
		'filter'=>$model->managersList(),
		'value'=>'$data->managerId($data->manager1_id)',
		),
		array(
		'name'=>'manager2_id',
		'type'=>'raw',
		'filter'=>$model->managersList(),
		'value'=>'$data->managerId($data->manager2_id)',
		),
		//'manager1_id',
		//'manager2_id',
		//'created',
		//'created_by',
		//'modified',
		//'modified_by',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php $this->endWidget();?>