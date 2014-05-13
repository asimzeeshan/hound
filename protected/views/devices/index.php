<?php
/* @var $this DevicesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Devices',
);
?>

<h1>Devices</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	//'sortableAttributes'=>array('opt','ip_address'),
)); ?>
