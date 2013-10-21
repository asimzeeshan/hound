<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;


$sys_users_active	= Users::model()->count('status=:status', array(':status' => 1));
$sys_users_inactive = Users::model()->count('status=:status', array(':status' => 0));

$devices_empid1 = Devices::model()->count('emp_id=:emp_id', array(':emp_id' => ''));
$devices_empid2 = Devices::model()->count('emp_id<>:emp_id', array(':emp_id' => ''));
?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?> <i>Statistics!</i></h1>

<table width="100%" border="1" cellspacing="1" cellpadding="3" align="center" bordercolor="#000000">
  <tr>
    <td><img src="https://chart.googleapis.com/chart?cht=p3&chs=425x170&chd=t:<?php echo $sys_users_inactive; ?>,<?php echo $sys_users_active; ?>&chl=Inactive+<?php echo "(".$sys_users_inactive.")"; ?>|Active+<?php echo "(".$sys_users_active.")"; ?>&chtt=System Users"></td>
    <td><img src="https://chart.googleapis.com/chart?cht=p3&chco=76A4FB&chs=425x170&chd=t:<?php echo $devices_empid1; ?>,<?php echo $devices_empid2; ?>&chl=with+EmpID+<?php echo "(".$devices_empid1.")"; ?>|w%2Fo+EmpID+<?php echo "(".$devices_empid2.")"; ?>&chtt=Devices+with+EmpID&chxt=x,y,r,t"></td>
  </tr>
</table>
<?php
// free memory
unset($sys_users, $sys_users_active, $sys_users_inactive);



?>
