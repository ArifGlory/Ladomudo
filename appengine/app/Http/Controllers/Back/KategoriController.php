<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\KategoriRequest;
use App\Imports\SantriDataImport;
// use App\Models\PangkatGolongan;
use App\Models\Kategori;
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

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('back.kategori.index');
    }

    /*
     * Sumber data untuk datatable
     * pada Manajemen Pengguna
     * */
    public function data(Request $request)
    {
                $role = Auth::user()->jenis_user;
                $data = Kategori::select('*')
                    ->orderBy('id_kategori', 'DESC')
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
                        $lihat = route('kategori.show', $item->id_kategori);
                        $edit = route('kategori.edit', $item->id_kategori);
                        $hapus = route('kategori.destroy', $item->id_kategori);
                        $button = 'LEHRM';
                        return view('datatable._action_button', compact('item', 'button', 'lihat','edit', 'hapus'));

                    })
                    ->escapeColumns([])
                    ->addIndexColumn()
                    ->make(true);
    }


    public function create()
    {
        //

        return view('back.kategori.create');
    }

    public function store(KategoriRequest $request)
    {
        //
        $request->validated();
        $role = Auth::user()->jenis_user;

        $save = Kategori::create([
            'nama_kategori' => $request->input('nama_kategori'),
            'deskripsi_kategori' => $request->input('deskripsi_kategori')
        ]);
        if ($save) {
            return redirect(route('kategori.index'))
                ->with('pesan_status',[
                    'tipe' => 'info',
                    'desc' => 'Berhasil menambahkan kategori',
                    'judul' => 'Data kategori'
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
        $data = Kategori::select('*')
            ->where('id_kategori',$id)
            ->first();

        return view('back.kategori.show', compact('data'));
    }


    public function edit($id){
        $data = Kategori::select('*')
            ->where('id_kategori',$id)
            ->first();

        return view('back.kategori.edit', compact('data'));
    }

    public function destroy($id)
    {
        //

        $info = Kategori::withTrashed()->find($id);
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
