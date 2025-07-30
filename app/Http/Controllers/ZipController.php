<?php
namespace App\Http\Controllers;
use DB;
use App\Models\Route;
use App\Models\Routezip;
use Illuminate\Http\Request;
class ZipController extends Controller
{
    public function index()
    {

        $title = "Route ZipCode List";
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $allroutezip = DB::table('routezips')->leftJoin('routes','routes.id','=','routezips.route_id')->select('routezips.*','routes.route','routes.title as name')->where('routezips.status', '!=', '3')->orderby('routezips.id', 'desc')->get();
        return view('routezip.index', compact('title', 'allroutezip','allroute'));
    }
    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'route_id' => 'required',
                'zip_code' => 'required|integer',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->zip_code == $request->zip_code) {
                    $message .= "ZipCode ";
                }
                if ($message) {
                    return redirect()->route('routezip')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $routezip = new Routezip();
            $routezip->route_id = $request->route_id;

            $routezip->zip_code = $request->zip_code;
            $routezip->status = $request->status;
            $routezip->save();
            return redirect()->route('routezip')->with('success', 'ZipCode Added Successfully');
        }
        $title = "Add Route ZipCode";
        return view('routezip.create', compact('title'));
    }
    public function edit($id)
    {
        $title = "Edit Route ZipCode";
        $get_routezip = Routezip::where('status', '!=', 3)->where('id', $id)->first();
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $allroutezip = DB::table('routezips')->leftJoin('routes','routes.id','=','routezips.route_id')->select('routezips.*','routes.route')->where('routezips.status', '!=', '3')->orderby('routezips.id', 'desc')->get();
        return view('routezip.index', compact('title', 'allroutezip','get_routezip','allroute'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'route_id' => 'required',
            'zip_code' => 'required|integer',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->zip_code == $request->zip_code) {
                $message .= "ZipCode ";
            }
            if ($message) {
                return redirect()->route('routezip')
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $routezip = Routezip::findOrFail($request->hidden_id);
        $routezip->route_id = $request->route_id;

        $routezip->zip_code = $request->zip_code;
        $routezip->status = $request->status;
        $routezip->save();
        return redirect()->route('routezip')->with('success', 'Route Updated Successfully');
    }
    public function destroy($id)
    {
        $routezip = Routezip::findOrFail($id);
        $routezip->status = 3;
        $routezip->update();
        return redirect()->route('routezip')->with('success', 'Route deleted successfully.');
    }
    public function check_exist_data($request, $id)
    {
        $query = Routezip::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_routezip = $query->where(function ($q) use ($request) {
            $q->where('zip_code', $request->zip_code);
        })->first();
        return $check_routezip;
    }
}
