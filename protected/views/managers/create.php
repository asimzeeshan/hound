<?php
/* @var $this ManagersController */
/* @var $model Managers */

$this->breadcrumbs=array(
	'Managers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Managers', 'url'=>array('index')),
	array('label'=>'Manage Managers', 'url'=>array('admin')),
);
?>

<h1>Create Managers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>