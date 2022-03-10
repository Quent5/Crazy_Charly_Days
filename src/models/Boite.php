<?php
declare(strict_types=1);

namespace custombox\models;

class Boite extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'boite';
    protected $primaryKey = 'id' ;


    function commande(){
        return $this->hasMany ('custombox\models\Commande', 'id');
    }
}



