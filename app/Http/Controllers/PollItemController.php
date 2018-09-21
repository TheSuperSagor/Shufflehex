<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Embed\Embed;
use App\Post;
use App\Poll;
use App\PollItem;
use App\Image;
use App\User;
use App\Category;
use App\Folder;
use App\SavedStories;
use carbon;
use Auth;
use DB;

class PollItemController extends Controller
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
        $user = User::find($request->user_id);
        if (Input::hasFile('img')) {
            $img = Input::file('img');
//        $img=$_FILES['img'];
            $imgName = $img->getClientOriginalName();
            if ($imgName == "") {
                echo "An Image Please";
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

        $explodedLink = explode('//', $request->link);
        if (isset($explodedLink[1]) && !empty($explodedLink[1])) {
            $domainName = explode('/', $explodedLink[1]);
        }else {
            $domainName = explode('/', $explodedLink[0]);
        }
        $posts = new PollItem();
        $posts->title = $request->title;
        $posts->link = $request->link;
        $posts->domain = $domainName[0];
        $posts->featured_image = $url;
        $posts->description = $request->description;
        $posts->tags = $request->tags;
        $posts->post_id = $request->post_id;
        $posts->user_id = $request->user_id;
        $posts->username = $user->username;
        $posts->item_votes = 0;
        $posts->save();

        return redirect()->back();
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
