<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Carousel;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;

class CarouselController extends BaseController{
	public function getIndex(){
		
		$carousel = Carousel::all();

		return $this->render('admin/carousel.twig', ['carousel' => $carousel]);

	}
	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('section', 'required');
		$validator->add('title', 'required');
		$validator->add('subtitle', 'required');
		$validator->add('button', 'required');

		$upload = new UploadHandler('images/carousel/');
		$folder = 'images/carousel/';
		$carouselImg = $upload->process($_FILES['carousel']);

		if($validator->validate($_POST)){
			$carousel = new Carousel();
			$carousel->section = $_POST['section'];
			$carousel->title = $_POST['title'];
			$carousel->subtitle = $_POST['subtitle'];
			$carousel->button = $_POST['button'];

			if($carouselImg->isValid()){
				$carousel->carousel = $folder.$carouselImg->name;
				$carousel->save();
				$carouselImg->confirm();
			}

			$carousel->save();
		}

		header('Location:' . BASE_URL . 'admin/carousel');
	}
	public function getCarouseledit($postid){
		$carousel = Carousel::query()->where('id', $postid)->get();

		return $this->render('admin/carouseledit.twig', [
			'carousel' => $carousel
		]);
	}
	public function postCarouseledit($postid){

		$carousels = Carousel::find($postid);

		$validator = new Validator();
		$validator->add('section', 'required');
		$validator->add('title', 'required');
		$validator->add('subtitle', 'required');
		$validator->add('button', 'required');

		$upload = new UploadHandler('images/carousel/');
		$folder = 'images/carousel/';
		$carouselImg = $upload->process($_FILES['carousel']);

		$carousels = Carousel::find($postid);

		if($validator->validate($_POST)){
				$carousels->carousel = $_POST['carousel'];
				$carousels->title = $_POST['title'];
				$carousels->subtitle = $_POST['subtitle'];
				$carousels->button = $_POST['button'];

				if($carouselImg->isValid()){
					$carousels->carousel = $folder.$carouselImg->name;
					$carousels->save();
					$carouselImg->confirm();
				}else{
				$carousels->carousel = $folder.'carousel_default.png';
			}	
		}

		$carousels->save();

		header('Location:' . BASE_URL . 'admin/carousel');
	}
	public function getDelete($postid){

		$carousel = Carousel::find($postid);
		$carousel->delete();
		header('Location:' . BASE_URL . 'admin/carousel');
	}
}