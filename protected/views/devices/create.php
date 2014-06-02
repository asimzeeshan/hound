<?php
/* @var $this DevicesController */
/* @var $model Devices */
$this->pageTitle=$this->pageTitle() . ' - Create';
$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	'Create',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>