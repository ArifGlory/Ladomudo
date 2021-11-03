<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\Kategori;
use App\Models\Keranjang;
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
        $keranjang = Keranjang::select('keranjang.*','produk.nama_produk')
            ->join('user','keranjang.id_user','=','user.id')
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
                    ->join('user','keranjang.id_user','=','user.id')
                    ->join('produk','keranjang.id_produk','=','produk.id_produk')
                    ->orderBy('id_keranjang', 'DESC')
                    ->get();

              return $data;
    }


    public function create()
    {
        //

    }

    public function store(KategoriRequest $request)
    {
        //
        $request->validated();
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

    public function update(Request $request, $id)
    {
        //

        $requestData = $request->all();

        $data = Kategori::findOrFail($id);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $photo = round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
            $image->move('img/kategori/', $photo);
        }

        $requestData['foto_kategori'] = $photo;
        $update = $data->update($requestData);

        if ($update) {
            return redirect(route('kategori.index'))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Berhasil diupdate',
                    'judul' => 'Data kategori'
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
       //
    }


    public function edit($id){
       //
    }

    public function destroy($id)
    {
        //

        $info = Keranjang::find($id);
        $delete = $info->destroy($id);

        $response = [];
        if($delete) {
            return Respon('', true, 'Berhasil menghapus data', 200);

        } else {
            return Respon('', false, 'Gagal menghapus data', 200);
        }
    }

   
}
