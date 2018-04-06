<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Album;
use Sirius\Validation\Validator;
use Sirius\Upload\Handler as UploadHandler;
use Sirius\Upload\HandlerAggregate as UploadHandlerAggregate;

class AlbumController extends BaseController{
	public function getIndex(){
		
		$album = Album::all();

		return $this->render('admin/album.twig', ['album' => $album]);

	}
	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('title', 'required');
		$validator->add('year', 'required');
		$validator->add('production', 'required');
		$validator->add('description', 'required');
		$validator->add('spotify', 'required');
		$validator->add('paypal', 'required');
		$validator->add('amazon', 'required');
		$validator->add('apple', 'required');

		$upload = new UploadHandler('images/albums/');
		
		
		$folder = 'images/albums/';
		$uploadAggregate = new UploadHandlerAggregate();

		$uploadAggregate->addHandler('album', $upload);
		$uploadAggregate->addHandler('bgalbum', $upload);

		$result = $uploadAggregate->process($_FILES);

		if($validator->validate($_POST)){
			
			$album = new Album();

			$album->title = $_POST['title'];
			$album->year = $_POST['year'];
			$album->production = $_POST['production'];
			$album->description = $_POST['description'];
			$album->spotify = $_POST['spotify'];
			$album->paypal = $_POST['paypal'];
			$album->amazon = $_POST['amazon'];
			$album->apple = $_POST['apple'];

			if($result->isValid()){
				$album->album_img = $folder.$result['album']->name;
				$album->bg_album = $folder.$result['bgalbum']->name;
				$album->save();
				$result->confirm();
			}

			$album->save();

		}

		header('Location:' . BASE_URL . 'admin/album');
	}
	public function getAlbumedit($postid){
		$album = Album::query()->where('id', $postid)->get();

		return $this->render('admin/albumedit.twig', [
			'album' => $album
		]);
	}
	public function postAlbumedit($postid){

		$album = Album::find($postid);

		$validator = new Validator();
		$validator->add('title', 'required');
		$validator->add('year', 'required');
		$validator->add('production', 'required');
		$validator->add('description', 'required');
		$validator->add('spotify', 'required');
		$validator->add('paypal', 'required');
		$validator->add('amazon', 'required');
		$validator->add('apple', 'required');


		$upload = new UploadHandler('images/albums/');
		$folder = 'images/albums/';
		$uploadAggregate = new UploadHandlerAggregate();

		$uploadAggregate->addHandler('album', $upload);
		$uploadAggregate->addHandler('bgalbum', $upload);

		$result = $uploadAggregate->process($_FILES);

		$album = Album::find($postid);

		if($validator->validate($_POST)){
				$album->title = $_POST['title'];
				$album->year = $_POST['year'];
				$album->production = $_POST['production'];
				$album->description = $_POST['description'];
				$album->spotify = $_POST['spotify'];
				$album->paypal = $_POST['paypal'];
				$album->amazon = $_POST['amazon'];
				$album->apple = $_POST['apple'];

				if($result->isValid()){
					$album->album_img = $folder.$result['album']->name;
					$album->bg_album = $folder.$result['bgalbum']->name;
					$album->save();
					$result->confirm();
				}
				$album->save();
		}

		header('Location:' . BASE_URL . 'admin/album');

	}
	public function getDelete($postid){

		$album = Album::find($postid);
		$album->delete();
		header('Location:' . BASE_URL . 'admin/album');
	}
}