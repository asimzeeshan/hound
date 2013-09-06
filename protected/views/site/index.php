<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?> <i>Statistics!</i></h1>

<table width="100%" border="1" cellspacing="1" cellpadding="3" align="center" bordercolor="#000000">
  <tr>
    <td><img src="https://chart.googleapis.com/chart?cht=p3&chs=425x170&chd=t:1,8&chl=Inactive|Active"></td>
    <td>&nbsp;</td>
  </tr>
</table>
