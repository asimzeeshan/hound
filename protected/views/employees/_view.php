<?php
/* @var $this EmployeesController */
/* @var $data Employees */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
	<?php echo CHtml::link(CHtml::image($data->pic,'alt',array('width'=>'100px')),$data->pic, array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('joining_date')); ?>:</b>
	<?php echo CHtml::encode($data->joining_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_pic')); ?>:</b>
	<?php echo CHtml::link(CHtml::image($data->location_pic,'alt',array('width'=>'750px')),$data->location_pic, array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hall')); ?>:</b>
	<?php echo CHtml::encode($data->hall); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('manager1_id')); ?>:</b>
	<?php echo CHtml::encode($data->manager1_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manager2_id')); ?>:</b>
	<?php echo CHtml::encode($data->manager2_id); ?>
	<br />

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