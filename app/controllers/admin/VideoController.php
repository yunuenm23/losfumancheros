<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Video;
use Sirius\Validation\Validator;

class VideoController extends BaseController{
	public function getIndex(){
		
		$video = Video::query()->orderBy('created_at','desc')->get();

		return $this->render('admin/videonuevo.twig', ['video' => $video]);

	}

	public function postIndex(){ 

		$validator = new Validator();
		$validator->add('titulo', 'required');
		$validator->add('codigo', 'required');
		$validator->add('info', 'required');

		if($validator->validate($_POST)){

			$video = new Video();

			$video->title = $_POST['titulo'];
			$video->codigo = $_POST['codigo'];
			$video->informacion = $_POST['info'];

			$video->save();
		}

		header('Location:' . BASE_URL . 'admin/videonuevo');
	}

	public function getEditarvideo($postid){
		$video = Video::query()->where('id', $postid)->get();

		return $this->render('admin/editarvideo.twig', [
			'video' => $video
		]);
	}

	public function postEditarvideo($postid){

		$video = Video::find($postid);

		$validator = new Validator();

		$validator->add('titulo', 'required');
		$validator->add('codigo', 'required');
		$validator->add('info', 'required');

		$video = 	Video::find($postid);

		if($validator->validate($_POST)){

				$video->title = $_POST['titulo'];
				$video->codigo = $_POST['codigo'];
				$video->informacion = $_POST['info'];

				$video->save();
		}					

		header('Location:' . BASE_URL . 'admin/videonuevo');
	}

	public function getDelete($postid){

		$video = Video::find($postid);
		$video->delete();
		header('Location:' . BASE_URL . 'admin/videonuevo');
	}

}