<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = "agents_au";

    protected $fillable = ['Agency_Name','Agent_Firstname','Agent_Surname','Agent_Contact','publication_name','publication_date','state'];

    public $timestamps = false;
}
