<?php
/* @var $this ConfigurationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Configurations',
);

$this->menu=array(
	array('label'=>'Create Configurations', 'url'=>array('create')),
	array('label'=>'Manage Configurations', 'url'=>array('admin')),
);
?>

<h1>Configurations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
