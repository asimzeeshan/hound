<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */

$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'System Configurations',
);

$this->menu=array(
	array('label'=>'List Configurations', 'url'=>array('index')),
	array('label'=>'Create Configurations', 'url'=>array('create')),
	array('label'=>'View Configurations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Configurations', 'url'=>array('admin')),
);
?>

<h1> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>