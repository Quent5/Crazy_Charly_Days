<?php

namespace custombox\models;

class Categorie extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'categorie';
    protected $primaryKey = 'id' ;

    function produit(){
        return $this->hasMany('custombox\models\Produit', 'id');
    }

}