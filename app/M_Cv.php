<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Cv extends Model
{

    public $timestamps = false;

    protected $table = 'cv_jobseeker';
    protected $primaryKey = 'id_cv_jobseeker';
    protected $fillable = ['id_cv_jobseeker','file_cv_jobseeker'];

     public function user()
    {
        return $this->belongsTo('App\M_User');
    }

}