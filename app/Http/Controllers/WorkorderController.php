<?php

namespace App\Http\Controllers;
use App\Models\Workorder;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            // Membuat query builder untuk Workorder
            $query = Workorder::query();

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

        return view('wo.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
