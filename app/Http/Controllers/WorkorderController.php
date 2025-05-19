<?php

namespace App\Http\Controllers;
use App\Models\Workorder;
use App\Models\Pricelist;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getWorkordersData($request);
        }
        return view('wo.index');
    }

    private function getWorkordersData(Request $request)
    {
        $query = Workorder::query()
            ->select(['id', 'name', 'email', 'phone', 'address', 'service_items', 'created_at', 'user_id','scheduled_at','complaint','status'])
            ->when($request->filled(['from_date', 'to_date']), function($q) use ($request) {
                if($request->from_date === $request->to_date) {
                    return $q->whereDate('created_at', $request->from_date);
                }

                return $q->whereBetween('created_at', [
                    "{$request->from_date} 00:00:00",
                    "{$request->to_date} 23:59:59"
                ]);
            })
            ->latest();

        return DataTables::of($query)
            ->addColumn('action', function($data) {
                $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'"
                             class="edit btn btn-info btn-sm edit-post">
                             <i class="far fa-edit"></i> Edit
                          </a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'"
                                   class="delete btn btn-danger btn-sm">
                                   <i class="far fa-trash-alt"></i>
                           </button>';
                return $button;
            })
            ->editColumn('service_items', function($data) {
                // Format service items untuk tampilan
                return collect($data->service_items)->map(function($item) {
                    return "{$item['deskripsi']} ({$item['kapasitas']}) x {$item['qty']}";
                })->implode('<br>');
            })
            ->rawColumns(['action', 'service_items'])
            ->make(true);
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
        // return response()->json(['success' => $request->deskripsi]);
        $id = $request->id;
        $rules =array(
            'customername'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'deskripsi'=>'required',
            // 'service_items' => 'required|array',
            // 'service_items.*.id' => 'exists:pricelists,id',
            // 'service_items.*.qty' => 'required|integer|min:1',
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $serviceItems = Pricelist::where('id', $request->deskripsi)->get();

        $serviceItemsData = [];

        foreach ($serviceItems as $item) {
        // $qty = $validated['service_items'][$item->id]['qty'];

        // foreach ($validated['service_items'] as $item) {
            $serviceItem = Pricelist::find($item['id']);
            $serviceItemsData[] = [
                'id' => $serviceItem->id,
                'deskripsi' => $serviceItem->deskripsi,
                'kapasitas' => $serviceItem->kapasitas,
                'harga' => $serviceItem->harga,
                'qty' => $request->qty,
            ];
        }

        $data =array(
            'name'=> $request['customername'],
            'email'=> $request['email'],
            'phone'=> $request['phone'],
            'address'=> $request['address'],
            'service_items'=> $serviceItemsData,

        );
        $data = Workorder::updateOrCreate(['id' => $id], $data);
        return response()->json(['success' => 'Data berhasil disimpan']);

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
    // public function edit($id)
    // {
    //     $where = array('id' => $id);
    //     $post[]  = Workorder::where($where)->first();
    //     $item = Pricelist::where('id',$post['service_item'][0]['id'])->get();
    //     $post['item'] =$item ;
    //     // $data = $post->users->name;
    //     return response()->json($post, 200);
    // }

    public function edit($id)
    {
        $where = array('id' => $id);
        $workorder = Workorder::where($where)->first();
        // $items = $workorder->service_items[0]['id'];
        $items = Pricelist::where('id',$workorder['service_items'][0]['id'])->get();

        return response()->json([
            'workorder' => $workorder,
            'items' => $items,
        ], 200);
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
