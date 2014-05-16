<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Forms';
$this->breadcrumbs=array(
	'Configurations',
);
?>

<div class="page-header">
	
</div>

<div class="row-fluid">
  <div class="span6">
  
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<h1>Configurations</h1>",
	));
	
?>
<?php
	echo(CHtml::beginForm());


	echo(CHtml::label('Title', 'name'));
	echo(CHtml::textField('name'));		
	
	echo(CHtml::label('From Name', 'email'));
	echo(CHtml::textField('email'));
	
	echo(CHtml::label('From Email', 'email'));
	echo(CHtml::textField('email'));
	
	echo(CHtml::label('BCC', 'email'));
	echo(CHtml::textField('email'));
	
	echo(CHtml::label('Send To', 'email'));
	echo(CHtml::textField('email'));		
	
echo(CHtml::endForm());
?>

<?php $this->endWidget();?>

  