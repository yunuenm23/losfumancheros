<?php
namespace App\Controllers\Admin;

use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Controllers\BaseController;

class MailController extends BaseController{
	public function getIndex(){
			
		return $this->render('admin/mail.twig');
	}
}