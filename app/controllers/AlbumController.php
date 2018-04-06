<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Album;
use App\Models\Newsletter;
use Sirius\Validation\Validator;
use App\Models\Footer;


class AlbumController extends BaseController{
	public function getAlbum($id){

		$head = Head::all();
		$footer = Footer::all();		
	
		$album = Album::query()->where('id', $id)->get();

		return $this->render('album.twig', [
			'head' => $head,
			'album' => $album,
			'footer' => $footer
		]);
	}
	public function postAlbum(){
		
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

		header('Location:' . BASE_URL . '');
	}
}