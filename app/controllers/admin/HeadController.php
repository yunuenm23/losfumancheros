<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Head;
use Sirius\Validation\Validator;


class HeadController extends BaseController{
	public function getIndex(){
		
		$head = Head::all();

		return $this->render('admin/head.twig', ['head' => $head]);

	}

	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('sititle', 'required');
		$validator->add('description', 'required');
		$validator->add('keywords', 'required');
		$validator->add('author', 'required');

		if($validator->validate($_POST)){
			$head = new Head();
			$head->sititle = $_POST['sititle'];
			$head->description = $_POST['description'];
			$head->keywords = $_POST['keywords'];
			$head->author = $_POST['author'];


			$head->save();
		}

		header('Location:' . BASE_URL . 'admin/head');
	}

	public function getHeadedit($postid){

		$head = Head::query()->where('id', $postid)->get();

		return $this->render('admin/headedit.twig', [
			'head' => $head
		]);

	}

	public function postHeadedit($postid){

		$head = Head::find($postid);

		$validator = new Validator();
		$head->sititle = $_POST['sititle'];
		$head->description = $_POST['description'];
		$head->keywords = $_POST['keywords'];
		$head->author = $_POST['author'];

		$footer = Head::find($postid);

		if($validator->validate($_POST)){
			$head->sititle = $_POST['sititle'];
			$head->description = $_POST['description'];
			$head->keywords = $_POST['keywords'];
			$head->author = $_POST['author'];

			$head->save();
		}

		header('Location:' . BASE_URL . 'admin/head');
		
	}

}