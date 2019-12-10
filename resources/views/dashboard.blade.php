@extends('template/main')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-6">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    </div>
    <div class="row col-6 justify-content-end">
        {{-- <a href="{{asset('Printer/printDashboard')}}" target="blank"><i class="fas fa-print fa-2x"></i></a> --}}
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover col-lg-12 table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="width:5%">#</th>
                <th scope="col" class="text-center" style="width:20%">Tipe</th>
                <th scope="col" class="text-center" style="width:20%">Akun</th>
                <th scope="col" class="text-center" style="width:20%">Saldo</th>
            </tr>
        </thead>
        <tbody>

            <!-- start cetak aset -->
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">ASET</td>
                <td>1111 - Kas</td>
                <td class="text-right">{{number_format($json['kas'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>1112 - Bank BNI</td>
                <td class="text-right">{{number_format($json['bni'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>1113 - Bank BCA</td>
                <td class="text-right">{{number_format($json['bca'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>1114 - Lain-lain</td>
                <td class="text-right">{{number_format($json['asetLain'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>1115 - Bank DBS</td>
                <td class="text-right">{{number_format($json['dbs'],0,",",".")}}</td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>JUMLAH</td>
                <td class="text-right">{{number_format($json['totalAset'],0,",",".")}}</td>
            </tr>
            <!-- end cetak aset -->

            <!-- start cetak pemasukan -->
            <tr>
                <td class="text-center">2</td>
                <td class="text-center">PEMASUKAN</td>
                <td>2111 - Hasil Usaha</td>
                <td class="text-right">{{number_format($json['usaha'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>2112 - Gaji</td>
                <td class="text-right">{{number_format($json['gaji'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>2113 - Uang Saku</td>
                <td class="text-right">{{number_format($json['saku'],0,",",".")}}</td>

            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td>2114 - Lain-lain</td>
                <td class="text-right">{{number_format($json['akunLain'],0,",",".")}}</td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>JUMLAH</td>
                <td class="text-right">{{number_format($json['totalAkun'],0,",",".")}}</td>
            </tr>
            <!-- end cetak pemasukan -->
        </tbody>
    </table>

</div>

<form action="{{url('/pemasukan')}}" method="POST" id="form-to-pemasukan">                
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="temp" value="{{$temp}}">
</form>


@endsection