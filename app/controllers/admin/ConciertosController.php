<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Concierto;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;

class ConciertosController extends BaseController{
	public function getIndex(){
		
		$shows = Concierto::all();

		return $this->render('admin/shows.twig', ['shows' => $shows]);

	}
	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('title', 'required');
		$validator->add('date', 'required');
		$validator->add('time', 'required');
		$validator->add('tickets_url', 'required');
		$validator->add('show_url', 'required');
		$validator->add('city', 'required');

		$upload = new UploadHandler('images/shows/');
		$folder = 'images/shows/';
		$show_img = $upload->process($_FILES['show_img']);

		if($validator->validate($_POST)){
			
			$show = new Concierto();
			$show->title = $_POST['title'];
			$show->date = $_POST['date'];
			$show->time = $_POST['time'];
			$show->tickets_url = $_POST['tickets_url'];
			$show->show_url = $_POST['show_url'];
			$show->city = $_POST['city'];

			if($show_img->isValid()){
				$show->show_img = $folder.$show_img->name;
				$show->save();
				$show_img->confirm();
			}else{
				$show->show_img = $folder.'show_default.jpg';
			}

			$show->save();
		}

		header('Location:' . BASE_URL . 'admin/shows');
	}
	public function getShowsedit($postid){
		$shows = Concierto::query()->where('id', $postid)->get();

		return $this->render('admin/showsedit.twig', [
			'shows' => $shows
		]);
	}
	public function postShowsedit($postid){

		$show = Concierto::find($postid);

		$validator = new Validator();
		$validator->add('title', 'required');
		$validator->add('date', 'required');
		$validator->add('time', 'required');
		$validator->add('tickets_url', 'required');
		$validator->add('show_url', 'required');
		$validator->add('city', 'required');

		$upload = new UploadHandler('images/shows/');
		$folder = 'images/shows/';
		$showImg = $upload->process($_FILES['show_img']);

		$show = Concierto::find($postid);

		if($validator->validate($_POST)){

				$show->title = $_POST['title'];
				$show->date = $_POST['date'];
				$show->time = $_POST['time'];
				$show->tickets_url = $_POST['tickets_url'];
				$show->show_url = $_POST['show_url'];
				$show->city = $_POST['city'];

				if($showImg->isValid()){
					$show->show_img = $folder.$showImg->name;
					$show->save();
					$showImg->confirm();
				}else{
				$show->show_img = $folder.'show_default.jpg';
			}
			$show->save();
		}

		header('Location:' . BASE_URL . 'admin/shows');

	}
	public function getDelete($postid){

		$show = Concierto::find($postid);
		$show->delete();
		header('Location:' . BASE_URL . 'admin/shows');
	}
}