<?php
/* @var $this UsersController */
/* @var $model Users */
$this->pageTitle=$this->pageTitle() . ' - Create';
$this->breadcrumbs=array(
	'Manage System Users'=>array('admin'),
	'Create System User',
);

$this->menu=array(
	array('label'=>'Manage System Users', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
