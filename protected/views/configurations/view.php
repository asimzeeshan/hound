<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */
$this->pageTitle=$this->pageTitle();
$this->breadcrumbs=array(
	'Configurations',
);
?>

<?php //echo $model->id;
echo "Your request is invalid.";
 ?>

<?php /*$this->widget('zii.widgets.CDetailView', array(
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
		//'records_per_page',
		//'created',
		//'created_by',
		//'modified',
		//'modified_by',
	),
)); */?>
