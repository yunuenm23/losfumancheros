<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Concierto;
use App\Models\Adword;
use App\Models\Newsletter;
use Sirius\Validation\Validator;
use App\Models\Footer;

class ConciertosController extends BaseController{
	public function getConciertos(){

		$head = Head::all();
		$footer = Footer::all();		
	
		$shows = Concierto::query()->orderBy('id','asc')->get();

		$adwords = Adword::all();


		return $this->render('conciertos.twig', [
			'head' => $head,
			'shows' => $shows,
			'adwords' => $adwords,
			'footer' => $footer
		]);
	}
	public function postConciertos(){
		
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

		header('Location:' . BASE_URL . 'conciertos');
	}
}