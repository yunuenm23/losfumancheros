<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model{
	
	protected $table = 'albums';
	protected $fillable = ['title','year','production','description','album_img','bg_album','spotify','paypal','amazon','apple'];
}