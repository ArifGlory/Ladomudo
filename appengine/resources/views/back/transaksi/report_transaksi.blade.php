<!DOCTYPE html>
<html lang="en" xmlns:background-color="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Laporan Transaksi</title>
    {{--<script>
        (function() {
            // fungsi untuk menampilkan gambar berupa svg
            // let svg = ;
            let blob = new Blob([{{ $trans_anjab->gambar_kedudukan }}], {type: 'image/svg+xml'});
            let url = URL.createObjectURL(blob);
            let image = document.createElement('img');
            image.src = url;
            image.addEventListener('load', () => URL.revokeObjectURL(url), {once: true});
            // document.body.appendChild(image);
            document.getElementById("gambarKedudukan").appendChild(image);
            window.print();
        })();
    </script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // your code goes here
            window.print();
        }, false);
    </script>
    <style type="text/css" media="all">
        hr {
            -moz-border-bottom-colors: none;
            -moz-border-image: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: #EEEEEE -moz-use-text-color #FFFFFF;
            border-style: solid none;
            border-width: 1px 0;
            margin: 18px 0;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        'margin: 0 auto;
        }
        .borderless{
            border:0px;
        }
        .spacer{
            display: block;
            padding-top: 10px;
            padding-bottom:10px
        }
        .border1{
            border:3px solid #000;
            padding: 3px;
        }
        .border1 td{
            border:1px solid #000;
            padding: 3px;
        }
        .border1 th{
            border:1px solid #000;
            padding: 3px;
        }
        .tebal2{
            font-weight: bold;
        }
        #tebal{
            border:1px solid #000;
            padding: 3px;
            font-weight: normal;
            text-align: center;
        }
        #garis{
            width: 40%;
            border: 1px solid #000000;
        }
        .text-left{
            text-align: left;
        }

        @media print {
            tr.kepala-tabel {
                background-color: #b0bec5 !important;
                -webkit-print-color-adjust: exact;
            }
            html, body {
                width: 210mm;
                height: 330mm;
            }
            header,footer {
                display: none;
            }
        }
        @page{
            /* margin: 0;
             padding-top: 5cm;*/
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-right: 2cm;
            margin-left: 2cm;
        }

    </style>
    <style type="text/css" media="all">
        .under { text-decoration: underline;
            color: #000000;
        }
        .over  { text-decoration: overline; }
        .line  { text-decoration: line-through; }
        .blink { text-decoration: blink; }
        .all   { text-decoration: underline overline line-through; }
        a      { text-decoration: none; }
    </style>
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="text-center">
                <img height="100px" src="{{ asset('front-end/images/logo.png')}}" alt="Logo {{ getSettingData('web_name')->value ?? env('APP_NAME') }}">
            </p>
        </div>
        <div class="col-md-9 text-center">
            <h2 class="font-weight-bold">Gudang Hortikultura Ladomudo</h2>
            <p class="mb-2">Bandar Lampung, Kode Pos 35152</p>
            {{--<p>Telp : 089228282 E-mail : ladomudo@gmail.com</p>--}}
        </div>
        <div class="bb-1 mt-1 w-100"></div>
        <div class="bb-3 mt-2 w-100"></div>
        <hr>
    </div>
    <div class="row mt-6">
        <div class="col-md-12">
            <div class="text-center">
                <h2>Daftar Transaksi</h2>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <td>No.</td>
                            <td>Nama Pelanggan</td>
                            <td>Telepon</td>
                            <td>Jumlah Bayar</td>
                            <td>Tanggal</td>
                            <td>Status Transaksi</td>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                        $total_semua = 0;
                    @endphp
                    <tbody>
                        @foreach($data as $val)
                            @php
                                $total_semua = $total_semua + $val->total_harga;
                            @endphp
                            <tr>
                                <td>{{$no++}}</td>
                                <td align="left">{{$val->name}}</td>
                                <td>{{$val->phone}}</td>
                                <td>Rp. {{number_format($val->total_harga,0,',','.')}}</td>
                                <td>{{\Carbon\Carbon::parse($val->created_at)->format('d M Y')}}</td>
                                <td>{{$val->status_transaksi}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="margin_30_40">Total Semua Transaksi  : Rp. {{number_format($total_semua,0,',','.')}}</h4>
        </div>
    </div>
</div>


</body>
</html>