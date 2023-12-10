<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageEvent;
use App\Models\Message;
use App\Models\User;
use App\Models\User_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /* middeleware for verifying login or not */
    protected $id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            return $next($request);
        });
    }
    /* fetching data for display chat dashboard */
    public function index()
    {
        $all_users = getusers();
        return view('layouts.apps.chat',compact('all_users'));
    }

    /* getting users for chat dashboard */
    public function getUser(){
        return response()->json([
            'data' => getusers(),
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    }

    /* fetching data for private chatbox */
    public function chatToOne(Request $request)
    {
        $r_id = $request->r_id;
        $friendInfo = User::findOrFail($r_id);
        $myInfo = User::find(Auth::user()->id);
        $messages = Message::with('user_messages')->whereHas('user_messages', function ($query) use($r_id){
            $query->where(function ($query) use($r_id){
                $query->where('s_id',$r_id)
                      ->where('r_id',Auth::user()->id);
            })->orWhere(function ($query) use($r_id) {
                $query->where('s_id',Auth::user()->id)
                      ->where('r_id', $r_id);
            });
        })->orderBy('created_at', 'asc')->get(); 
        $this->data['friendInfo'] = $friendInfo;
        $this->data['myInfo'] = $myInfo;
        $this->data['messages'] = $messages;
        $response['data'] = $this->data;
        $response['status'] = [
            'status' => true,
        ];
        echo json_encode($response);
        exit;
    }

    /* storing message to database */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required'
        ]);

        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;
        $old_user_message = User_message::where('s_id',$sender_id)->where('r_id',$receiver_id)->first();
        if(is_null($old_user_message)){
            $user_message = new User_message();
            $user_message->s_id = $sender_id;
            $user_message->r_id = $receiver_id;
            $user_message->save();
            $parent_id = $user_message->id;
        }else{
            $parent_id = $old_user_message->id;
        }
        $message = new Message();
        $message->message = $request->message;
        $message->parent_id = $parent_id;
        if ($message->save()) {
            $sender = User::where('id',$sender_id)->first();
            User::where('id', $sender_id)->orWhere('id',$receiver_id)->update(['message_update' => now()]);
            $data = [];
            $data['sender_id'] = $sender_id;
            $data['sender_name'] = $sender->first_name.' '.$sender->last_name;
            $data['receiver_id'] = $receiver_id;
            $data['content'] = $message->message;
            $data['created_at'] = date('h:i A',strtotime($message->created_at));
            $data['parent_id'] = $parent_id;
            $data['socket_id'] = $request->socket_id;
            event(new PrivateMessageEvent($data));
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Message sent successfully'
            ]);
        }
    }

    /* fetching data for conversation dashboard */
    public function conversation($id)
    {
        $user_message = User_message::where('s_id',$id)->where('r_id',Auth::user()->id)->first();
        if(!is_null($user_message)){
            $user_message->messages()->where('message_status',0)->update(['message_status'=>1]);
        }
        $all_users = getusers();
        $friendInfo = User::find($id);
        if(!is_null($friendInfo)){
            $myInfo = User::find(Auth::user()->id);
            $messages = Message::with('user_messages')->whereHas('user_messages', function ($query) use($id){
                $query->where(function ($query) use($id){
                    $query->where('s_id',$id)
                            ->where('r_id',Auth::user()->id);
                })->orWhere(function ($query) use($id) {
                    $query->where('s_id',Auth::user()->id)
                            ->where('r_id', $id);
                });
            })->orderBy('created_at', 'asc')->get();
            $this->data['all_users'] = $all_users;
            $this->data['friendInfo'] = $friendInfo;
            $this->data['myInfo'] = $myInfo;
            $this->data['messages'] = $messages;
    
            return view('layouts.apps.conversation', $this->data);
        }else{
            return redirect()->back();   
        }
    }

}
