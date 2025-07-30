<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Route;
use App\Models\Routezip;
use App\Models\Assignroute;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AssignrouteController extends Controller
{
    public function index()
    {
        $title = "Route Assign List";
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $alluser = Member::where('status', '!=', '3')->where('role_id',3)->orderBy('id', 'desc')->get();
        $allrouteassign = DB::table('assignroutes')->leftJoin('users','assignroutes.user_id','=','users.id')->leftJoin('routes','assignroutes.route_id','=','routes.id')->select('assignroutes.*','routes.route','routes.title as title','users.name')->where('assignroutes.status', '!=', '3')->orderby('assignroutes.id', 'desc')->get();
        return view('routeassign.index', compact('title', 'allrouteassign','allroute','alluser'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'route_id' => 'required',
                'user_id' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);

            if ($check_data) {
                DB::table('assignroutes')->where('id',$check_data->id)->update(['user_id'=>$request->user_id,'created_at'=>date('Y-m-d H:i:s')]);
                if($check_data->user_id != $request->user_id){
                    $get_log = DB::table('route_logs')->where('route_id',$request->route_id)->orderBy('id','desc')->limit(1)->first();
                    if($get_log){
                        DB::table('route_logs')->where('id',$get_log->id)->update(['updated_at'=>date('Y-m-d H:i:s')]);
                    }
                    DB::table('route_logs')->insert(['route_assign_id'=>$check_data->id,'user_id'=>$request->user_id,'route_id'=>$check_data->route_id]);
                }
            }else{
                $routeassign = new Assignroute();
                $routeassign->route_id = $request->route_id;
                $routeassign->user_id = $request->user_id;
                $routeassign->status = $request->status;
                $routeassign->save();
                $insert_id = $routeassign->id;
                DB::table('route_logs')->insert(['route_assign_id'=>$insert_id,'user_id'=>$request->user_id,'route_id'=>$request->route_id]);
            }
        }
        return redirect()->route('routeassign')->with('success', 'ZipCode Added Successfully');

    }

    public function edit($id)
    {
        $title = "Edit Route Assign";
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $alluser = Member::where('status', '!=', '3')->where('role_id',3)->orderBy('id', 'desc')->get();
        $allrouteassign = DB::table('assignroutes')->leftJoin('users','assignroutes.user_id','=','users.id')->leftJoin('routes','assignroutes.route_id','=','routes.id')->select('assignroutes.*','routes.route','users.name')->where('assignroutes.status', '!=', '3')->orderby('assignroutes.id', 'desc')->get();
        $assignroute = Assignroute::where('status', '!=', 3)->where('id', $id)->first();
        return view('routeassign.index', compact('title', 'allroute','alluser','allrouteassign','assignroute'));

    }

    public function update(Request $request)
    {

        $request->validate([
            // 'route_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->zip_code == $request->zip_code) {
                $message .= "Route Assign ";
            }
            if ($message) {
                return redirect()->route('routeassign')
                    ->with('error', trim($message) . ' Already Exists');
            }
        }

        $routeassign = Assignroute::findOrFail($request->hidden_id);
        if($routeassign->user_id != $request->user_id){
            DB::table('route_logs')->insert(['route_assign_id'=>$request->hidden_id,'user_id'=>$request->user_id,'route_id'=>$routeassign->route_id]);
        }
        // $routeassign->route_id = $request->route_id;
        $routeassign->user_id = $request->user_id;
        $routeassign->status = $request->status;
        $routeassign->save();
        $insert_id = $request->hidden_id;

        return redirect()->route('routeassign')->with('success', 'Route Assign Update Successfully');
    }


    public function destroy($id)
    {
        $routezip = Assignroute::findOrFail($id);
        $routezip->status = 3;
        $routezip->update();
        return redirect()->route('routeassign')->with('success', 'Route Assign deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Assignroute::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_routezip = $query->where(function ($q) use ($request) {
            $q->where('route_id', $request->route_id);
        })->first();

        return $check_routezip;
    }

    public function update_check_exist_data($request, $id)
    {
        $query = Assignroute::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_routezip = $query->where(function ($q) use ($request) {
            $q->where('route_id', $request->route_id)->orWhere('user_id',$request->user_id);
        })->first();

        return $check_routezip;
    }

    public function view($id){
        $title = "View Route Assign";
        $get_assign_route = DB::table('assignroutes')->leftJoin('route_logs','assignroutes.id','=','route_logs.route_assign_id')->select('assignroutes.id as assign_id','route_logs.*','routes.route as route','routes.title as title','route_logs.created_at as assign_time','route_logs.updated_at as remove_time','users.name as username')->leftJoin('routes','route_logs.route_id','=','routes.id')->leftJoin('users','users.id','=','route_logs.user_id')->where('assignroutes.status','!=',3)->where('assignroutes.id',$id)->orderBy('route_logs.id','desc')->get();
        $assign_route = array();
        foreach($get_assign_route as $route){
                $get_zip_code = Routezip::where('status',1)->where('route_id',$route->route_id)->get();
                $route->zip_code = $get_zip_code;
                $assign_route[] = $route;
        }
        return view('routeassign.view', compact('title', 'assign_route'));
    }
}
