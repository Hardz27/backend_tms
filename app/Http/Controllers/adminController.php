<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\DB;


use App\M_User;
use App\T_kategori_soal;
use PDF;

class adminController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // //

    public function test(Request $request)
    {
        dd($request);
    }

    public function register(Request $request){
        $data = new M_User();
        $data->nm_jobseeker = $request->input('name');
        $data->email_jobseeker = $request->input('email');
        $data->password_jobseeker = $request->input('password');
        $data->alamat_jobseeker = $request->input('address');
        $data->no_hp_jobseeker = $request->input('phone');
        $data->tgl_lahir_jobseeker = $request->input('born_date');
        $data->jk_jobseeker = $request->input('gender');
        $data->save();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'data disimpan',
                'data' => $data
            ], 200);
          } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak disimpan',
                'data' => ''
            ], 404);
          }
    }

    public function login(Request $request){
        $data = M_User::where('email_jobseeker',$request->email)->where('password_jobseeker',$request->password)->first();
        // dd($data);

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function uploadCV(Request $request){
      // $request->file('cv')->getClientOriginalName()
      // getRealPath()
      // getClientOriginalExtension()
      // dd($request->file('cv')->move('public', 'coba.pdf'));

        $id_cv = DB::table('cv_jobseeker')->insertGetId(
                  array('file_cv_jobseeker' => $request->input('name').'.pdf')
                );

        $request->file('cv')->move('tms.test/public', $request->input('name').'.pdf');

        $data = M_User::where('id_jobseeker', $request->input('idUser'))->first();
        $data->id_cv_jobseeker = $id_cv;
        $data->save();
        // dd($data);

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function skillCategory(Request $request){
      
        $kategori = T_kategori_soal::orderBy('tag_soal')->get();
        // dd("ouyy");


        $data_jobseeker = M_User::where('id_jobseeker', $request->input('idUser'))->first();

        // $ujian = DB::table('kompetensi')->where('id_jobseeker',$id_jobseeker)->get();

        foreach ($kategori as $key) {
            $ujian = DB::table('kompetensi')
                    ->where('id_jobseeker',$data_jobseeker->id_jobseeker)
                    ->where('id_kategori_soal',$key->id_kategori_soal)
                    ->first();

            if ($ujian) {
                $data[] = [
                    'nama' => $key->tag_soal,
                    'idSkill' => $key->id_kategori_soal,
                    'skor' => $ujian->skor
                ];
            }else{
                $data[] = [
                    'nama' => $key->tag_soal,
                    'idSkill' => $key->id_kategori_soal,
                    'skor' => 'null'
                ];
            }

        }


        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function soal(Request $request){

        $soals = DB::table('soal')
                ->join('kategori_soal', 'soal.id_kategori_soal','=','kategori_soal.id_kategori_soal')
                ->where('soal.id_kategori_soal', $request->input('idSkill'))->get();

        foreach ($soals as $soal) {
            $jawabans = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();
            $jawaban_soal = array();
            foreach ($jawabans as $jawaban) {
                $jawaban_soal[] = [
                    'id_jawaban' => $jawaban->id_jawaban,
                    'nama' => $jawaban->jawaban
                ];
            }

            $soal_col[] = [
                'id_soal' => $soal->id_soal,
                'pertanyaan' => $soal->soal,
                'jawaban' => $jawaban_soal
            ];            
        }

        $data[] = [
                'skill' => $soals[0]->tag_soal,
                'soal' => $soal_col
            ];

        // dd($data);
      

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function submit(Request $request){

        $soals = DB::table('soal')
                ->join('kunci_jawaban', 'soal.id_soal','=','kunci_jawaban.id_soal')
                ->join('kategori_soal', 'soal.id_kategori_soal','=','kategori_soal.id_kategori_soal')
                ->select('soal.*', 'kategori_soal.tag_soal' ,'kunci_jawaban.jawaban_id_jawaban')
                ->where('soal.id_kategori_soal', $request->input('idSkill'))->get();

        $jawaban = $request->input('jawaban');

        $salah = 0;
        $benar = 0;
        $i = 0;

        foreach ($soals as $iterate) {

            if ($i > sizeof($jawaban)-1) {
                $salah++;
            }else{
                $soal = DB::table('soal')
                    ->join('kunci_jawaban', 'soal.id_soal','=','kunci_jawaban.id_soal')
                    ->select('soal.*', 'kunci_jawaban.jawaban_id_jawaban')
                    ->where('soal.id_soal', $jawaban[$i]['id_soal'])->first();

                if ($soal->jawaban_id_jawaban == $jawaban[$i]['id_jawaban']) {
                    $benar++;
                }else{
                    $salah++;
                }
            }

            $i++;
        }

        $nilai = ($benar/sizeof($soals)) * 100;
        $nilai = number_format($nilai,2);

        $data = [
            'skor' => $nilai,
            'skill' => $soals[0]->tag_soal
        ];

        // dd($benar, $salah);

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function seen(Request $request){

        $penyaluran = DB::table('penyaluran')
                            ->join('perusahaan', 'penyaluran.id_perusahaan','=','perusahaan.id_perusahaan')
                            ->join('loker', 'penyaluran.id_loker','=','loker.id_loker')
                            ->where('penyaluran.id_jobseeker', $request->input('idUser'))
                            ->get();

        foreach ($penyaluran as $key) {
            $data[] = [
                'namaPerusahaan' => $key->nm_perusahaan,
                'alamat' => $key->alamat_perusahaan,
                'loker' => $key->judul_loker. ' - ' .$key->deskripsi_loker
            ];
        }

        // dd($penyaluran);
        

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }

    public function hired(Request $request){

        $data_jobseeker = DB::table('jobseeker')
                        ->join('perusahaan','jobseeker.id_perusahaan','=','perusahaan.id_perusahaan')
                        ->where('jobseeker.id_jobseeker', $request->input('idUser'))
                        ->select('perusahaan.nm_perusahaan','perusahaan.alamat_perusahaan','perusahaan.no_hp_perusahaan')
                        ->first();

        $data = [
            'namaPerusahaan' => $data_jobseeker->nm_perusahaan,
            'alamat' => $data_jobseeker->alamat_perusahaan,
            'contact' => $data_jobseeker->no_hp_perusahaan,
            'suratPenerimaan' => 'dummy dulu'
        ];
        

        if ($data) {
          return response()->json([
              'success' => true,
              'message' => 'data ditemukan',
              'data' => $data
          ], 200);
        } else {
          return response()->json([
              'success' => false,
              'message' => 'data tidak ditemukan',
              'data' => ''
          ], 404);
        }
    }



    public function downloadPDF() {
        $show = DB::table('jobseeker')->get();
        $pdf = PDF::loadView('pdf', compact('show'));
        
        return $pdf->download('pdf.pdf');
    }

}
