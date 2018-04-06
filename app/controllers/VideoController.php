<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Video;
use App\Models\Adword;
use App\Models\Newsletter;
use Sirius\Validation\Validator;
use App\Models\Footer;

class VideoController extends BaseController{
	public function getVideo($id){		

		$head = Head::all();
		$footer = Footer::all();
	
		$videos = Video::query()->orderBy('created_at','asc')->get();

		$adwords = Adword::all();

		return $this->render('video.twig', [
			'head' => $head,
			'adwords' => $adwords,
			'videos' => $videos,
			'footer' => $footer
		]);
	}
	public function postVideo($id){
		
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