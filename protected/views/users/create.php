<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Manage System Users'=>array('admin'),
	'Create System User',
);

$this->menu=array(
	array('label'=>'Manage System Users', 'url'=>array('admin')),
);
?>

<h1>Create System User</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>