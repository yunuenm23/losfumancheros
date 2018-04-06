<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concierto extends Model{
	
	protected $table = 'shows';
	protected $fillable = ['title','date','time','tickets_url','show_img','show_url','city'];
}