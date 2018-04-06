<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Newsletter;
use Sirius\Validation\Validator;

class NewsletterController extends BaseController{
	public function getIndex(){
		
		$newsletter = Newsletter::query()->orderBy('created_at','desc')->get();

		return $this->render('admin/newsletter.twig', ['newsletter' => $newsletter]);

	}


	public function getDelete($postid){

		$newsletter = Newsletter::find($postid);
		$newsletter->delete();

		header('Location:' . BASE_URL . 'admin/newsletter');
	}
	
}