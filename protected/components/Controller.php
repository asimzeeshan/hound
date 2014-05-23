<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 *
	 * Adding ability to send email using phpMailer
	 */
	public function sendMail($args){
		
		extract($args);
			$mail             = new PHPMailer();
			$body             = str_replace("[\]",'',$body);

			$mail->AddReplyTo('noc@nxvt.com', 'NOC Team');
			$mail->SetFrom('noc@nxvt.com', 'NOC Team');
			
			foreach((array) $address as $k=>$v){
				$mail->AddAddress($v, $v);
			}
			
			foreach((array) $ccaddress as $k=>$v){
				$mail->AddCC($v, $v);
			}

			foreach((array) $bccaddress as $k=>$v){
				$mail->AddBCC($v, $v);
			}
			
			$mail->Subject    = $subject;
			$mail->MsgHTML($body);

			//$mail->AddAttachment("images/phpmailer.gif");      // attachment

			if(!$mail->Send()) {
				die("Mailer Error: " . $mail->ErrorInfo);
			} else {
				echo "Message has been sent!";
			}
	}
	
	/**
	 *
	 * Adding ability to save the email being sent
	 */
	public function saveEmailLog($template_id, $args) {
		extract($args);
		$email_to = $address;
		$email_cc = $ccaddress;
		
		// get logged-in user id else assume its being sent from the system
		$user_id = isset(Yii::app()->user->id) ? Yii::app()->user->id : 1;
		
		if (is_array($email_to)) {
			$email_to = implode(", ", $email_to);	
		}
		
		if (is_array($email_cc)) {
			$email_cc = implode(", ", $email_cc);	
		}

		$elog = new EmailLogs;
		$elog->template_id 	= $template_id;
		$elog->email_to 	= $email_to;
		$elog->email_cc 	= $email_cc;
		$elog->subject 		= $subject;
		$elog->body 		= $body;
		$elog->user_id 		= $user_id;
		$elog->save();
	}
}