<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Footer;
use Sirius\Validation\Validator;


class FooterController extends BaseController{
	public function getIndex(){
		
		$footer = Footer::all();

		return $this->render('admin/footer.twig', ['footer' => $footer]);

	}

	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('hiring', 'required');
		$validator->add('city', 'required');
		$validator->add('facebook', 'required');
		$validator->add('twitter', 'required');
		$validator->add('youtube', 'required');
		$validator->add('instagram', 'required');
		$validator->add('developer', 'required');

		if($validator->validate($_POST)){
			$footer = new Footer();
			$footer->hiring = $_POST['hiring'];
			$footer->city = $_POST['city'];
			$footer->facebook = $_POST['facebook'];
			$footer->twitter = $_POST['twitter'];
			$footer->youtube = $_POST['youtube'];
			$footer->instagram =  $_POST['instagram'];
			$footer->developer = $_POST['developer'];

			$footer->save();
		}

		header('Location:' . BASE_URL . 'admin/footer');
	}

	public function getFooteredit($postid){

		$footer = Footer::query()->where('id', $postid)->get();

		return $this->render('admin/footeredit.twig', [
			'footer' => $footer
		]);

	}

	public function postFooteredit($postid){

		$footer = Footer::find($postid);

		$validator = new Validator();
		$validator->add('hiring', 'required');
		$validator->add('city', 'required');
		$validator->add('facebook', 'required');
		$validator->add('twitter', 'required');
		$validator->add('youtube', 'required');
		$validator->add('instagram', 'required');
		$validator->add('developer', 'required');

		$footer = Footer::find($postid);

		if($validator->validate($_POST)){
			$footer->hiring = $_POST['hiring'];
			$footer->city = $_POST['city'];
			$footer->facebook = $_POST['facebook'];
			$footer->twitter = $_POST['twitter'];
			$footer->youtube = $_POST['youtube'];
			$footer->instagram =  $_POST['instagram'];
			$footer->developer = $_POST['developer'];

			$footer->save();
		}

		header('Location:' . BASE_URL . 'admin/footer');
		
	}

}