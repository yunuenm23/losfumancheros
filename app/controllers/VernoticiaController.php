<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Noticia;
use App\Models\Adword;
use App\Models\Newsletter;
use Sirius\Validation\Validator;
use App\Models\Footer;

class VernoticiaController extends BaseController{
	public function getVernoticia($id){

		$head = Head::all();
		$footer = Footer::all();		
	
		$noticias = Noticia::query()->where('id', $id)->get();

		$adwords = Adword::all();

		return $this->render('vernoticia.twig', [
			'head' => $head,
			'adwords' => $adwords,
			'noticias' => $noticias,
			'footer' => $footer
		]);
	}
	public function postVernoticia($id){
		
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

		header('Location:' . BASE_URL . 'noticias');
	}
}