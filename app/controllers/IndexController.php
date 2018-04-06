<?php
namespace App\Controllers;

use App\Models\Head;
use App\Models\Carousel;
use App\Models\Bio;
use App\Models\Album;
use App\Models\Concierto;
use App\Models\Noticia;
use App\Models\Video;
use App\Models\Partner;
use App\Models\Newsletter;
use App\Models\Footer;

use Sirius\Validation\Validator;

class IndexController extends BaseController{
	public function getIndex(){

		$head = Head::all();
		
		$maincarousel = Carousel::query()->where('section',1)->get();
		$carousel = Carousel::query()->where('section',2)->get();

		$bio = Bio::all();

		$album = Album::all();

		$shows = Concierto::all();

		$noticias = Noticia::query()->orderBy('date','desc')->limit(3)->get();

		$videos = Video::all();

		$partner = Partner::all();

		$footer = Footer::all();

		return $this->render('index.twig', [
			'head' => $head,
			'maincarousel' => $maincarousel,
			'carousel' => $carousel,
			'bio' => $bio,
			'album' => $album,
			'shows' => $shows,
			'noticias' => $noticias,
			'videos' => $videos,
			'partner' => $partner,
			'footer' => $footer
		]);
	}

	public function postIndex(){
		
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