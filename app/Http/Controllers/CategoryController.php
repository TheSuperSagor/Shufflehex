<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Embed\Embed;
use App\Post;
use App\PollItem;
use App\PollVote;
use App\Image;
use App\User;
use App\Category;
use App\ProductCategory;
use App\Folder;
use App\SavedStories;
use carbon;
use Auth;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return view('pages.categoryCreate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('category','=',$category)->orderBy('views', 'DESC')->get();
        $page1 = 'all';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/categoryWisePosts', compact('posts', 'folders', 'page1','category'));
        } else{
            return view('pages/categoryWisePosts', compact('posts', 'page1','category'));
        }
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

    public function productCategoryCreate()
    {
        return view('pages.productCategoryCreate');
    }

    public function productCategory(Request $request)
    {
//        dd($request);
        $category = ProductCategory::create($request->all());
        return view('pages.productCategoryCreate');
    }
}
