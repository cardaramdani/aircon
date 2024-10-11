<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Post::query();

            if (!empty($request->from_date)) {
                $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
            }

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="'.$row->id.'">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('posts.index');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request->id;

        $rules = array(
            'title'    =>  'required',
            'body'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'title'    =>  $request->title,
            'user_id'    =>  \Auth::User()->id,
            'body'    =>  $request->body,
            'slug'    =>  $request->slug,
        );

        $data = Post::updateOrCreate(['id' => $id], $data);
        return response()->json(['success' => $data]);
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::where('id',$id)->get();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $where = array('id' => $id);
        $post  = Post::where($where)->first();
        return response()->json($post, 200);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
