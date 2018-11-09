<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Post;
use App\Project;
use App\Folder;
use Auth;
use Intervention;
use App\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('auth', ['only' => ['create']]);
    }

    public function index()
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Project::with('project_votes')->with('project_comments')->with('saved_projects')->orderBy('views', 'DESC')->get();
        $page1 = 'all';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/allProject', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/allProject', compact('posts', 'page1'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::with('comments')->find(1);
	    return view('pages.addProject',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $image = $request->logo;
        $extension =$image->getClientOriginalExtension();//get image extension only
        $imageOriginalName= $image->getClientOriginalName();
        $basename = substr($imageOriginalName, 0 , strrpos($imageOriginalName, "."));//get image name without extension
        $imageName=$basename.date("YmdHis").'.'.$extension;//make new name
        $path = 'images/projects/logos/' . $imageName;
        $resizedImage = Intervention::make($image->getRealPath())->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        });
        $save = $resizedImage->save($path,60);

//        $extension = pathinfo($request->logo, PATHINFO_EXTENSION);
//        $ext = explode('?',$extension);
//        $logo = 'images/projects/logos/'.str_random(4).'-'.str_slug($request->title).'-'.time().'.'.$ext[0];
//        $file = file_get_contents($info->image);
//        $img = Intervention::make($request->logo->getRealPath());
//        $resizedImage = $img->resize(500, 500, function ($constraint) {
//            $constraint->aspectRatio();
//        });
//        $save = $resizedImage->save($logo,60);
        $imgPaths = array();
        foreach ($request->images as $image){
            $extension =$image->getClientOriginalExtension();//get image extension only
            $imageOriginalName= $image->getClientOriginalName();
            $basename = substr($imageOriginalName, 0 , strrpos($imageOriginalName, "."));//get image name without extension
            $imageName=$basename.date("YmdHis").'.'.$extension;//make new name
            $path = 'images/projects/' . $imageName;
            $resizedImage = Intervention::make($image->getRealPath())->resize(650, 365);
            $save = $resizedImage->save($path,80);
            if ($save){
                $imgPaths[] = $path;
            }
        }
        $implodedPaths = implode(',',$imgPaths);

//        dd($implodedPaths);
        $posts = new Project();
        $posts->title = $request->title;
        $posts->link = $request->link;
        $posts->tag_line = $request->tag_line;
        $posts->description = $request->description;
        $posts->logo = $path;
        $posts->screenshots = $implodedPaths;
        $posts->category = $request->category;
        $posts->tags = $request->tags;
        $posts->user_id = $userId;
        $posts->username = $user->username;
        $posts->views = 0;
        $posts->project_votes = 0;
        $posts->project_comments = 0;
        $posts->save();

        return redirect('story');
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
