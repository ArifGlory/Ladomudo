<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Http\Requests\PembelianRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\DetailPembelian;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Produk;
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
use function foo\func;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('back.pembelian.index');
    }

    /*
     * Sumber data untuk datatable
     * pada Manajemen Pengguna
     * */
    public function data(Request $request)
    {
                $role = Auth::user()->jenis_user;
                $data = Pembelian::select('pembelian.*')
                    ->orderBy('id_pembelian', 'DESC')
                    ->get();

                return Datatables::of($data)
                    ->editColumn('total_harga', function($item){
                        $total_harga = "Rp. ". number_format($item->total_harga,0,',','.');

                        return $total_harga;
                    })
                    ->editColumn('created_at', function($item){
                        $tanggal_trans = \Carbon\Carbon::parse($item->created_at)->format('d M Y');

                        return $tanggal_trans;
                    })
                    ->addColumn('_action', function ($item) {/*
                         /*
                         * L = Lihat => $lihat
                         * C = Cetak => $cetak
                         * E = Edit => $edit
                         * H = Hapus => $hapus
                         * R = Restore = $restore
                         * M = Modal Dialog*/
                        $role = Auth::user()->jenis_user;
                        $lihat = route('pembelian.show', $item->id_pembelian);
                        $button = 'L';
                        return view('datatable._action_button', compact('item', 'button', 'lihat'));

                    })
                    ->escapeColumns([])
                    ->addIndexColumn()
                    ->make(true);
    }


    public function create()
    {
        //
        $produk = Produk::all();

        return view('back.pembelian.create',compact('produk'));
    }

    public function store(PembelianRequest $request)
    {
        //
        $request->validated();
        $requestData = $request->all();

        $total_harga = 0;
        $produks = explode(",",$requestData['list_produk']);
        $jumlah_pembelian = explode(",",$requestData['list_jumlah']);

        for ($i = 0; $i < count($produks); $i++){
            $produk = Produk::where('id_produk',$produks[$i])
                ->first();
            $subtotal = $produk->harga_beli * $jumlah_pembelian[$i];
            $total_harga += $subtotal;
        }

        $save_trans = Pembelian::create([
            'total_harga' => $total_harga
        ]);
        if ($save_trans){
            $id_pembelian = $save_trans->id_pembelian;

            //simpan detail pembelian
            for ($i = 0; $i < count($produks); $i++){
                $produk = Produk::where('id_produk',$produks[$i])
                    ->first();
                $subtotal = $produk->harga_beli * $jumlah_pembelian[$i];

                $save_dt_pembelian = DetailPembelian::create([
                    'id_pembelian' => $id_pembelian,
                    'id_produk' => $produk->id_produk,
                    'jumlah_beli' => $jumlah_pembelian[$i]
                ]);
            }

            return redirect(route('pembelian.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Simpan Data Pembelian Berhasil !',
                    'judul' => 'Data Pembelian'
                ]);
        }else{
            Redirect::back()->with('pesan_status', [
                'tipe' => 'danger',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        //
        $requestData = $request->all();
        $data = Transaksi::findOrFail($id);

        $update = $data->update($requestData);

        if ($update) {
            return redirect(route('pembelian.index'))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Berhasil diupdate',
                    'judul' => 'Data pembelian'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'error',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }

    }

    public function show($id){
        $data = Transaksi::select('pembelian.*','users.name','users.alamat','users.phone')
            ->join('users','users.id','=','pembelian.id_user')
            ->orderBy('id_pembelian', 'DESC')
            ->first();

        $detail_trans = DetailTransaksi::join('produk','produk.id_produk','=','detail_pembelian.id_produk')
            ->where('id_pembelian',$data->id_transaksi)
            ->get();

        return view('back.transaksi.show', compact('data','detail_trans'));
    }

    public function cetakLaporan(Request $request){
        $data = Transaksi::select('transaksi.*','users.name','users.alamat','users.phone')
            ->join('users','users.id','=','transaksi.id_user')
            ->orderBy('id_transaksi', 'DESC')
            ->get();

        return view('back.transaksi.report_transaksi', compact('data'));
    }


    public function edit($id){

    }

    public function destroy($id)
    {
        //

    }

   
}
