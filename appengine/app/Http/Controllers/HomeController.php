<?php

namespace App\Http\Controllers;

use App\Fungsional;
use App\Models\Cuti;
use App\Models\Dokumen;
use App\Models\Iklan;
use App\Models\Infografis;
use App\Models\Jabatan;
use App\Models\Jadwal;
use App\Models\JadwalAktivitas;
use App\Models\JenisSk;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Produk;
use App\Models\Santri;
use App\Models\Setting;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

    }


    public function dashboard(Request $request){

        $role = Auth::user()->jenis_user;
        if ($role == "admin"){

            $jml_supplier = Supplier::count();
            $jml_produk = Produk::count();

            $produk = Produk::limit(5)
                ->get();

            return view('back.dashboard',compact('jml_produk','jml_supplier','produk'));

        }else{
            return redirect(route('login'));
        }

    }

    public function home(Request $request){

        $kategori = Kategori::all();
        $produk = Produk::limit(3)
            ->get();

        return view('front.app',compact('kategori','produk'));
    }



}
