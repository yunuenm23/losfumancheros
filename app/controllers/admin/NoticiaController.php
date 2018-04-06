<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Noticia;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;

class NoticiaController extends BaseController{
	public function getIndex(){
		
		$noticia = Noticia::query()->orderBy('date','desc')->get();

		return $this->render('admin/noticias.twig', ['noticia' => $noticia]);

	}

	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('title', 'required');
		$validator->add('tweet', 'required');
		$validator->add('date', 'required');
		$validator->add('description', 'required');
		$validator->add('video', 'required');


		$upload = new UploadHandler('images/noticias/');
		$upload->addRule('size', 'size=2M');
		$upload->addRule('imagewidth', 'min=576&max=800');
		$upload->addRule('imageheight', 'min=420&max=600');
		$folder = 'images/noticias/';
		$logo = $upload->process($_FILES['image']);

		if($validator->validate($_POST)){

			$noticia = new Noticia();

			$noticia->title = $_POST['title'];
			$noticia->tweet = $_POST['tweet'];
			$noticia->date = $_POST['date'];
			$noticia->description = $_POST['description'];
			$noticia->video = $_POST['video'];

			if($logo->isValid()){
				$noticia->thumb = $folder.$logo->name;
				$noticia->save();
				$logo->confirm();
			}

			$noticia->save();
		}

		header('Location:' . BASE_URL . 'admin/noticias');
	}

	public function getEditarnoticias($postid){
		$noticia = Noticia::query()->where('id', $postid)->get();

		return $this->render('admin/editarnoticias.twig', [
			'noticia' => $noticia
		]);
	}

	public function postEditarnoticias($postid){

		$noticia = Noticia::find($postid);

		$validator = new Validator();

		$validator->add('title', 'required');
		$validator->add('tweet', 'required');
		$validator->add('date', 'required');
		$validator->add('description', 'required');
		$validator->add('video', 'required');

		$upload = new UploadHandler('images/noticias/');
		$folder = 'images/noticias/';
		$logo = $upload->process($_FILES['image']);

		$noticia = 	Noticia::find($postid);

		if($validator->validate($_POST)){

				$noticia->title = $_POST['title'];
				$noticia->tweet = $_POST['tweet'];
				$noticia->date = $_POST['date'];
				$noticia->description = $_POST['description'];
				$noticia->video = $_POST['video'];

				if($logo->isValid()){
					$noticia->thumb = $folder.$logo->name;
					$noticia->save();
					$logo->confirm();
				}
				$noticia->save();
		}					

		header('Location:' . BASE_URL . 'admin/noticias');
	}

	public function getDelete($postid){

		$noticia = Noticia::find($postid);
		$noticia->delete();
		header('Location:' . BASE_URL . 'admin/noticias');
	}

}