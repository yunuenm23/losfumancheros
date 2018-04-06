<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Newsletter;
use Sirius\Validation\Validator;
use App\Models\Footer;

class TiendaController extends BaseController{
	public function getTienda(){	

		$head = Head::all();
		$footer = Footer::all();	
	
		// $store = Gallery::all();

		return $this->render('tienda.twig',[
			'head' => $head,
			'footer' => $footer
		]);
		// 	'store' => $store
		// ]);
	}
	public function postTienda(){
		
		$validator = new Validator();
		$validator->add('email', 'required');

		$validator = new Validator();
		$validator->add('email', 'required');
		$validator->add('name', 'required');
		$validator->add('city', 'required');

		if($validator->validate($_POST)){
			$newsletter = new Newsletter();

			$newsletter->email = $_POST['email'];
			$newsletter->name = $_POST['name'];
			$newsletter->city = $_POST['city'];

			$newsletter->save();
		}

		header('Location:' . BASE_URL . 'tienda');
	}
}