<?php
/* @var $this DevicesController */
/* @var $model Devices */
$this->pageTitle=$this->pageTitle() . ' - Update';
$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>