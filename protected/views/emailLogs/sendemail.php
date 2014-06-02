<?php
/* @var $this AbuselistController */
/* @var $model EmailTemplates */
$this->pageTitle=$this->pageTitle() . ' - SendEmail';
$this->breadcrumbs=array(
	'Email Logs'=>array('index'),
	'Send',
);

$this->menu=array(
	array('label'=>'List Email Logs', 'url'=>array('index')),
	array('label'=>'Manage Email Logs', 'url'=>array('admin')),
);
?>

<h1>Send Email</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info" style="color:green">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
	<br/>
<?php else: ?>

<?php echo $this->renderPartial('_form_send_email', array('model'=>$model,'manager_email'=>$manager_email,'employee_data'=>$employee_data,'emp_id'=>$emp_id)); 
endif;
?>