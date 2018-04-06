<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Footer;

use Sirius\Validation\Validator;

class IndexController extends BaseController{
	public function getIndex(){

		$head = Head::all();	

		$footer = Footer::all();

		return $this->render('layout.twig', [
			'head' => $head,
			'footer' => $footer
		]);
	}

}