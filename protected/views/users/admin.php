<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'System Users'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage System Users', 'url'=>array('admin')),
	array('label'=>'Create System User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php if(Yii::app()->user->hasFlash('failed')):?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('failed'); ?>
    </div>
<?php endif; ?>
<h4><?php echo CHtml::link('Create User', array('/users/create'))?> </h4>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<h1>Manage System Users</h1>",
		));
		
	?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'first_name',
		'last_name',
		'username',
		'email',
		array(
			'name'=>'status',
			'value'=>'$data->status==1 ? "Active" : "Inactive"'
		),
		'roles',
		'last_login',
		/*
		'created',
		'created_by',
		'modified',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php $this->endWidget();?>