<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <?php echo '<a class="brand" href="#">'.$this->pageTitle=$this->pageTitle().' <small></small></a>'; ?>
          
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array('/site/index')),
						array('label'=>'Whois', 'url'=>array('/whois/index'), 'visible'=>!Yii::app()->user->isGuest),

						array('label'=>'Devices <span class="caret"></span>', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
							array('label'=>'Devices', 'url'=>array('/devices/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Devices w/o EmpID', 'url'=>array('/devices/withoutEmpIdList'), 'visible'=>!Yii::app()->user->isGuest),
                        )),
						
						array('label'=>'Employees & Managers <span class="caret"></span>', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
							array('label'=>'All Employees', 'url'=>array('/employees/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Managers', 'url'=>array('/managers/admin'), 'visible'=>!Yii::app()->user->isGuest),
							 )),

						array('label'=>'System <span class="caret"></span>', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        
						'items'=>array(
							array('label'=>'Email Logs', 'url'=>array('/emailLogs/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Email Templates', 'url'=>array('/emailTemplates/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Configurations', 'url'=>array('/configurations/update/1'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'System Users', 'url'=>array('/users/admin'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->isSuperAdmin()),
							 )),
						

						array('label'=>'abound menu <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
							array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs')),
							array('label'=>'Forms', 'url'=>array('/site/page', 'view'=>'forms')),
							array('label'=>'Tables', 'url'=>array('/site/page', 'view'=>'tables')),
							array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
							array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
                        )),
                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                        array('label'=>'My Account <span class="caret"></span>', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'Change Password', 'url'=>array('/users/changePassword'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        )),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),

                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->