<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Http\Requests\KeranjangRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //
        $keranjang = Keranjang::select('keranjang.*','produk.nama_produk','produk.foto_produk','produk.harga')
            ->join('users','keranjang.id_user','=','users.id')
            ->join('produk','keranjang.id_produk','=','produk.id_produk')
            ->where('keranjang.id_user',Auth::user()->id)
            ->get();

        return view('front.keranjang',compact('keranjang'));
    }

    /*
     * Sumber data untuk datatable
     * pada Manajemen Pengguna
     * */
    public function data(Request $request)
    {
                $role = Auth::user()->jenis_user;
                $data = Keranjang::select('keranjang.*','produk.nama_produk')
                    ->join('users','keranjang.id_user','=','users.id')
                    ->join('produk','keranjang.id_produk','=','produk.id_produk')
                    ->orderBy('id_keranjang', 'DESC')
                    ->get();

              return $data;
    }


    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        //
        $role = Auth::user()->jenis_user;

        $save = Keranjang::create([
            'id_produk' => $request->input('id_produk'),
            'id_user' => Auth::user()->id,
            'jumlah_beli' => $request->input('jumlah_beli')
        ]);
        if ($save) {
            return redirect(route('keranjang.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menambahkan ke keranjang',
                    'judul' => 'Data keranjang'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'danger',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }
    }

    public function checkout(Request $request){
        $keranjang = Keranjang::select('keranjang.*','produk.nama_produk','produk.foto_produk','produk.harga','produk.id_produk')
            ->join('users','keranjang.id_user','=','users.id')
            ->join('produk','keranjang.id_produk','=','produk.id_produk')
            ->where('keranjang.id_user',Auth::user()->id)
            ->get();



        if (count($keranjang) > 0){
            $total_semua = 0;
            foreach ($keranjang as $val){
                $subtotal = $val->jumlah_beli * $val->harga;
                $total_semua = $total_semua + $subtotal;
            }

            $save_trans = Transaksi::create([
                'id_user' => Auth::user()->id,
                'total_harga' => $total_semua
            ]);
            if ($save_trans){
                $id_transaksi = $save_trans->id_transaksi;

                foreach ($keranjang as $value){

                    $save_dt_trans = DetailTransaksi::create([
                        'id_user' => Auth::user()->id,
                        'id_transaksi' => $id_transaksi,
                        'id_produk' => $value->id_produk,
                        'jumlah_beli' => $value->jumlah_beli,
                    ]);

                    //hapus dari cart
                    $info = Keranjang::find($value->id_keranjang);
                    $delete = $info->forceDelete();
                }

                return redirect(route('keranjang.index'))
                    ->with('pesan_status',[
                        'tipe' => 'info',
                        'desc' => 'Checkout Berhasil ! , Jangan lupa mengirim bukti bayar anda',
                        'judul' => 'Data checkout'
                    ]);

            }else{
                Redirect::back()->with('pesan_status', [
                    'tipe' => 'danger',
                    'desc' => 'Server Error',
                    'judul' => 'Terdapat kesalahan pada server.'
                ]);
            }
        }else{
            return redirect(route('keranjang.index'))
                ->with('pesan_status',[
                    'tipe' => 'danger',
                    'desc' => 'Checkout gagal,Harus isi keranjang anda',
                    'judul' => 'Keranjang Kosong !'
                ]);
        }

    }

    public function update(Request $request, $id)
    {
        //

    }

    public function show($id){
       //
    }


    public function edit($id){
       //
    }

    public function destroy($id)
    {
        //

        $info = Keranjang::find($id);
        $delete = $info->forceDelete();

        $response = [];
        if ($delete) {
            return redirect(route('keranjang.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menghapus dari keranjang',
                    'judul' => 'Data keranjang'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'danger',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }
    }

    public function hapus($id)
    {
        //

        $info = Keranjang::find($id);
        $delete = $info->forceDelete();

        if ($delete) {
            return redirect(route('keranjang.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menghapus dari keranjang',
                    'judul' => 'Data keranjang'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'danger',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }
    }

   
}
