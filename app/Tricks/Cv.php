<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
   Protected  $fillable = array('id','cv_title','cv_summary','cv_attachment');

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cv';
}
