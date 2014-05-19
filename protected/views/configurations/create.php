<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */

$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Configurations', 'url'=>array('index')),
	array('label'=>'Manage Configurations', 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>