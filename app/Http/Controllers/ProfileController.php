<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Post;
use App\Vote;
use App\SavedStories;
use App\SocialInfo;
use Hash;

use App\Profile;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $posts = Post::where('user_id', '=',$userId)->count();
        $upvotes = Vote::where('user_id', '=',$userId)->where('vote', '=',1)->count();
        $downvotes = Vote::where('user_id', '=',$userId)->where('vote', '=',-1)->count();
        $savedStories = SavedStories::where('user_id', '=',$userId)->count();
//        dd($posts);
        return view('pages/user/profile', compact('user','posts','upvotes','downvotes','savedStories'));
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
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $check = Hash::check($request->password, $user->password);
        if($check){
            $user->email = $request->email;
            $user->update();
        }
        return view('pages/user/settings', compact('user'));
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

    public function userPosts()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $posts = Post::where('user_id', '=',$userId)->get();
//        dd($posts);
        return view('pages/user/myposts', compact('user','posts'));
    }

    public function settings()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
//        dd($posts);
        return view('pages/user/settings', compact('user'));
    }

    public function change_password()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
//        dd($posts);
        return view('pages/user/change-password', compact('user'));
    }



    public function changePassword (Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $check = Hash::check($request->oldPassword, $user->password);
        if($check){
            if ($request->newPassword == $request->confirmPassword)
            $user->password = Hash::make($request->newPassword);
            $user->update();
        }
        return view('pages/user/change-password', compact('user'));
    }

    public function social_info()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
//        dd($posts);
        return view('pages/user/social-info', compact('user'));
    }


    public function socialInfo(Request $request)
    {
//        dd($request);
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $socialInfo = new SocialInfo();
        $socialInfo->user_id = $userId;
        $socialInfo->username = $user->username;
        $socialInfo->facebook = $request->facebook;
        $socialInfo->google_plus = $request->googlePlus;
        $socialInfo->linked_in = $request->linkedIn;
        $socialInfo->save();
//        dd($posts);
        return view('pages/user/social-info', compact('user'));
    }


    public function profilePictureUpload(Request $request)
    {
        if (Input::hasFile('profilePicture')) {
            $img = Input::file('profilePicture');
//        $img=$_FILES['img'];
            $imgName = $img->getClientOriginalName();
            if ($imgName == "") {
                echo "Select an image please!!!";
            } else {
                $filename = $img->getRealPath();
                $client_id = "1c8b1e4613478ef";
                $handle = fopen($filename, "r");
                $data = fread($handle, filesize($filename));
                $pvars = array('image' => base64_encode($data));
                $timeout = 30;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                $out = curl_exec($curl);
                curl_close($curl);
                $pms = json_decode($out, true);
                $url = $pms['data']['link'];

            }
        }
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $user->profile_picture_link = $url;
        $user->update();
        return redirect()->back();
    }
}
