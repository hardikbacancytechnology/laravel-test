<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Auth;
use Response;
use Session;
class PostController extends Controller{
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order
        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.posts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
        ]);
        $title = $request['title'];
        $body = $request['body'];
        if(Post::create($request->only('title', 'body'))):
            $response = ['status'=>100,'message'=>'Article '. $request->title.' created','url'=>route('posts.index'),'counter'=>Post::count()];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
        return Response::json($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $post = Post::findOrFail($id); //Find post of id = $id
        return view ('admin.posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($post->save()):
            $response = ['status'=>100,'message'=>'Article  updated','url'=>route('posts.index')];
        else:
            $response = ['status'=>102,'message'=>'Something went wrong with saving data'];
        endif;
        return Response::json($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('flash_message','Article successfully deleted');
    }
}
