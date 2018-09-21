<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PollVote;
use App\PollItem;
use Auth;
use DB;

class PollVoteController extends Controller
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

        $userId = Auth::user()->id;
        $postId = $request->poll_item_id;
        $vote =  PollVote::where('user_id', $userId)
            ->where('poll_item_id', $postId)
            ->get();
        if (isset($vote[0]) && !empty($vote[0])){
            if (isset($vote[0]->vote) && !empty($vote[0]->vote)){
                if($vote[0]->vote==1){
                    $views = PollItem::find($request->poll_item_id);
                    $views->item_votes -= 1;
                    $views->update();
                    $delete = PollVote::find($vote[0]->id);
                    $delete->delete();
                    $voteNumber =  DB::table('poll_votes')
                        ->where('poll_item_id', $postId)
                        ->sum('vote');
                    return response()->json(['status'=>'deleted','voteNumber' => $voteNumber]);
                }elseif ($vote[0]->vote==-1){
                    $update = PollVote::find($vote[0]->id);
                    $update->vote = 1;
                    $update->update();
                    $voteNumber =  DB::table('poll_votes')
                        ->where('poll_item_id', $postId)
                        ->sum('vote');
                    return response()->json(['status'=>'upvoted','voteNumber' => $voteNumber]);
                }
            }
        }else{
            $views = PollItem::find($request->poll_item_id);
            $views->item_votes += 1;
            $views->update();

            $vote = new PollVote();
            $vote->vote = 1;
            $vote->poll_item_id = $postId;
            $vote->user_id = $userId;
            $vote->save();
            $voteNumber =  DB::table('poll_votes')
                ->where('poll_item_id', $postId)
                ->sum('vote');
            return response()->json(['status'=>'upvoted','voteNumber' => $voteNumber]);
        }
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
