<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DataTables;

use App\Income;
use App\Outcomes;
use App\A_accounts;
use App\O_accounts;
use App\I_accounts;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'PEMASUKAN';
        $data['incomes'] = Income::all();
        $data['i_accounts'] = DB::table('i_accounts')->get();
        $data['a_accounts'] = DB::table('a_accounts')->get();
        return view('pemasukan', $data);
    }

    public function dt_json(){
        // return datatables()->of(Income::all())
        // ->addIndexColumn()->make(true);
        $data = DB::table('v_incomes')->get();            
        return datatables()->of($data)
        ->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request = $request->data;
        $id = $request->id;
        if($id == ''){
            $tanggal = explode('/',$request->tanggal);
            $tanggal = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' '.date('H:i:s');
            $income = new Income;
            $income->date = $tanggal;
            $income->assets = $request->terimaDari;
            $income->i_accounts = $request->simpanKe;
            $income->total = $request->jumlah;
            $income->info = $request->keterangan;
    
            $res = $income->save();
            // $res = Income::create($request->all());
            if($res == true){
                $response = ['msg' => 'Berhasil', 'info' => 'Berhasil Menambah Data', 'icon' => 'success'];
            } else {
                $response = ['msg' => 'Gagal', 'info' => 'Gagal Menambah Data', 'icon' => 'error'];
            }
        } else {
            $tanggal = explode('/',$request->tanggal);
            $tanggal = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' '.date('H:i:s');
            $res = Income::where('id', $id)->update([                
                'date' => $tanggal,
                'assets' => $request->terimaDari,
                'i_accounts' => $request->simpanKe,
                'total' => $request->jumlah,
                'info' => $request->keterangan,
            ]);
            if($res == true){
                $response = ['msg' => 'Berhasil', 'info' => 'Berhasil Mengubah Data', 'icon' => 'success'];
            } else {
                $response = ['msg' => 'Gagal', 'info' => 'Gagal Mengubah Data', 'icon' => 'error'];
            }
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Income::findOrFail($id);
        $data = DB::table('v_incomes')->where('id','=',$id)->get()->toArray()[0];            
        return json_encode($data);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $res = Income::where('id','=', $id)->delete();
        // dd($res);
        if($res == true){
            $response = ['msg' => 'Berhasil', 'info' => 'Berhasil Menghapus Data', 'icon' => 'success', 'status' => 1];
        } else {
            $response = ['msg' => 'Gagal', 'info' => 'Gagal Menghapus Data', 'icon' => 'error', 'status' => 0];
        }
        return $response;
    }
}
