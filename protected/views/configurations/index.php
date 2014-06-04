<?php
/* @var $this ConfigurationsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=$this->pageTitle(). ' - Configurations/index';
$this->breadcrumbs=array(
	'Configurations',
);
?>
<?php if(Yii::app()->user->hasFlash('save')): ?>
<?php echo Yii::app()->user->getFlash('save'); ?>
<?php endif;?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_form',
));
 ?>
