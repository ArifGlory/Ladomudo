<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Http\Requests\SupplierRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\Kategori;
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

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('back.supplier.index');
    }

    /*
     * Sumber data untuk datatable
     * pada Manajemen Pengguna
     * */
    public function data(Request $request)
    {
                $role = Auth::user()->jenis_user;
                $data = Supplier::select('*')
                    ->orderBy('id_supplier', 'DESC')
                    ->get();

                return Datatables::of($data)
                    ->addColumn('_action', function ($item) {/*
                         /*
                         * L = Lihat => $lihat
                         * C = Cetak => $cetak
                         * E = Edit => $edit
                         * H = Hapus => $hapus
                         * R = Restore = $restore
                         * M = Modal Dialog*/
                        $role = Auth::user()->jenis_user;
                        //$lihat = route('supplier.show', $item->id_supplier);
                        $edit = route('supplier.edit', $item->id_supplier);
                        $hapus = route('supplier.destroy', $item->id_supplier);
                        $button = 'EHRM';
                        return view('datatable._action_button', compact('item', 'button','edit', 'hapus'));

                    })
                    ->escapeColumns([])
                    ->addIndexColumn()
                    ->make(true);
    }


    public function create()
    {
        //

        return view('back.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        //
        $request->validated();
        $role = Auth::user()->jenis_user;

        $save = Supplier::create([
            'nama_supplier' => $request->input('nama_supplier'),
            'alamat_supplier' => $request->input('alamat_supplier'),
            'phone_supplier' => $request->input('phone_supplier')
        ]);
        if ($save) {
            return redirect(route('supplier.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menambahkan supplier',
                    'judul' => 'Data supplier'
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

        $data = Supplier::findOrFail($id);
        $update = $data->update($requestData);

        if ($update) {
            return redirect(route('supplier.index'))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Berhasil diupdate',
                    'judul' => 'Data Supplier'
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
        $data = Kategori::select('*')
            ->where('id_kategori',$id)
            ->first();

        return view('back.kategori.show', compact('data'));
    }


    public function edit($id){
        $data = Supplier::select('*')
            ->where('id_supplier',$id)
            ->first();

        return view('back.supplier.edit', compact('data'));
    }

    public function destroy($id)
    {
        //

        $info = Supplier::withTrashed()->find($id);
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
