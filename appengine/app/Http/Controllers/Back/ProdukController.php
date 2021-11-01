<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Http\Requests\ProdukRequest;
use App\Http\Requests\SupplierRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
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

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('back.produk.index');
    }

    /*
     * Sumber data untuk datatable
     * pada Manajemen Pengguna
     * */
    public function data(Request $request)
    {
                $role = Auth::user()->jenis_user;
                $data = Produk::select('*')
                    ->join('supplier','supplier.id_supplier','=','produk.id_supplier')
                    ->join('kategori','kategori.id_kategori','=','produk.id_kategori')
                    ->orderBy('id_produk', 'DESC')
                    ->get();

                return Datatables::of($data)
                    ->addColumn('harga', function ($item) {

                        $harga =  "Rp. ".number_format($item->harga,0,',','.');
                        return $harga;

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
                        $lihat = route('produk.show', $item->id_produk);
                        $edit = route('produk.edit', $item->id_produk);
                        $hapus = route('produk.destroy', $item->id_produk);
                        $button = 'LEHRM';
                        return view('datatable._action_button', compact('item', 'button','lihat','edit', 'hapus'));

                    })
                    ->escapeColumns([])
                    ->addIndexColumn()
                    ->make(true);
    }

    public function dataDashboard(Request $request)
    {
        $role = Auth::user()->jenis_user;
        $data = Produk::select('*')
            ->join('supplier','supplier.id_supplier','=','produk.id_supplier')
            ->join('kategori','kategori.id_kategori','=','produk.id_kategori')
            ->orderBy('id_produk', 'DESC')
            ->limit(5)
            ->get();

        return Datatables::of($data)
            ->addColumn('harga', function ($item) {

                $harga =  "Rp. ".number_format($item->harga,0,',','.');
                return $harga;

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
                $lihat = route('produk.show', $item->id_produk);
                $edit = route('produk.edit', $item->id_produk);
                $hapus = route('produk.destroy', $item->id_produk);
                $button = 'LEHRM';
                return view('datatable._action_button', compact('item', 'button','lihat','edit', 'hapus'));

            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }


    public function create()
    {
        //

        $supplier = Supplier::all();
        $kategori = Kategori::all();

        return view('back.produk.create',compact('supplier','kategori'));
    }

    public function store(ProdukRequest $request)
    {
        //
        $request->validated();
        $role = Auth::user()->jenis_user;

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $photo = round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
            $image->move('img/produk/', $photo);
        }

        $save = Produk::create([
            'id_supplier' => $request->input('id_supplier'),
            'id_kategori' => $request->input('id_kategori'),
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi_produk' => $request->input('deskripsi_produk'),
            'cara_penyimpanan' => $request->input('cara_penyimpanan'),
            'foto_produk' => $photo
        ]);
        if ($save) {
            return redirect(route('produk.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menambahkan produk',
                    'judul' => 'Data produk'
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

        $data = Produk::findOrFail($id);
        $update = $data->update($requestData);

        if ($update) {
            return redirect(route('produk.index'))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Berhasil diupdate',
                    'judul' => 'Data produk'
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
        $data = Produk::select('*')
            ->join('supplier','supplier.id_supplier','=','produk.id_supplier')
            ->join('kategori','kategori.id_kategori','=','produk.id_kategori')
            ->where('produk.id_produk',$id)
            ->first();

        return view('back.produk.show', compact('data'));
    }


    public function edit($id){
        $data = Produk::select('*')
            ->join('supplier','supplier.id_supplier','=','produk.id_supplier')
            ->join('kategori','kategori.id_kategori','=','produk.id_kategori')
            ->where('produk.id_produk',$id)
            ->first();
        $supplier = Supplier::all();
        $kategori = Kategori::all();

        return view('back.produk.edit', compact('data','kategori','supplier'));
    }

    public function destroy($id)
    {
        //

        $info = Produk::withTrashed()->find($id);
        if ($info->trashed()) {
            $delete = $info->forceDelete();
        } else {
            $delete = $info->destroy($id);
        }

        $response = [];
        if($delete) {
            return Respon('', true, 'Berhasil menghapus data', 200);

        } else {
            return Respon('', false, 'Gagal menghapus data', 200);
        }
    }

   
}
