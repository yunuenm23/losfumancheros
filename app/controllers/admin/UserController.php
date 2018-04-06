<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends BaseController{
	public function getIndex(){
		
		$users = User::all();

		return $this->render('admin/users.twig', ['users' => $users]);

	}
	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('username', 'required');
		$validator->add('name', 'required');
		$validator->add('lastname', 'required');
		$validator->add('email', 'email');
		$validator->add('password', 'required');

		$upload = new UploadHandler('images/admin/');
		$folder = 'images/admin/';
		$imgProfile = $upload->process($_FILES['imgProfile']);

		if($validator->validate($_POST)){
			$users = new User();
			$users->username = $_POST['username'];
			$users->name = $_POST['name'];
			$users->lastname = $_POST['lastname'];
			$users->email = $_POST['email'];
			$users->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			if($imgProfile->isValid()){
				$users->profile_photo = $folder.$imgProfile->name;
				$users->save();
				$imgProfile->confirm();
			}else{
				$users->profile_photo = $folder.'user_default.png';
			}	

			$users->save();

		}
		header('Location:' . BASE_URL . 'admin/users');
	}

	public function getUseredit($postid){
		$users = User::query()->where('id', $postid)->get();

		return $this->render('admin/useredit.twig', [
			'users' => $users
		]);
	}
	
	public function postUseredit($postid){

		$users = User::find($postid);

		$validator = new Validator();
		$validator->add('username', 'required');
		$validator->add('name', 'required');
		$validator->add('lastname', 'required');
		$validator->add('email', 'email');
		$validator->add('password', 'required');

		$upload = new UploadHandler('images/admin/');
		$folder = 'images/admin/';
		$imgProfile = $upload->process($_FILES['profilePhoto']);

		$users = User::find($postid);

		if($validator->validate($_POST)){
				$users->username = $_POST['username'];
				$users->name = $_POST['name'];
				$users->lastname = $_POST['lastname'];
				$users->email = $_POST['email'];
				$users->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

				if($imgProfile->isValid()){
					$users->profile_photo = $folder.$imgProfile->name;
					$users->save();
					$imgProfile->confirm();
				}

				$users->save();
		}

		header('Location:' . BASE_URL . 'admin/users');
		
	}
	public function getDelete($postid){

		$users = User::find($postid);
		$users->delete();
		header('Location:' . BASE_URL . 'admin/users');
	}
}