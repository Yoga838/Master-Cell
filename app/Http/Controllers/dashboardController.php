<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){
        $jumlah_pengguna = User::where('role', 'pegawai') 
        -> count();
        $jumlah_barang = barangModel::count();
        $data = DB::table('transaction as trx')
        ->join('barang as b', 'b.id', '=', 'trx.barang_model_id')
        ->selectRaw('SUM(trx.quantity * b.Harga_jual) as total_penjualan, DATE_FORMAT(trx.created_at, "%Y-%m") as created_month')
        ->groupBy('created_month')
        ->orderBy('created_month', 'desc')
        ->get();

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data->transform(function ($item) use ($months) {
            $yearMonth = explode('-', $item->created_month);
            $year = $yearMonth[0];
            $month = $months[$yearMonth[1]];

            $item->created_month = "{$month} {$year}";
            return $item;
        });

        return view('dashboard',compact('jumlah_pengguna','jumlah_barang','data'));
    }
}
