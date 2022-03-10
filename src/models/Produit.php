<?php

namespace custombox\models;

use Illuminate\Database\Eloquent\Models;

class Produit extends Models {
	protected $table = 'produit';
	protected $primaryKey = 'id';
	public $timestamps = false;
}