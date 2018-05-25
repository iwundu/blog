<?php

namespace Hirel\Http\Controllers;

use Illuminate\Http\Request;
use Hirel\posts;

class postController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show','index']]);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = posts::orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'post' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'

        ]);

//Handle file upload
        if($request->hasFile('cover_image')){
            
            $file = $request->file('cover_image');
            //file name
            $fileWithExt = $file->getClientOriginalName();
            //fileext
            $FileExtension = $file->getClientOriginalExtension();

            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);

            //move file

            $fileToStore = $filename.'_'.time().'.'.$FileExtension;
           
            $path = $file->storeAs('public/cover_images', $fileToStore);

        }else{
            $fileToStore = 'noimg.jpg';
        }
        //CREATE USER UNPUT
        $post = new posts;
        $post->post = $request->input('post');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileToStore;
        $post->save();

        return redirect('posts/')->with('success', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = posts::find($id);
        
        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = posts::find($id);
        return view('posts.edit')->with('posts', $posts);
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
        $this->validate($request , [
            'post' => 'required',
            'body' => 'required'

        ]);

if($request->hasFile('cover_image')){
            
            $file = $request->file('cover_image');
            //file name
            $fileWithExt = $file->getClientOriginalName();
            //fileext
            $FileExtension = $file->getClientOriginalExtension();

            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);

            //move file

            $fileToStore = $filename.'_'.time().'.'.$FileExtension;
           
            $path = $file->storeAs('public/cover_images', $fileToStore);

        }

        //CREATE USER UNPUT
        $post = posts::find($id);
        $post->post = $request->input('post');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){

            $post->cover_image = $fileToStore;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post Editted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = posts::find($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed Successfully');        
    }
}
