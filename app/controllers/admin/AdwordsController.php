<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Adword;
use Sirius\Validation\Validator;

class  AdwordsController extends BaseController{
	public function getIndex(){
		
		$adwords = Adword::all();

		return $this->render('admin/adwords.twig', ['adwords' => $adwords]);

	}
	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('script', 'required');

		if($validator->validate($_POST)){
			$adwords = new Adword();
			$adwords->script = $_POST['script'];

			$adwords->save();
		}

		header('Location:' . BASE_URL . 'admin/adwords');
	}
	public function getAdwordsedit($postid){
		$adwords = Adword::query()->where('id', $postid)->get();

		return $this->render('admin/adwordsedit.twig', [
			'adwords' => $adwords
		]);
	}
	public function postAdwordsedit($postid){

		$adwords = Adword::find($postid);

		$validator = new Validator();
		$validator->add('script', 'required');


		$adwords = Adword::find($postid);

		if($validator->validate($_POST)){
				$adwords->script = $_POST['script'];	
		}

		$adwords->save();

		header('Location:' . BASE_URL . 'admin/adwords');
	}
	public function getDelete($postid){

		$adwords = Adword::find($postid);
		$adwords->delete();
		header('Location:' . BASE_URL . 'admin/adwords');
	}
}