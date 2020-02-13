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
            'suratPenerimaan' => 'localhost:8000/pdf/'.$data_jobseeker->id_jobseeker
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



    public function downloadPDF($id) {

        $jobseeker = DB::table('jobseeker')->join('perusahaan','jobseeker.id_perusahaan','=','perusahaan.id_perusahaan')
                        ->where('jobseeker.id_jobseeker',$id)
                        ->first();

        // dd($jobseeker);

        PDF::SetCreator('PDF_CREATOR');
        PDF::SetAuthor('Nicola Asuni');
        PDF::SetTitle('TCPDF Example 006');
        PDF::SetSubject('TCPDF Tutorial');
        PDF::SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            PDF::setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        PDF::SetFont('dejavusans', '', 10);

        // add a page
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // Print a table

        // add a page
        PDF::AddPage();

        // <img src="images/Untitled.png" width="64" height="64" />

        $textcolors = '
        <font face="times"><span style="font-size: xx-large;">Talent Management Systems</span></font>
        <br><br>
        <hr />';
        PDF::writeHTML($textcolors, true, false, true, false, '');

        PDF::Image('images/Untitled.png', 180, 20, 16, '', '', '', '', false, 300);


        // create some HTML content

        $html = '
        <div style="text-align:center">
            <font face="times"><span style="font-size: xx-large;">'.$jobseeker->nm_perusahaan.'</span></font>
            <br><br>
            <font face="times">'.$jobseeker->alamat_perusahaan.'</font>
        </div>

        <p style="text-align:right"> Indramayu,'.date('d-M-Y').'</p>
        <font face="times" size="12">
            Kode : '.$jobseeker->nm_jobseeker.'/'.$jobseeker->id_perusahaan.'/'.date('d-m-Y').'<br>
            Lampiran : - <br>
            Perihal : Pemberitahuan Penerimaan Pekerjaan<br><br>

            Yth. Bapak/Ibu/Saudara
            <dd>di '.$jobseeker->alamat_jobseeker.'</dd>
            <br>
            <br>
            Dengan Hormat,<br>
            Kami mengucapkan terima kasih atas kepercayaan Saudara kepada Perusahan Penyaluran Pekerjaan kami. Kami telah menerima dan mengirimkan surat lamaran pekerjaan yang Saudara kirimkan pada web kami, dan sekarang telah ada perusahaan yang menginginkan anda untuk bergabung dengan mereka<br><br>

            Untuk itu, kami mengundang Saudara untuk mengikuti wawancara internal sistem kami yang akan diselenggarakan pada<br>
            <dd>
            Hari        : '.date('D', strtotime(date('d-M-Y').' +3 day')).', '.date('d-M-Y', strtotime(date('d-M-Y').' +3 day')).'<br>
            Tempat   : Gedung TI Lt. 2, Polindra, Indramayu<br>
            Waktu     : Pukul 09.00 WIB – selesai</dd><br><br>

            Dengan Ketentuan
            <dd>
            -Membawa berkas Data Diri lengkap beserta CV<br>
            -Memakai Pakaian Formal, Rapih<br>
            </dd><br>
            Atas perhatian Saudari, kami mengucapkan terima kasih.
        <br>
        <br>
        </font>
        <div style="text-align:right">
            <font face="times">
                <span style="font-size: x-large;">Hormat kami,</span>
                <br>
                HRD Perusahaan
                <br><br><br><br>
                '.$jobseeker->nm_hrd_perusahaan.'
            </font>
        </div>






        ';

        // output the HTML content
        PDF::writeHTML($html, true, false, true, false, '');

        // Print some HTML Cells

        
        // reset pointer to the last page
        PDF::lastPage();

        //Close and output PDF document
        PDF::Output('example_006.pdf', 'I');
        
          
    }

}
