<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Bio;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;

class BioController extends BaseController{
	public function getIndex(){
		
		$biography = Bio::all();

		return $this->render('admin/bio.twig', ['biography' => $biography]);

	}
	public function postIndex(){ 

		
	}
	public function getBioedit($postid){
		$biography = Bio::query()->where('id', $postid)->get();

		return $this->render('admin/bioedit.twig', [
			'biography' => $biography
		]);
	}
	public function postBioedit($postid){

		$biography = Bio::find($postid);

		$validator = new Validator();
		$validator->add('section', 'required');
		$validator->add('title', 'required');
		$validator->add('text', 'required');

		$upload = new UploadHandler('images/admin/');
		$folder = 'images/admin/';
		$folderDefault = 'images/';
		$imgBand = $upload->process($_FILES['band']);

		$biography = Bio::find($postid);

		if($validator->validate($_POST)){
				$biography->section = $_POST['section'];
				$biography->title = $_POST['title'];
				$biography->text = $_POST['text'];

			if($imgBand->isValid()){
				$biography->band = $folder.$imgBand->name;
				$biography->save();
				$imgBand->confirm();
			}else{
				$biography->band = $folderDefault.'band_default.png';
			}

			$biography->save();
		}
		header('Location:' . BASE_URL . 'admin/bio');
	}

}