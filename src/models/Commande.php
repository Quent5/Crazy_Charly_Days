<?php

namespace custombox\models;

class Commande extends \Illuminate\Database\Eloquent\Model{


    protected $table = 'commande';
    protected $primaryKey = 'id' ;
    public $timestamps = false;



    function produit(){
        return $this->belongsToMany('gamepedia\models\Game', 'commande2produit', 'id_commande', 'id_produit');
    }


    function boite(){
        return $this->belongTo('custombox\models\Boite', 'id');
    }

}