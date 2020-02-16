<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_User extends Model
{

    public $timestamps = false;

    protected $table = 'jobseeker';
    protected $primaryKey = 'id_jobseeker';
    protected $fillable = ['id_jobseeker','nm_jobseeker','email_jobseeker','password_jobseeker','tgl_lahir_jobseeker','jk_jobseeker','alamat_jobseeker','no_hp_jobseeker','id_cv_jobseeker','images','id_perusahaan'];

     public function phone()
    {
        return $this->hasOne('App\M_Cv');
    }

}