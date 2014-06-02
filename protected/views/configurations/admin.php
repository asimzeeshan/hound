<?php
/* @var $this ConfigurationsController */
/* @var $model Configurations */

$this->breadcrumbs=array(
	'Configurations',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#configurations-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'configurations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'from_name',
		'from_email',
		'bcc',
		'notify_email',*/
		/*
		'records_per_page',
		'created',
		'created_by',
		'modified',
		'modified_by',
		*/
		/*array(
			'class'=>'CButtonColumn',
		),
	),
)); */
echo "Your request is invalid.";
?>
