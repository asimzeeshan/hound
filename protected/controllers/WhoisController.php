<?php
class WhoisController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$arraynew = array();
		if( isset($_REQUEST['yt0']) ) { // if form is submitted (button id)
			if($_REQUEST['search'] != '') { // if the search has some value
				if($_REQUEST['type'] == 'emp_id') {
					$model = new Devices;
					$users_details = $model->searchByEmpID( $_REQUEST['search'] );
					$arraynew = array();
					foreach( $users_details as $details ) {
						$detail = $details->attributes;
						$detail['picture'] = $details->picture;
						$arraynew[] = $detail;
						
					}
				} elseif ($_REQUEST['type'] == 'ip_addr') {
					$model = new Devices;
					$users_details = $model->searchByIP( $_REQUEST['search'] );
					$arraynew = array();
					foreach( $users_details as $details ) {
						$detail = $details->attributes;
						$detail['picture'] = $details->picture;
						$arraynew[] = $detail;

					}
					
				}
			} else {
				Yii::app()->user->setFlash('whois_failed', "Please enter what you want to search!");
			}
		}
		$this->render('index', array( 'userdata' => $arraynew ));
	}
}