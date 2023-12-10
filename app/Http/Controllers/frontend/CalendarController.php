<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
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
    /* displaying calendar page */
    public function index(Request $request)
    {
        if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)->where('u_id',Auth::user()->id)->where('status',1)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('layouts.full-calendar');
    }

    /* store and update event */
    public function action(Request $request)
    {
    	if($request->ajax())
    	{
            $request->validate(
                [
                    'title' => 'required',
                    'start' => 'required',
                    'end' => 'required',
                    'u_id' => 'required',
                ]
            );
            
            if($request->id == '0')
    		{
                $event = new Event;
                $event->u_id=$request->u_id;
    		}else{
    			$event = Event::find($request->id);
    		}
            $event->title=$request->title;
            $event->start=date('Y-m-dTh:i',strtotime($request->start));
            $event->end=date('Y-m-dTh:i',strtotime($request->end));
            if($event->save()){
                $responce = [
                    'status' => true,
                    'message' => "Success",
                ];
                echo json_encode($responce);
                exit;
            }
    	}
    }

    /* fetch data from database */
    public function data(Request $request)
    {
        $event = Event::where('id',$request->id)->first();
        if(!is_null($event)){
            $responce['data'] = $event;
            $responce['datesUnavailable'] = datesUnavailable();
            $responce['status'] = [
                'status' => true,
                'message' => "Success",
            ];
            echo json_encode($responce);
            exit;
        }
    }

    /* delete event */
    public function delete(Request $request)
    {
        $event = Event::find($request->id);
        $event->status=0;
        if($event->save()){
            $responce = [
                'status' => true,
                'message' => "Success",
            ];
            echo json_encode($responce);
            exit;
        }
    }

    /* check existing event */
    public function check_event(Request $request)
    {   
        $start = Carbon::create($request->start_date)->toDateString();
        $event = Event::whereDate('start','<=',$start)
                ->whereDate('end','>',$start)
                ->where('status',1)
                ->where('u_id',Auth::user()->id)
                ->first();
        if(is_null($event)){
            $response = [
                'data' => datesUnavailable(),
                'status' => true,
                'message' => "Success",
            ];
            echo json_encode($response);
            exit;
        }else{
            $response = [
                'status' => false,
                'message' => "you can't create multiple events in one day",
                'icon' => 'error',
            ];
            echo json_encode($response);
            exit;
        }
    }
    

}
