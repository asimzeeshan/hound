<?php
/* @var $this ConfigurationsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=$this->pageTitle(). ' - Configurations/index';
$this->breadcrumbs=array(
	'Configurations',
);
?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
 ?>
