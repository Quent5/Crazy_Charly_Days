<?php

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $table = 'compte';
    protected $primaryKey = 'id';
    public $timestamps = false;
}