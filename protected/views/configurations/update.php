<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */

$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'System Configurations',
);
?>
<?php if(Yii::app()->user->hasFlash('save')): ?>
<?php echo Yii::app()->user->getFlash('save'); ?>
<?php endif;?>
<h1> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>