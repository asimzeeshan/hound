<?php
/* @var $this DevicesController */
/* @var $model Devices */
$this->pageTitle=$this->pageTitle() . ' - Admin';
$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	'Manage',
);
$this->menu=array(
	array('label'=>'View Devices W/O EmpId List as PDF', 'url'=>array('report')),
	array('label'=>'View Devices List With Mis_Notify Enalbe as PDF', 'url'=>array('pdfreport')),
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
			'title'=>"<h1>Manage Devices</h1>",
		));
		
	?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'devices-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
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
<?php $this->endWidget();?>