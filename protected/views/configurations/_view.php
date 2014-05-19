<?php
/* @var $this ConfigurationsController */
/* @var $data Configurations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_name')); ?>:</b>
	<?php echo CHtml::encode($data->from_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_email')); ?>:</b>
	<?php echo CHtml::encode($data->from_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bcc')); ?>:</b>
	<?php echo CHtml::encode($data->bcc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_email')); ?>:</b>
	<?php echo CHtml::encode($data->notify_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('records_per_page')); ?>:</b>
	<?php echo CHtml::encode($data->records_per_page); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	*/ ?>

</div>