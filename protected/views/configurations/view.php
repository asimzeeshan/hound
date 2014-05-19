<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */

$this->breadcrumbs=array(
	'Configurations'=>array('admin'),
	$model->title,
);

$this->menu=array(
	//array('label'=>'List Configurations', 'url'=>array('index')),
	array('label'=>'Create Configurations', 'url'=>array('create')),
	array('label'=>'Update Configurations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Configurations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Configurations', 'url'=>array('admin')),
);
?>

<h1>View Configurations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'from_name',
		'from_email',
		'bcc',
		'notify_email',
                'created',
                    array(
                                    'name'=>'created_by',
                                    'value'=>$model->CreatedBy->name(),

                                    ),
                    'modified',
                    array(
                                    'name'=>'modified_by',
                                    'value'=>$model->ModifiedBy->name(),
                                    ),
		//'records_per_page',
		//'created',
		//'created_by',
		//'modified',
		//'modified_by',
	),
)); ?>
