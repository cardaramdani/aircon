<?php

namespace App\Http\Controllers;
use App\Models\Pricelist;
use Validator;
use DataTables;

use Illuminate\Http\Request;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    if($request->ajax()){
        // Membuat query builder untuk Pricelist
        $query = Pricelist::query();

        // Jika request from_date ada value (datanya) maka
        if(!empty($request->from_date))
        {
            // Jika tanggal awal (from_date) hingga tanggal akhir (to_date) adalah sama maka
            if($request->from_date === $request->to_date){
                // Kita filter tanggalnya sesuai dengan request from_date
                $query->whereDate('created_at', '=', $request->from_date);
            } else {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                $menitawal = "00:00:00";
                $menitakhir = "23:59:59";
                $awalkaping = $from_date . ' ' . $menitawal;
                $tungtungkaping = $to_date . ' ' . $menitakhir;
                // Kita filter dari tanggal awal ke akhir
                $query->whereBetween('created_at', [$awalkaping, $tungtungkaping]);
            }
        }

        // Mengurutkan data berdasarkan created_at secara descending
        $query->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit </a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    return view('pricelist.index');
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
        // return response()->json(['success' => $request->all()]);

        $id = $request->id;
        $rules = array(
            'tipe'    =>  'required',
            'kapasitas'    =>  'required',
            'deskripsi'    =>  'required',
            'list_pekerjaan'    =>  'required',
            'harga'    =>  'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'tipe'    =>  $request->tipe,
            'kapasitas'    =>  $request->kapasitas,
            'deskripsi'    =>  $request->deskripsi,
            'list_pekerjaan'    =>  $request->list_pekerjaan,
            'harga'    =>  $request->harga,

        );

        $data = Pricelist::updateOrCreate(['id' => $id], $data);
        return response()->json(['success' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // // $where = array('id' => $request);
        // $post  = Pricelist::where('tipe', $pricelist);
        // return response()->json($post, 200);
    }
    public function kapasitas(Request $request) {

        $data = Pricelist::where('tipe', $request->jenisac)

                        ->get();
        echo json_encode($data);
        // return response()->json(['success' => $data]);
    }

    public function item(Request $request) {

        $data = Pricelist::where('tipe', $request->jenisac)
                        ->where('kapasitas', $request->kapasitas)
                        ->get();
        echo json_encode($data);
        // return response()->json(['success' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Pricelist::where($where)->first();
        // $data = $post->users->name;
        return response()->json($post, 200);
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
        $data = Pricelist::findOrFail($id);
        $data->delete();
        return response()->json(['success' => "Berhasil Dihapus"]);

    }
}
