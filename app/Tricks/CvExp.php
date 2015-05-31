<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class CvExp extends Model
{
   Protected  $fillable = array('id','from_date','to_date','exp_type','title','desc','tag_id');

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cv_exp';
}
