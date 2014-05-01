<?php

class EmailLogsController extends Controller
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
				'actions'=>array('sendemail','showmailtemplates', 'emaillogs','index','view','create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('asim'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Showmailtemplates
	 * 
	 */
	public function actionShowmailtemplates()
	{
		$model=new EmailTemplates;
		$template_id = Yii::app()->request->getPost('template_id');
		$template = $model->getTemplateBody($template_id);
		echo json_encode(array("value1" => $template['subject'],"value2" => $template['body']));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EmailLogs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailLogs']))
		{
			$model->attributes=$_POST['EmailLogs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionSendemail($emp_id){
		$model=new EmailTemplates;
		$model_nxb_managers =new Managers;

		$employeeData = array();
		$manager_email = '';

		$employeeDataAPIresponse = simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$emp_id.'&empName=');
		
		$employeeDataArray = json_decode($employeeDataAPIresponse->getSitting->response);

		if(count($employeeDataArray) != 0){
			$employeeData = $employeeDataArray[0];
		}
		
		if(isset($_POST['EmailTemplates']))
		{
			$_POST['EmailTemplates']['title'] = 'n/a';
			$model->attributes=$_POST['EmailTemplates'];

			if($model->validate()){
				$body = $model->attributes['body'];
				$employeeData = array();
				$manager_email = '';
				$employeeDataAPIresponse = simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$emp_id.'&empName=');
				$employeeDataArray = json_decode($employeeDataAPIresponse->getSitting->response);

				if(count($employeeDataArray) != 0){
					$employeeData = $employeeDataArray[0];
				}

				$arraytoreplace = array('{Manager_Name}','{Employee_Name}','{Employee_Id}','{Employee_Location}','{Employee_Sitting_Hall}');
				$replacedarray = array($employeeData->emp_manager_name,$employeeData->emp_name,$emp_id,$employeeData->emp_location,$employeeData->emp_hall);
				$parsed_body = str_replace($arraytoreplace,$replacedarray,$body);
				$parsed_subject = str_replace($arraytoreplace,$replacedarray,$_POST['EmailTemplates']['subject']);
				
				$to = explode(",",$_POST['EmailTemplates']['to']);
				$cc = explode(",",$_POST['EmailTemplates']['cc']);
				$bcc = explode(",",$_POST['EmailTemplates']['bcc']);
	
				// save the mail contents
				$email_data = array(
					'address'	=> $to,
					'ccaddress'	=> $cc,
					'bccaddress'=> $bcc,
					'subject'	=> $parsed_subject,
					'body'		=> $parsed_body,
					'user_id'	=> Yii::app()->user->id,
				);
				
				// save the email
				$template_id = (int)$model->id;
				$this->saveEmailLog($template_id, $email_data);
				
				// now send the email
				$this->sendMail($email_data);
	
				Yii::app()->user->setFlash('success', "The email has been sent to concerned line-managers ($to & $cc)");	
				$this->refresh();
			}
		}
		
		$this->render('sendemail',array(
			'model'=>$model,
			'manager_email'=>$manager_email,
			'employee_data'=>$employeeData,
			'emp_id'=>$emp_id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailLogs']))
		{
			$model->attributes=$_POST['EmailLogs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EmailLogs');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmailLogs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmailLogs']))
			$model->attributes=$_GET['EmailLogs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmailLogs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmailLogs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmailLogs $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='email-logs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
