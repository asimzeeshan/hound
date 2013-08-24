<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'System Users'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage System Users', 'url'=>array('admin')),
	array('label'=>'Create System User', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update System User <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>