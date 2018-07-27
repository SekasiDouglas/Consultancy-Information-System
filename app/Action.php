<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $appends = ["open"];
    
    public function getOpenAttribute(){
        return true;
    }
}