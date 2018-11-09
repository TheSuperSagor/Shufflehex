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
use App\Folder;
use App\SavedStories;
use carbon;
use Auth;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user()->id);
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->orderBy('views', 'DESC')->offset(0)->limit(5)->get();
        $page1 = 'all';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/all', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/all', compact('posts', 'page1'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::find($request->user_id);
        $info = Embed::create($request->link);

        $explodedLink = explode('//', $request->link);
        if (isset($explodedLink[1]) && !empty($explodedLink[1])) {
            $domainName = explode('/', $explodedLink[1]);
        }else {
            $domainName = explode('/', $explodedLink[0]);
        }
        $posts = new Post();
        $posts->title = $request->title;
        $posts->link = $request->link;
        $posts->domain = $domainName[0];
        $posts->featured_image = $info->image;
        $posts->category = $request->category;
        $posts->description = $request->description;
        $posts->tags = $request->tags;
        $posts->user_id = $request->user_id;
        $posts->username = $user->username;
        $posts->views = 0;
        $posts->post_votes = 0;
        $posts->post_comments = 0;
        $posts->is_link = 1;
        $posts->is_image = 0;
        $posts->is_video = 0;
        $posts->is_article = 0;
        $posts->is_list = 0;
        $posts->is_poll = 0;
        $posts->save();

        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('pages.OldPages.iframeView', compact('post'));

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

    public function showPost($id,$title)
    {
        $views = Post::find($id);
        $views->views += 1;
        $views->update();

        $post = Post::with('comments')->with('replies')->with('votes')->with('saved_stories')->find($id);
        $totalComments = count($post->comments)+count($post->replies);
        if ($post->is_poll == 1 || $post->is_list == 1){
//            $post = DB::table('posts')
//                ->join('poll_items', 'posts.id', '=', 'poll_items.post_id')
//                ->join('poll_votes', 'poll_items.id', '=', 'poll_votes.poll_item_id')
//                ->where('posts.id', $id)
//                ->where('posts.id', $id)
//                ->select('name');
//            dd($post);
            $post = Post::with(['poll_items' => function ($q) {
                $q->orderBy('item_votes', 'desc');
            }])->find($id);

//            $post = Post::with('poll_items')->find($id);
            $poll_votes = '';
            if (isset(Auth::user()->id)){
            foreach ($post->poll_items as $onePost) {
                    $votes = PollVote::where('poll_item_id', $onePost->id)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                foreach ($votes as $vote){
                    $poll_votes.= $vote->poll_item_id.',';
                }
                }

            }
            return view('pages.pollView', compact('post','poll_votes'));
        }
        return view('pages.story', compact('post','totalComments'));
    }

    public function viewPost($id)
    {

        $post = Post::with('comments')->find($id);
        return view('pages.view', compact('post'));
    }

     public function latestPost($page)
     {
//        dd($page);
         if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
             $folders = Folder::where('user_id', '=', Auth::user()->id)->get();
         }

         $date = new Carbon\Carbon; //  DateTime string will be 2014-04-03 13:57:34

         $date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
         // dd($date);
         if ($page == 'all') {
             $posts = Post::with('votes')->with('comments')->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
             $page1 = 'all';
             $page2 = 'Latest';
         }

             if ($page == 'web') {
                 $posts = Post::with('votes')->with('comments')->where('is_link', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'web';
                 $page2 = 'Latest';
             }

             if ($page == 'images') {
                 $posts = Post::with('votes')->with('comments')->where('is_image', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'images';
                 $page2 = 'Latest';
             }

             if ($page == 'videos') {
                 $posts = Post::with('votes')->with('comments')->where('is_video', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'videos';
                 $page2 = 'Latest';
             }


             if ($page == 'articles') {
                 $posts = Post::with('votes')->with('comments')->where('is_article', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'articles';
                 $page2 = 'Latest';
             }



             if ($page == 'lists') {
                 $posts = Post::with('votes')->with('comments')->where('is_list', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'lists';
                 $page2 = 'Latest';
             }




             if ($page == 'polls') {
                 $posts = Post::with('votes')->with('comments')->where('is_poll', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('created_at', 'DESC')->get();
                 $page1 = 'polls';
                 $page2 = 'Latest';
             }

         if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
             return view('pages/'.$page1, compact('posts', 'folders', 'page1', 'page2'));
         } else {
             return view('pages/'.$page1, compact('posts', 'page1', 'page2'));
         }

     }

    public function topPost($page)
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            $folders = Folder::where('user_id', '=', Auth::user()->id)->get();
        }
        $date = new Carbon\Carbon; //  DateTime string will be 2014-04-03 13:57:34

        $date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
        // dd($date);
        if ($page == 'all') {
            $posts = Post::with('votes')->with('comments')->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'all';
            $page2 = 'Top';
        }

        if ($page == 'web') {
            $posts = Post::with('votes')->with('comments')->where('is_link', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'web';
            $page2 = 'Top';
        }

        if ($page == 'images') {
            $posts = Post::with('votes')->with('comments')->where('is_image', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'images';
            $page2 = 'Top';
        }

        if ($page == 'videos') {
            $posts = Post::with('votes')->with('comments')->where('is_video', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'videos';
            $page2 = 'Top';
        }


        if ($page == 'articles') {
            $posts = Post::with('votes')->with('comments')->where('is_article', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'articles';
            $page2 = 'Top';
        }



        if ($page == 'lists') {
            $posts = Post::with('votes')->with('comments')->where('is_list', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'lists';
            $page2 = 'Top';
        }




        if ($page == 'polls') {
            $posts = Post::with('votes')->with('comments')->where('is_poll', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('views', 'DESC')->get();
            $page1 = 'polls';
            $page2 = 'Top';
        }

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/'.$page1, compact('posts', 'folders', 'page1', 'page2'));
        } else {
            return view('pages/'.$page1, compact('posts', 'page1', 'page2'));
        }
    }

    public function popularPost($page)
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            $folders = Folder::where('user_id', '=', Auth::user()->id)->get();
        }
        $date = new Carbon\Carbon; //  DateTime string will be 2014-04-03 13:57:34

        $date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
        // dd($date);
        if ($page == 'all') {
            $posts = Post::with('votes')->with('comments')->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'all';
            $page2 = 'Popular';
        }

        if ($page == 'web') {
            $posts = Post::with('votes')->with('comments')->where('is_link', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'web';
            $page2 = 'Popular';
        }

        if ($page == 'images') {
            $posts = Post::with('votes')->with('comments')->where('is_image', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'images';
            $page2 = 'Popular';
        }

        if ($page == 'videos') {
            $posts = Post::with('votes')->with('comments')->where('is_video', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'videos';
            $page2 = 'Popular';
        }


        if ($page == 'articles') {
            $posts = Post::with('votes')->with('comments')->where('is_article', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'articles';
            $page2 = 'Popular';
        }



        if ($page == 'lists') {
            $posts = Post::with('votes')->with('comments')->where('is_list', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'lists';
            $page2 = 'Popular';
        }




        if ($page == 'polls') {
            $posts = Post::with('votes')->with('comments')->where('is_poll', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->get();
            $page1 = 'polls';
            $page2 = 'Popular';
        }

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/'.$page1, compact('posts', 'folders', 'page1', 'page2'));
        } else {
            return view('pages/'.$page1, compact('posts', 'page1', 'page2'));
        }
    }

    public function trendingPost($page)
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            $folders = Folder::where('user_id', '=', Auth::user()->id)->get();
        }
        $date = new Carbon\Carbon; //  DateTime string will be 2014-04-03 13:57:34

        $date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
        // dd($date);
        if ($page == 'all') {
            $posts = Post::with('votes')->with('comments')->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'all';
            $page2 = 'Trending';
        }

        if ($page == 'web') {
            $posts = Post::with('votes')->with('comments')->where('is_link', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'web';
            $page2 = 'Trending';
        }

        if ($page == 'images') {
            $posts = Post::with('votes')->with('comments')->where('is_image', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'images';
            $page2 = 'Trending';
        }

        if ($page == 'videos') {
            $posts = Post::with('votes')->with('comments')->where('is_video', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'videos';
            $page2 = 'Trending';
        }


        if ($page == 'articles') {
            $posts = Post::with('votes')->with('comments')->where('is_article', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'articles';
            $page2 = 'Trending';
        }



        if ($page == 'lists') {
            $posts = Post::with('votes')->with('comments')->where('is_list', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'lists';
            $page2 = 'Trending';
        }




        if ($page == 'polls') {
            $posts = Post::with('votes')->with('comments')->where('is_poll', '=', 1)->where('created_at', '>=', $date->toDateTimeString())->orderBy('post_votes', 'DESC')->orderBy('post_comments', 'DESC')->get();
            $page1 = 'polls';
            $page2 = 'Trending';
        }

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/'.$page1, compact('posts', 'folders', 'page1', 'page2'));
        } else {
            return view('pages/'.$page1, compact('posts', 'page1', 'page2'));
        }
    }

    public function webPost()
    {
        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_link','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'web';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/web', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/web', compact('posts', 'page1'));
        }
    }

    public function imagesPost()
    {

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_image','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'images';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/images', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/images', compact('posts', 'page1'));
        }
    }


    public function videosPost()
    {

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_video','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'videos';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/videos', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/videos', compact('posts', 'page1'));
        }
    }


    public function articlesPost()
    {

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_article','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'articles';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/articles', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/articles', compact('posts', 'page1'));
        }
    }


    public function listsPost()
    {

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_list','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'lists';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/lists', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/lists', compact('posts', 'page1'));
        }
    }


    public function pollsPost()
    {

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)){
            $folders = Folder::where('user_id','=',Auth::user()->id)->get();
        }
        $posts = Post::with('votes')->with('comments')->with('saved_stories')->where('is_poll','=','1')->orderBy('views', 'DESC')->get();
        $page1 = 'polls';

        if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
            return view('pages/polls', compact('posts', 'folders', 'page1'));
        } else{
            return view('pages/polls', compact('posts', 'page1'));
        }
    }


    public function savedPost()
    {
        $userId = Auth::user()->id;
        $folders = Folder::where('user_id','=',$userId)->get();
//        dd($folders);
        $savedPosts = DB::table('posts')->join('saved_stories', 'posts.id', '=', 'saved_stories.post_id')->where('saved_stories.user_id','=',$userId)->get();
//        $savedPosts = SavedStories::with('posts')->where('user_id','=',$userId)->orderBy('created_at', 'DESC')->get();

        return view('pages/saved', compact('savedPosts','folders'));
    }


    public function notifications()
    {

        return view('pages/user/notifications');
    }



}