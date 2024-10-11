<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Post;

use Validator;
use Illuminate\Support\Facades\Auth;

class RolepermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexrole(Request $request)
    {
        // $role = Role::create(['name' => 'Super-Admin']);
        // $permission = Permission::create(['name' => 'edit articles']);

        // $role->givePermissionTo($permission);
        // $user = \Auth::User();
        // $user->assignRole('Super-Admin');
        // $user->givePermissionTo('edit articles');

    //   $role= $user->getRoleNames();
    //   return dd($role);
    //      if ($role == null) {
    //        $user->assignRole('Super-Admin');
    //      }

        if($request->ajax()){
            $data = Role::orderBy('created_at', 'desc')->get();
            return datatables()->of($data)
                // ->addColumn('role', function(User $user){
                //     // $roles = $user->
                //     return array($user->getRoleNames());
                // })
                ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('/rolepreset.indexrole');
     }
     public function indexpermission(Request $request)
    {
        if($request->ajax()){
            $data = Permission::orderBy('created_at', 'desc')->get();
            return datatables()->of($data)
                ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('/rolepreset.indexpermission_view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/rolepreset.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $id = $request->id;

        $rules = array(
            'role'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name'    =>  $request->role,
        );

        $data = Role::updateOrCreate(['id' => $id], $data);
        return response()->json(['success' => $data]);
    }

    public function storePermission(Request $request)
    {

        $id = $request->id;
        $rules = array(
            'permission'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name'    =>  $request->permission,
        );
        $data = Permission::updateOrCreate(['id' => $id], $data);
        // $permission = Permission::create(['name' => 'edit articles']);
        // $data = Permission::create(['name' => $request->permission]);
        return response()->json(['success' => $data]);

        // return redirect('/permissionpreset' )->with('toast_success','Permission Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Role::orderBy('name', 'desc')->get();
        echo json_encode($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $where = array('id' => $role->id);
        $post  = Role::where($where)->first();
        return response()->json($post, 200);
    }

    public function permissionedit(Permission $permission)
    {
        $where = array('id' => $permission->id);
        $post  = Permission::where($where)->first();
        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, Role $role)
    {
        Role::where ('id', $role->id)
        ->update([
                    'name'=>$request->role,
                ]);
return redirect('/rolepreset' )->with('toast_info','Role Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {

        $role =Role::findById($user);

         if ($role == true){
               $role->delete();

         }
    }
}
