<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Partner;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;

class PartnerController extends BaseController{
	public function getIndex(){
		
		$partner = Partner::all();

		return $this->render('admin/partners.twig', ['partner' => $partner]);

	}

	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('url', 'required');


		$upload = new UploadHandler('images/partners/');
		$folder = 'images/partners/';
		$logo = $upload->process($_FILES['logo']);

		if($validator->validate($_POST)){
			$partner = new Partner();
			$partner->url = $_POST['url'];

			if($logo->isValid()){
				$partner->logo = $folder.$logo->name;
				$partner->save();
				$logo->confirm();
			}

			$partner->save();
		}

		header('Location:' . BASE_URL . 'admin/partners');
	}

	public function getPartnersedit($postid){
		$partner = Partner::query()->where('id', $postid)->get();

		return $this->render('admin/partnersedit.twig', [
			'partner' => $partner
		]);
	}

	public function postPartnersedit($postid){

		$partner = Partner::find($postid);

		$validator = new Validator();
		$validator->add('url', 'required');

		$upload = new UploadHandler('images/partners/');
		$folder = 'images/partners/';
		$logo = $upload->process($_FILES['logo']);

		$partner = Partner::find($postid);

		if($validator->validate($_POST)){
				$partner->url = $_POST['url'];

				if($logo->isValid()){
					$partner->logo = $folder.$logo->name;
					$partner->save();
					$logo->confirm();
				}

				$partner->save();
		}					

		header('Location:' . BASE_URL . 'admin/partners');

	}
	public function getDelete($postid){

		$partner = Partner::find($postid);
		$partner->delete();
		header('Location:' . BASE_URL . 'admin/partners');
	}
}