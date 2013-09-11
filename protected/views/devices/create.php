<?php
/* @var $this DevicesController */
/* @var $model Devices */

$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	'Create',
);

?>

<h1>Create Devices</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>