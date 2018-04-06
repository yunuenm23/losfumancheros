<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model{
	
	protected $table = 'noticias';
	protected $fillable = ['title','tweet','date','description','video','thumb'];
}