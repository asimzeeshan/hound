<?php
/* @var $this EmailLogsController */
/* @var $model EmailLogs */
$this->pageTitle=$this->pageTitle() . ' - Create';
$this->breadcrumbs=array(
	'Email Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmailLogs', 'url'=>array('index')),
	array('label'=>'Manage EmailLogs', 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>