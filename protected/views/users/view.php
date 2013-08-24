<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'System Users'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage System Users', 'url'=>array('admin')),
	array('label'=>'Create System User', 'url'=>array('create')),
	array('label'=>'Update System User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete System User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this system user?')),
);
?>

<h1>View System User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'username',
		'password',
		'email',
		'status',
		'last_login',
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
	),
)); ?>
