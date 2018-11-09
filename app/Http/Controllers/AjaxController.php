<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){
        die("aa");
    }
    public function get_more_post(Request $request){
        $offset = $request->offset;
        $limit = 5;
        $newOffset = $offset + $limit;
//        echo $newOffset;
//        die($newOffset);
        $posts = Post::with('votes')
            ->with('comments')
            ->with('saved_stories')
            ->orderBy('views', 'DESC')
            ->offset($newOffset)
            ->limit($limit)
            ->get();

        if(sizeof($posts) != 0){
            return response()->json(['sucess'=>'true' , 'newOffset' => $newOffset, 'posts' => $posts]);
        }else{
            return response()->json(['sucess'=>'false']);
        }
    }
}
