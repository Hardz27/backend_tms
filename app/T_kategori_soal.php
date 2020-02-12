<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_kategori_soal extends Model
{

    protected $table = 'kategori_soal';

    protected $fillable =[
        'id_kategori_soal',  'tag_soal',
        'created_at','updated_at','updated_by'
    ];


    protected $primaryKey = 'id_kategori_soal';

    public $timestamps = true;


}
