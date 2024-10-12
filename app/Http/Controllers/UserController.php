<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Pricelist;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Posts = Post::all();
        $prices = Pricelist::all();
        return view('index', compact('Posts', 'prices'));
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

    public function tangerang()
    {

        $Posts = Post::all();
        $prices = Pricelist::all();
        return view('indextangerang', compact('Posts', 'prices'));


    }

    public function users(Request $request)
    {
        if($request->ajax()){
            //Jika request from_date ada value(datanya) maka
            if(!empty($request->from_date))
            {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if($request->from_date === $request->to_date){
                    //kita filter tanggalnya sesuai dengan request from_date
                    $data = User::whereDate('created_at','=', $request->from_date)->get();
                }
                else{
                    $from_date=$request->from_date;
                    $to_date=$request->to_date;
                    $menitawal="00:00:00";
                    $menitakhir="23:59:59";
                    $awalkaping= $from_date.' '.$menitawal;
                    $tungtungkaping=$to_date.' '.$menitakhir;
                    //kita filter dari tanggal awal ke akhir
                    $data = User::whereBetween('created_at', array($awalkaping, $tungtungkaping))
                    ->get();
                }
            }
            //load data default
            else
            {
                $data = User::orderBy('created_at', 'desc')->get();
            }
            return datatables()->of($data)
                ->addColumn('role', function(User $user){
                    // $roles = $user->
                    return array($user->getRoleNames());
                })

                ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action', 'role'])
                ->addIndexColumn()
                ->make(true);
        }

         //$nama =Auth::user();
        // $nama->givePermissionTo('logsheet');
         // $nama->assignRole('admin');

        // $role = Role::findById(1);
        // $role->givePermissionTo('logsheet');
        $Users = User::all();
        $Roles = \Auth::user()->getRoleNames();
        $Permission = \Auth::user()->getAllPermissions();
        $Roles = Role::all();

        // $Roles_data= $Roles[0];
          // return(Auth::user()->getRoleNames()[0]);

        return view('/user.users');

    }
}
