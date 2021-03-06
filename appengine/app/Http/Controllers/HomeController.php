<?php

namespace App\Http\Controllers;

use App\Fungsional;
use App\Http\Requests\UserRequest;
use App\Models\Cuti;
use App\Models\DetailTransaksi;
use App\Models\Dokumen;
use App\Models\Iklan;
use App\Models\Infografis;
use App\Models\Jabatan;
use App\Models\Jadwal;
use App\Models\JadwalAktivitas;
use App\Models\JenisSk;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Ongkir;
use App\Models\OrangTua;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Produk;
use App\Models\Santri;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\UlasanRating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
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

    public function daftar(){
        return view('auth.register');
    }

    public function storeUser(UserRequest $request){
        $request->validated();

       // $request_data = $request->all();

        $store = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
            'password' => $request->input('password')
        ]);

        if ($store) {
            return redirect(route('login'))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Berhasil mendaftar akun',
                    'judul' => 'Anda dapat melakukan login'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'danger',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }
    }

    public function dashboard(Request $request){

        $role = Auth::user()->jenis_user;
        if ($role == "admin"){

            $jml_supplier = Supplier::count();
            $jml_produk = Produk::count();
            $jml_konsumen = User::where('jenis_user',"user")
                ->count();

            $produk = Produk::limit(5)
                ->get();

            return view('back.dashboard',compact('jml_produk','jml_supplier','produk','jml_konsumen'));

        }else{
            return redirect(route('login'));
        }

    }

    public function home(Request $request){

        $kategori = Kategori::all();
        $produk = Produk::limit(3)
            ->get();

        return view('front.home',compact('kategori','produk'));
    }

    public function tentangKami(Request $request){
        return view('front.tentang');
    }

    public function userAccount(Request $request){
        $data = User::where('id',Auth::user()->id)
            ->first();

        return view('front.akun',compact('data'));
    }

    public function editProfile(){
        $data = User::where('id',Auth::user()->id)
            ->first();

        return view('front.editakun',compact('data'));
    }

    public function updateProfile(Request $request){
        $requestData = $request->all();
        unset($requestData['_token']);

        $user = User::where('id',Auth::user()->id)
            ->first();
        $user->update($requestData);

        return redirect()->route('akun-saya');
    }

    public function transaksi(Request $request){
        $transaksi = Transaksi::where('id_user',Auth::user()->id)
            ->orderBy('created_at',"DESC")
            ->get();

        return view('front.transaksi',compact('transaksi'));
    }

    public function buktiBayar($id_transaksi){
        return view('front.buktibayar',compact('id_transaksi'));
    }

    public function buktiBayarStore(Request $request){

        $requestData = $request->all();
        $id_transaksi = $request->input('id_transaksi');
        $data = Transaksi::findOrFail($id_transaksi);
        $photo = "";

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $photo = round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
            $image->move('img/bukti_bayar/', $photo);
        }
        $requestData['bukti_bayar'] = $photo;
        unset($requestData['id_transaksi']);

        $update = $data->update($requestData);

        if ($update) {
            return redirect(route('detail-transaksi',$id_transaksi))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Berhasil diupdate',
                    'judul' => 'Data Bukti Bayar'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'error',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }


    }

    public function detailTransaksi($id_transaksi){
        $detail_trans = DetailTransaksi::join('produk','produk.id_produk','=','detail_transaksi.id_produk')
            ->where('id_transaksi',$id_transaksi)
            ->get();
        $transaksi = Transaksi::where('id_transaksi',$id_transaksi)
            ->first();

        return view('front.detailtransaksi',compact('transaksi','detail_trans'));
    }

    public  function produk(Request $request){

        $keyword = $request->get('keyword');

        if ($keyword != null || $keyword != "") {
            $produk = Produk::whereRaw('LOWER(nama_produk) LIKE ? ', [trim(strtolower($keyword)) . '%'])
            ->paginate(10);
            $count_produk = Produk::whereRaw('LOWER(nama_produk) LIKE ? ', [trim(strtolower($keyword)) . '%'])
                ->count();

        }else{
            $produk = Produk::paginate(10);
            $count_produk = Produk::count();
        }


        $kategori = Kategori::all();


        return view('front.produk',compact('produk','count_produk','kategori'));
    }

    public function produkDetail($id){
        $data = Produk::select('*')
            ->join('supplier','supplier.id_supplier','=','produk.id_supplier')
            ->join('kategori','kategori.id_kategori','=','produk.id_kategori')
            ->where('produk.id_produk',$id)
            ->first();

        $ulasan = UlasanRating::select('*')
            ->join('users','users.id','=','ulasan_rating.id_user')
            ->where('ulasan_rating.id_produk',$id)
            ->get();


        $rating = 0;
        foreach ($ulasan as $val){
            $rating = $rating + $val->rating;
        }
        if (count($ulasan) > 0){
            $rating = $rating / count($ulasan);
        }

        $potongan = ($data->diskon/100) * $data->harga;
        $harga_setelah_diskon = $data->harga - $potongan;

        return view('front.detailproduk',compact('data','harga_setelah_diskon','ulasan','rating'));
    }

    public  function addUlasan($id_produk){

        $data = Produk::select('*')
            ->where('produk.id_produk',$id_produk)
            ->first();

        return view('front.addulasan',compact('data'));
    }

    public function storeUlasan(Request $request){

        $requestData = $request->all();
        $id_produk = $request->input('id_produk');

        $save = UlasanRating::create([
            'id_produk' => $request->input('id_produk'),
            'id_user' => Auth::user()->id,
            'ulasan' => $request->input('ulasan'),
            'rating' => $request->input('rating')
        ]);


        if ($save) {
            return redirect(route('shop-detail',$id_produk))
                ->with('pesan_status', [
                    'tipe' => 'info',
                    'desc' => 'Data Ulasan Ditambahkan',
                    'judul' => 'Ulasan berhasil'
                ]);
        } else {
            Redirect::back()->with('pesan_status', [
                'tipe' => 'error',
                'desc' => 'Server Error',
                'judul' => 'Terdapat kesalahan pada server.'
            ]);
        }


    }



}
