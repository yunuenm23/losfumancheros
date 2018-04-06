<?php
namespace App\Controllers\Admin;

use App\Models\User;
use App\Controllers\BaseController;

class IndexController extends BaseController{
	public function getIndex(){
		
		if(isset($_SESSION['userid'])){
			$userid = $_SESSION['userid'];
			$user = User::find($userid);

			if($user){
				return $this->render('admin/index.twig', ['user' => $user]);
			}
		}		
		return $this->render('admin/index.twig');
	}
}