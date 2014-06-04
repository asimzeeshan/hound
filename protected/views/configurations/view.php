<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */
$this->pageTitle=$this->pageTitle(). ' - View';
$this->breadcrumbs=array(
	'Configurations',
);
?>

<?php //echo $model->id;
 ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'from_name',
		'from_email',
		'bcc',
		'notify_email',
                'created',
                    array(
                                    'name'=>'created_by',
                                    'value'=>$model->CreatedBy->name(),

                                    ),
                    'modified',
                    array(
                                    'name'=>'modified_by',
                                    'value'=>$model->ModifiedBy->name(),
                                    ),
	),
)); ?>
