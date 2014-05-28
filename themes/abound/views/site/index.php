<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<?php
$gridDataProvider = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
    array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
	array('id'=>4, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>5, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));
?>

<div class="row-fluid">
  <div class="span3 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="weekly-visit">8,4,6,5,9,10</li>
		<li class="stat-count"><span>$23,000</span><span>Weekly Sales</span></li>
		<li class="stat-percent"><span class="text-success stat-percent">20%</span></li>
	  </ul>
	</div>
  </div>
  <div class="span3 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="new-visits">2,4,9,1,5,7,6</li>
		<li class="stat-count"><span>$123,780</span><span>Monthly Sales</span></li>
		<li class="stat-percent"><span class="text-error stat-percent">-15%</span></li>
	  </ul>
	</div>
  </div>
  <div class="span3 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="unique-visits">200,300,500,200,300,500,1000</li>
		<li class="stat-count"><span>$12,456</span><span>Open Invoices</span></li>
		<li class="stat-percent"><span class="text-success stat-percent">10%</span></li>
	  </ul>
	</div>
  </div>
  <div class="span3 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="">1000,3000,6000,8000,3000,8000,10000</li>
		<li class="stat-count"><span>$25,000</span><span>Overdue</span></li>
		<li class="stat-percent"><span><span class="text-success stat-percent">20%</span></li>
	  </ul>
	</div>
  </div>
</div>

<div class="row-fluid">

    
	<div class="span9">
      <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-picture"></span>Operations Chart',
			'titleCssClass'=>''
		));
		?>
        
        <div class="auto-update-chart" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
        
        <?php $this->endWidget(); ?>
        
	</div>
	<div class="span3">
		<div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/credit.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php 
					$devices_query = Yii::app()->db->createCommand()
   								 ->select('count(*) as count')
    							 ->from('Devices')
    							 ->queryRow();
	 							echo $devices_query['count'];
				?></span>
                <span class="summary-title"><a href="/abuse_reportr/index.php/devices/index">Total Devices</a> </span>
            </li>
            <li>
            	<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Open Invoices">
                </span>
                <span class="summary-number"><?php 
					$employees_query = Yii::app()->db->createCommand()
   								 ->select('count(*) as count')
    							 ->from('employees')
    							 ->queryRow();
	 							echo $employees_query['count'];
				?></span>
                <span class="summary-title"><a href="/abuse_reportr/index.php/employees/index"> Total Employees</a></span>
            </li>
            <li>
            	<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Open Quotes<">
                </span>
                <span class="summary-number"><?php 
					$managers_query = Yii::app()->db->createCommand()
   								 ->select('count(*) as count')
    							 ->from('managers')
    							 ->queryRow();
	 							echo $managers_query['count'];
				?></span>
                <span class="summary-title"> <a href="/abuse_reportr/index.php/managers/index">Total Managers</a></span>
            </li>
            <li>
            	<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Active Members">
                </span>
                <span class="summary-number"><?php 
					$users_query = Yii::app()->db->createCommand()
   								 ->select('count(*) as count')
    							 ->from('users')
								 //->join('tbl_profile p', 'u.id=p.user_id')
   								 ->where('status=:id', array(':id'=>1))
    							 ->queryRow();
	 							echo $users_query['count'];
				?></span>
                <span class="summary-title"><a href="/abuse_reportr/index.php/users/index">Active Users</a></span>
            </li>
            <li>
          </ul>
        </div>

	</div>
</div>


<div class="row-fluid">
	<div class="span6">
	  <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"All Employees",
		));
		
	?>
<?php
	   //$model = new Employees;
	   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employees-grid',
	//'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
	'htmlOptions'=>array('style'=>'height:450px;'),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'emp_id',
		array(
		'name'=>'name',
		'htmlOptions' => array('style' => 'width:1000px;'),
		),
		'email',
		'joining_date',
		'location',
		'hall',
		array(
		'name'=>'manager1_id',
		'type'=>'text',
		'filter'=>$model->managersList(),
		'value'=>'isset($data->manager1) ? $data->manager1->name: "n/a"',
		),
		array(
		'name'=>'manager2_id',
		'type'=>'raw',
		'filter'=>$model->managersList(),
		'value'=>'isset($data->manager2) ? $data->manager2->name : "n/a"',
		),
	),
));?>
<?php $this->endWidget();?>
	</div><!--/span-->
	<div class="span6">
		 <?php /*$this->widget('zii.widgets.grid.CGridView', array(
			//'type'=>'striped bordered condensed',
			'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
			'dataProvider'=>$gridDataProvider,
			'template'=>"{items}",
			'columns'=>array(
				array('name'=>'id', 'header'=>'#'),
				array('name'=>'firstName', 'header'=>'First name'),
				array('name'=>'lastName', 'header'=>'Last name'),
				array('name'=>'language', 'header'=>'Language'),
				array('name'=>'usage', 'header'=>'Usage', 'type'=>'raw'),
				
			),
		)); */?>
        <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"All Managers",
			
		));
		
	?>

<?php 
	$model = new Managers;
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'managers-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'htmlOptions'=>array('style'=>'height:450px'),
	//'htmlOptions'=>array('style'=>'height:50px'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'email',
		//'created',
		//'modified',
	),
)); ?>
<?php $this->endWidget();?>
        	
	</div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
	<div class="span6">
	  <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-large"></span>Income Chart',
			'titleCssClass'=>''
		));
		?>
        		<?php

			$cs = Yii::app()->clientScript;
			

			$dataJs = "data = new Array();";
			$d1 = '[[1, 3+randNum()], [2, 6+randNum()], [3, 9+randNum()], [4, 12+randNum()],[5, 15+randNum()],[6, 18+randNum()],[7, 21+randNum()],[8, 15+randNum()],[9, 18+randNum()],[10, 21+randNum()],[11, 24+randNum()],[12, 27+randNum()],[13, 30+randNum()],[14, 33+randNum()],[15, 24+randNum()],[16, 27+randNum()],[17, 30+randNum()],[18, 33+randNum()],[19, 36+randNum()],[20, 39+randNum()],[21, 42+randNum()],[22, 45+randNum()],[23, 36+randNum()],[24, 39+randNum()],[25, 42+randNum()],[26, 45+randNum()],[27,38+randNum()],[28, 51+randNum()],[29, 55+randNum()], [30, 60+randNum()]]';
		 $d2 = '[[1, randNum()-5], [2, randNum()-4], [3, randNum()-4], [4, randNum()],[5, 4+randNum()],[6, 4+randNum()],[7, 5+randNum()],[8, 5+randNum()],[9, 6+randNum()],[10, 6+randNum()],[11, 6+randNum()],[12, 2+randNum()],[13, 3+randNum()],[14, 4+randNum()],[15, 4+randNum()],[16, 4+randNum()],[17, 5+randNum()],[18, 5+randNum()],[19, 2+randNum()],[20, 2+randNum()],[21, 3+randNum()],[22, 3+randNum()],[23, 3+randNum()],[24, 2+randNum()],[25, 4+randNum()],[26, 4+randNum()],[27,5+randNum()],[28, 2+randNum()],[29, 2+randNum()], [30, 3+randNum()]]';
		  $placeholder = '$(".visitors-chart");';
		  $options = '{
				grid: {
					show: true,
				    aboveData: true,
				    color: "#3f3f3f" ,
				    labelMargin: 5,
				    axisMargin: 0, 
				    borderWidth: 0,
				    borderColor:null,
				    minBorderMargin: 5 ,
				    clickable: true, 
				    hoverable: true,
				    autoHighlight: true,
				    mouseActiveRadius: 20
				},
		        series: {
		        	grow: {
		        		active: false,
		        		stepMode: "linear",
		        		steps: 50,
		        		stepDelay: true
		        	},
		            lines: {
	            		show: true,
	            		fill: true,
	            		lineWidth: 4,
	            		steps: false
		            	},
		            points: {
		            	show:true,
		            	radius: 5,
		            	symbol: "circle",
		            	fill: true,
		            	borderColor: "#fff"
		            }
		        },
		        legend: { 
		        	position: "ne", 
		        	margin: [0,-25], 
		        	noColumns: 0,
		        	labelBoxBorderColor: null,
		        	labelFormatter: function(label, series) {
					    // just add some space to labes
					    return label+"&nbsp;&nbsp;";
					 }
		    	},
		        yaxis: { min: 0 },
		        xaxis: {ticks:11, tickDecimals: 0},
		        colors: chartColours,
		        shadowSize:1,
		        tooltip: true, //activate tooltip
				tooltipOpts: {
					content: "%s : %y.0",
					shifts: {
						x: -30,
						y: -50
					}
				}
		    };';
			$dataJs ="$.plot(".$placeholder.", [ 

        		{
					
        			label: 'Visits', 
        			data: ".$d1.",
        			lines: {fillColor: '#f2f7f9'},
        			points: {fillColor: '#88bbc8'}
        		}, 
        		{	
        			label: 'Unique Visits', 
        			data: ".$d2.",
        			lines: {fillColor: '#fff8f2'},
        			points: {fillColor: '#ed7a53'}
        		} 

        	], options);
	        
    });";   
			foreach($num_employees as $k => $v){
				$color = str_pad( dechex( mt_rand( 0, 255 ) ), 3, '0', STR_PAD_LEFT);
				$dataJs .= "data[{$k}] = { label: '{$v->name}',  data: {$v->_numEmployees}, color: '#{$color}'};";
			}
			$dataJs .= '$.plot($(".simple-pie"), data, 
		{
			series: {
				pie: { 
					show: true,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						color: "#fff",
						width: 2
					},
					startAngle: 2,
				    combine: {
	                    color: "pink",
	                    threshold: 0.05
	                },
	                label: {
	                    show: true,
	                    radius: 1,
	                    formatter: function(label, series){
	                        return "<div class=\"pie-chart-label\">"+label+"&nbsp;"+Math.round(series.percent)+"%</div>";
	                    }
	                }
				},
				grow: {	active: false}
			},
			legend:{show:false},
			grid: {
	            hoverable: true,
	            clickable: true
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				}
			}
		});
	';
			$cs->registerScript('chart_js', $dataJs);
			//echo "<pre>";
			//print_r ($model); die;
            /*$query = Yii::app()->db->createCommand()
   								 ->select('count(name) as count')
    							 ->from('employees')
								 //->join('managers m', 'e.manager1_id=m.id')
   								 ->where('manager1_id=:id', array(':id'=>1))
    							 ->queryRow();
	 							echo $query['count'];*/
			
			
			?>
        
        <div class="visitors-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
        
        <?php $this->endWidget(); ?>
	</div><!--/span-->
    <div class="span6">
    	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<i class='icon-tint'></i> Pie Charts",
		));
	?>
    		<?php
			$cs = Yii::app()->clientScript;
			$dataJs = "data = new Array();";
			foreach($num_employees as $k => $v){
				$color = str_pad( dechex( mt_rand( 0, 255 ) ), 3, '0', STR_PAD_LEFT);
				$dataJs .= "data[{$k}] = { label: '{$v->name}',  data: {$v->_numEmployees}, color: '#{$color}'};";
			}
			$dataJs .= '$.plot($(".simple-pie"), data, 
		{
			series: {
				pie: { 
					show: true,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						color: "#fff",
						width: 2
					},
					startAngle: 2,
				    combine: {
	                    color: "pink",
	                    threshold: 0.05
	                },
	                label: {
	                    show: true,
	                    radius: 1,
	                    formatter: function(label, series){
	                        return "<div class=\"pie-chart-label\">"+label+"&nbsp;"+Math.round(series.percent)+"%</div>";
	                    }
	                }
				},
				grow: {	active: false}
			},
			legend:{show:false},
			grid: {
	            hoverable: true,
	            clickable: true
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				}
			}
		});
	';
			$cs->registerScript('chart_js', $dataJs);
			//echo "<pre>";
			//print_r ($model); die;
            /*$query = Yii::app()->db->createCommand()
   								 ->select('count(name) as count')
    							 ->from('employees')
								 //->join('managers m', 'e.manager1_id=m.id')
   								 ->where('manager1_id=:id', array(':id'=>1))
    							 ->queryRow();
	 							echo $query['count'];*/
			
			
			?>
  		<div class="simple-pie" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
	<?php $this->endWidget();?>
    </div>
	<!--<div class="span2">
    	<input class="knob" data-width="100" data-displayInput=false data-fgColor="#5EB95E" value="35">
    </div>
	<div class="span2">
     	<input class="knob" data-width="100" data-cursor=true data-fgColor="#B94A48" data-thickness=.3 value="29">
    </div>
	<div class="span2">
         <input class="knob" data-width="100" data-min="-100" data-fgColor="#F89406" data-displayPrevious=true value="44">     	
	</div><!--/span-->
</div><!--/row-->

          


<script>
            $(function() {

                $(".knob").knob({
                    /*change : function (value) {
                        //console.log("change : " + value);
                    },
                    release : function (value) {
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : " + this.value);
                    },*/
                    draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.3)
                                && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.3)
                                    && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });

                // Example of infinite knob, iPod click wheel
                var v, up=0,down=0,i=0
                    ,$idir = $("div.idir")
                    ,$ival = $("div.ival")
                    ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
                    ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
                $("input.infinite").knob(
                                    {
                                    min : 0
                                    , max : 20
                                    , stopper : false
                                    , change : function () {
                                                    if(v > this.cv){
                                                        if(up){
                                                            decr();
                                                            up=0;
                                                        }else{up=1;down=0;}
                                                    } else {
                                                        if(v < this.cv){
                                                            if(down){
                                                                incr();
                                                                down=0;
                                                            }else{down=1;up=0;}
                                                        }
                                                    }
                                                    v = this.cv;
                                                }
                                    });
            });
        </script>