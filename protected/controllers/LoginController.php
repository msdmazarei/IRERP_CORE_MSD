<?php
use IRERP\Basics\SmartClient\SmartClientController;


class LoginController extends SmartClientController
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionLogin()
	{
		$username='';
		$password='';
		if(isset($_POST['username'])) $username=$_POST['username'];
		if(isset($_POST['password'])) $password=$_POST['password'];
		
		if($username=="jahad" && $password='jahad123')
		{
			print_r('All thing is ok');
			//Set Session
			$rt=ApplicationHelpers::User2Session('jahad',0);
			$_SESSION[$rt['Key']]=$rt['Value'];
			//Redirect To Site
			$this->redirect($this->baseUrl.'/IranERP/');
			//$this->render('loginsuccess');
		} 
		else {
			$this->render('index');
		}
		
		
	}
}

?>