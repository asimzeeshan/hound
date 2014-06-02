<?php
/* @var $this ManagersController */
/* @var $model Managers */
$this->pageTitle=$this->pageTitle() . ' - Create';
$this->breadcrumbs=array(
	'Managers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Managers', 'url'=>array('index')),
	array('label'=>'Manage Managers', 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>