<?php
/* @var $this DevicesController */
/* @var $model Devices */

$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Devices <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>