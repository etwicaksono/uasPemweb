<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // mendefinisikan data dummy
        $dummy = $this->dummy();

        // menghitung total dengan menggunakan function cheker()
        $data['json'] = $this->checker($dummy);

        // memberi nilai variabel temp
        $data['temp'] = json_encode($dummy);

        // memberi nilai variabel title
        $data['title'] = "Dashboard";
        return view('dashboard', $data);
    }

    public function pemasukan()
    {
        // mendefinisikan data dummy
        $dummy = $this->dummy();

        // mengubah data dummy menjadi json
        $data['temp'] = json_encode($dummy);

        // membuat variabel untuk title
        $data['title'] = "PEMASUKAN";

        // membuat data untuk ditampilkan
        $data['json'] = $dummy;

        // memanggil view
        return view('pemasukan', $data);
    }

    public function tambahPemasukan()
    {
        // mengekstrak hasil input
        extract($_POST);

        // mendecode inputan json sebagai penyimpan data
        $temp = json_decode($temp);

        // perkondisian untuk mengecek apakah ada tambahan data
        if (isset($tanggal)) {
            // membuat variabel sementara untuk menampung hasil input
            $newTemp = [
                'tanggal'   => $tanggal,
                'aset'      => $simpanKe,
                'akun'      => $terimaDari,
                'jumlah'    => $jumlah,
                'keterangan' => $keterangan
            ];
            // menambahkan hasil input ke penyimpanan
            array_push($temp, $newTemp);
        }

        // memasukan hasil penyimpanan baru ke variabel yang akan dikirim ke view
        $data['temp'] = json_encode($temp);

        // mengubah objek ke array untuk di tampilkan di view
        foreach ($temp as $key => $val) {
            $data['json'][$key] = (array) $temp[$key];
        }

        // membuat variabel untuk title
        $data['title'] = "PEMASUKAN";

        // memanggil view
        return view('pemasukan', $data);
    }

    private function checker($data)
    {
        // mendefinisikan variabel untuk menyimpan nilai
        $kas = 0;
        $bni = 0;
        $bca = 0;
        $asetLain = 0;
        $totalAset = 0;
        $dbs = 0;
        $usaha = 0;
        $gaji = 0;
        $saku = 0;
        $akunLain = 0;
        $totalAkun = 0;

        foreach ($data as $row) {
            // menghitung akun
            if ($row['akun'] == "2111 - Hasil Usaha") $usaha += $row['jumlah'];
            if ($row['akun'] == "2112 - Gaji") $gaji += $row['jumlah'];
            if ($row['akun'] == "2113 - Uang Saku") $saku += $row['jumlah'];
            if ($row['akun'] == "2114 - Lain-lain") $akunLain += $row['jumlah'];
            $totalAkun += $row['jumlah'];
            // menghitung aset
            if ($row['aset'] == "1111 - Kas") $kas += $row['jumlah'];
            if ($row['aset'] == "1112 - Bank BNI") $bni += $row['jumlah'];
            if ($row['aset'] == "1113 - Bank BCA") $bca += $row['jumlah'];
            if ($row['aset'] == "1114 - Lain-lain") $asetLain += $row['jumlah'];
            if ($row['aset'] == "1115 - Bank DBS") $dbs += $row['jumlah'];
            $totalAset += $row['jumlah'];
        }

        $data = [
            'usaha' => $usaha,
            'gaji' => $gaji,
            'saku' => $saku,
            'akunLain' => $akunLain,
            'kas' => $kas,
            'bni' => $bni,
            'bca' => $bca,
            'asetLain' => $asetLain,
            'dbs' => $dbs,
            'totalAset' => $totalAset,
            'totalAkun' => $totalAkun
        ];
        return $data;
    }

    public function dummy()
    {
        // mendefinisikan data dummy
        $dummy = [
            [
                'tanggal'   => date('d / m / Y', time()),
                'aset'      => "1112 - Bank BNI",
                'akun'      => "2112 - Gaji",
                'jumlah'    => 1000000,
                'keterangan' => "Pemasukan Dummy"
            ],
            [
                'tanggal'   => date('d / m / Y', time()),
                'aset'      => "1111 - Kas",
                'akun'      => "2111 - Hasil Usaha",
                'jumlah'    => 3000000,
                'keterangan' => "Pemasukan Dummy 2"
            ]
        ];

        return $dummy;
    }

    public function postDashboard()
    {
        // mengekstrak hasil input
        extract($_POST);

        // mengembalikan dari json ke objek
        $result = json_decode($temp);

        // mengubah dari objek ke array
        foreach ($result as $key => $val) {
            $result2[$key] = (array) $result[$key];
        }

        // menghitung total dengan menggunakan function cheker()
        $data['json'] = $this->checker($result2);

        // membuat variabel temp
        $data['temp'] = $temp;

        // membuat variabel title
        $data['title'] = "Dashboard";

        // menampilkan data pada view
        return view('dashboard', $data);
    }
}