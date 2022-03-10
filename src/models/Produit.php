<?php

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model {
	protected $table = 'produit';
	protected $primaryKey = 'id';
	public $timestamps = false;

    function commande(){
        return $this->BelongTo('custombox\models\Commande', 'id');
    }

	function categorie(){
        return $this->belongTo('custombox\models\Categorie', 'id');
    }


}