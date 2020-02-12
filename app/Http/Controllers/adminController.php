<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\DB;


use App\M_User;

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

        $request->file('cv')->move('public', $request->input('name').'.pdf');

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

    // public function barang(){
    //     $data = M_Barang::all();

    //     if ($data) {
    //       return response()->json([
    //           'success' => true,
    //           'message' => 'data ditemukan',
    //           'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak ditemukan',
    //           'data' => ''
    //       ], 404);
    //     }
    // }

    // public function addbarang(Request $request){
    //     $data = new M_Barang();
    //     $data->kode_barang = $request->input('kode_barang');
    //     $data->jenis_barang = $request->input('jenis_barang');
    //     $data->icon = $request->input('icon');
    //     $data->save();

    //     if ($data) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'data disimpan',
    //             'data' => $data
    //         ], 200);
    //       } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'data tidak disimpan',
    //             'data' => ''
    //         ], 404);
    //       }
    // }

    // public function updatebarang(Request $request, $id){
    //     $data = M_Barang::where('id_barang', $id)->first();
    //     $data->kode_barang = $request->input('kode_barang');
    //     $data->jenis_barang = $request->input('jenis_barang');
    //     $data->icon = $request->input('icon');
    //     $data->save();

    //     if ($data) {
    //       return response()->json([
    //         'success' => true,
    //         'message' => 'data diupdate',
    //         'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //         'success' => false,
    //         'message' => 'data tidak diupdate',
    //         'data' => ''
    //       ], 404);
    //     }
    // }

    // public function deletebarang(Request $request, $id){
    //     $data = M_Barang::where('id_barang', $id)->first();
    //     $data->delete();
    //     if ($data) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'data dihapus',
    //             'data' => $data
    //         ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak dihapus',
    //           'data' => ''
    //       ], 404);
    //     }
    // }

    // public function addestimasi(Request $request){
    //     $data = new M_Estimasi();
    //     $data->kode_barang = $request->input('kode_barang');
    //     $data->est_kerusakan = $request->input('est_kerusakan');
    //     $data->harga = $request->input('harga');
    //     $data->jenis_barang = $request->input('jenis_barang');
    //     $data->save();

    //     if ($data) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'data disimpan',
    //             'data' => $data
    //         ], 200);
    //       } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'data tidak disimpan',
    //             'data' => ''
    //         ], 404);
    //       }
    // }

    // public function updateestimasi(Request $request, $id){
    //     $data = M_Estimasi::where('id_estimasi', $id)->first();
    //     $data->kode_barang = $request->input('kode_barang');
    //     $data->est_kerusakan = $request->input('est_kerusakan');
    //     $data->harga = $request->input('harga');
    //     $data->jenis_barang = $request->input('jenis_barang');
    //     $data->save();

    //     if ($data) {
    //       return response()->json([
    //         'success' => true,
    //         'message' => 'data diupdate',
    //         'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //         'success' => false,
    //         'message' => 'data tidak diupdate',
    //         'data' => ''
    //       ], 404);
    //     }
    // }

    // public function deleteestimasi(Request $request, $id){
    //     $data = M_Estimasi::where('id_estimasi', $id)->first();
    //     $data->delete();
    //     if ($data) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'data dihapus',
    //             'data' => $data
    //         ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak dihapus',
    //           'data' => ''
    //       ], 404);
    //     }
    // }
    
    // public function estimasi(){
    //     $data = M_Estimasi::all();

    //     if ($data) {
    //       return response()->json([
    //           'success' => true,
    //           'message' => 'data ditemukan',
    //           'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak ditemukan',
    //           'data' => ''
    //       ], 404);
    //     }
    // }

    // public function tipeestimasi($kode_barang){
    //     $data = M_Estimasi::where('kode_barang', $kode_barang)->get();

    //     if ($data) {
    //       return response()->json([
    //           'success' => true,
    //           'message' => 'data ditemukan',
    //           'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak ditemukan',
    //           'data' => ''
    //       ], 404);
    //     }
    // }

    // public function daftarteknisi(Request $request){
    //     $data = new M_Teknisi();
    //     $data->t_nama = $request->input('t_nama');
    //     $data->t_email = $request->input('t_email');
    //     $data->t_alamat = $request->input('t_alamat');
    //     $data->t_hp = $request->input('t_hp');
    //     $data->t_keahlian = $request->input('t_keahlian');
    //     $data->t_ktp = $request->input('t_ktp');
    //     $data->t_selfi = $request->input('t_selfi');
    //     $data->save();

    //     if ($data) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'data disimpan',
    //             'data' => $data
    //         ], 200);
    //       } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'data tidak disimpan',
    //             'data' => ''
    //         ], 404);
    //       }
    // }

    // public function teknisi(){
    //   $data = M_Teknisi::all();

    //     if ($data) {
    //       return response()->json([
    //           'success' => true,
    //           'message' => 'data ditemukan',
    //           'data' => $data
    //       ], 200);
    //     } else {
    //       return response()->json([
    //           'success' => false,
    //           'message' => 'data tidak ditemukan',
    //           'data' => ''
    //       ], 404);
    //     }
    // }

}
