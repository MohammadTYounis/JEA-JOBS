<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
   Protected  $fillable = array('id','user_id','trick_id','created_at','updated_at');

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'votes';
}
