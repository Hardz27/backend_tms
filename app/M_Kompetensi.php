<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Kompetensi extends Model
{

    protected $table = 'kompetensi';

    protected $fillable =[
        'id_kompetensi', 'id_jobseeker', 'id_kategori_soal', 'skor', 'id_kebutuhan_skill'
    ];


    protected $primaryKey = 'id_kompetensi';

    public $timestamps = false;


}
