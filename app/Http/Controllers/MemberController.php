<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use DB;
use App\Models\Roles;
use App\Models\Member;
use App\Models\Providers;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{

    public function index()
    {

        $title = "Member List";
        // $allmember = Member::where('status','!=',3)->where('role_id','!=',1)->orderBy('id','desc')->get();
        $roles = Roles::where('status',1)->where('id','!=',1)->get();
        $providers = Providers::where('status',1)->get();
        $allmember = DB::table('users')->leftJoin('roles', 'roles.id', '=', 'users.role_id')->leftJoin('providers', 'providers.id', '=', 'users.provider_id')->select('users.*', 'roles.title','providers.title as provider_title')->where('users.role_id', '!=', 1)->where('users.status','!=',3)->orderBy('users.id','desc')->get();
        return view('member.index', compact('title', 'allmember','roles','providers'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required|string|max:255',
                'role_id' => 'required',
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
                ],
                'mobile_no' => [
                    'required',
                    'regex:/^[6-9]\d{9}$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
                // 'aadhar_no' => [
                //     'required',
                //     'regex:/^\d{12}$/'
                // ],
                // 'status' => 'required',
            ]);
            $check_data =  $this->check_exist_data($request, null);
            if (!empty($check_data)) {
                if ($check_data->email == $request->email) {
                    $message = "Email Address";
                }
                if ($check_data->mobile_no == $request->mobile_no) {
                    $message = "Mobile No.";
                }
                if ($check_data->aadhar_no == $request->aadhar_no) {
                    $message = "Aadhar No.";
                }
                if ($check_data->pan_no == $request->pan_no) {
                    $message = "Pan No.";
                }
                if ($check_data) {
                    return redirect()->route('member.create')->with('error', '' . $message . ' Already Exists');
                }
            }
            $member = new Member();
            $member->name = $request->name;
            $member->role_id = $request->role_id;
            $member->is_mobile_verified = 1 ;
            $member->is_user_verified = 1;
            $member->email = $request->email;
            $member->mobile_no = $request->mobile_no;
            $member->aadhar_no = $request->aadhar_no;
            $member->pan_no = $request->pan_no;
            $member->password = Hash::make($request->password);
            $member->member_id = rand(100000, 999999);
            if($request->provider_id){
                $member->provider_id = $request->provider_id;
            }
            // $member->status = $request->status;
            $member->save();
            $insert_id = $member->id;
            return redirect()->route('member')->with('success', 'Member Added Successfully');
        }

        $title = "Add Member";
        $get_role = Roles::where('status', 1)->where('id', '!=', 1)->get();
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $providers = Providers::where('status',1)->get();
        $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
        return view('member.create', compact('title', 'get_role', 'allroute','states','providers'));
    }

    public function edit($id)
    {
        $title = "Edit Member";
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $get_member = Member::where('status', '!=', 3)->where('role_id', '!=', 1)->where('id', $id)->first();
        $get_role = Roles::where('status', 1)->where('id', '!=', 1)->get();
        $providers = Providers::where('status',1)->get();
        $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
        return view('member.update_page', compact('title', 'get_member', 'get_role','allroute','states','providers'));
    }

    public function profile_update(){
        $user_id = Auth::user()->id;
        $title = "Profile Update";
        $allroute = Route::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $get_member = Member::where('status', '!=', 3)->where('id', $user_id)->first();
        $get_role = Roles::where('status', 1)->where('id', '!=', 1)->get();
        $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
        return view('member.update_profile', compact('title', 'get_member', 'get_role','allroute','states'));
    }

    public function update(Request $request)
    {
        if($request->role_id != 1){

            // Validate the incoming request data
            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'role_id' => 'required',
            //     'email' => [
            //         'required',
            //         'email',
            //         'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            //     ],
            //     'mobile_no' => [
            //         'required',
            //         'regex:/^[6-9]\d{9}$/'
            //     ],
            //     'alt_mobile_no' => 'nullable|digits:10', // Example validation rule for mobile number
            //     'occupation' => 'required|string',
            //     'company_name' => 'nullable|string',
            //     'aadhar_no' => 'nullable|digits:12',
            //     'pan_no' => 'nullable|alpha_num|size:10',
            //     'account_name' => 'nullable|string',
            //     'account_no' => 'nullable|numeric',
            //     'ifsc_code' => 'nullable|alpha_num|size:11',
            //     'bank_statement' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048', // Validate file types
            //     'id_card_upload' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            //     'office_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            //     'state' => 'nullable|string',
            //     'district' => 'nullable|string',
            //     'tehsil' => 'nullable|string',
            //     'town' => 'nullable|string',
            //     'pin_code' => 'nullable|digits:6',

            //     // 'aadhar_no' => [
            //     //     'required',
            //     //     'regex:/^\d{12}$/'
            //     // ],
            //     // 'status' => 'required',
            // ]);
            $request->validate([
                'name' => 'required',
                'role_id' => 'required',
                'email' => 'required',
                'mobile_no' => 'required',
                // 'alt_mobile_no' => 'required',
                // 'occupation' => 'required',
                // 'company_name' => 'required',
                // 'aadhar_no' => 'required',
                // 'pan_no' => 'required',
                // 'account_name' => 'required',
                // 'account_no' => 'required',
                // 'ifsc_code' => 'required',
                // 'bank_statement' => 'required',
                // 'id_card_upload' => 'required',
                // 'office_photo' => 'required',
                // 'state' => 'required',
                // 'district' => 'required',
                // 'tehsil' => 'required',
                // 'town' => 'required',
                // 'pin_code' => 'required',
            ]);

        }

        // Check if the email, mobile number, or Aadhar number already exists
        $check_data = $this->check_exist_data($request, $request->hidden_id);

        // Prepare the error message if the data exists
        if ($check_data) {
            $message = '';

            if (!empty($request->email) && $check_data->email == $request->email) {
                $message .= "Email Address ";
            }
            if (!empty($request->mobile_no) && $check_data->mobile_no == $request->mobile_no) {
                $message .= "Mobile No. ";
            }
            if (!empty($request->aadhar_no) && $check_data->aadhar_no == $request->aadhar_no) {
                $message .= "Aadhar No. ";
            }
            if (!empty($request->pan_no) && $check_data->pan_no == $request->pan_no) {
                $message .= "Pan No.";
            }
            // Redirect back with an error message if any data exists
            if ($message && $request->redirect == "update_profile") {
                return redirect()->route('profile.update')
                ->with('error', trim($message) . ' Already Exists');

            }else{
                return redirect()->route('member.edit', ['id' => $request->hidden_id])
                ->with('error', trim($message) . ' Already Exists');
            }
        }
        $member = Member::findOrFail($request->hidden_id);

        if($request->redirect == "update_profile"){
            if( ($member->occupation != null && $request->occupation != null) && $member->occupation != $request->occupation){
               Member::where('id',$member->id)->update(['is_user_verified' =>   2 ]);
            }
            if( ($member->account_name != null && $request->account_name != null) && $member->account_name != $request->account_name){
               Member::where('id',$member->id)->update(['is_user_verified' =>   2 ]);
            }
            if( ($member->account_no != null && $request->account_no != null) && $member->account_no != $request->account_no){
               Member::where('id',$member->id)->update(['is_user_verified' =>   2 ]);
            }
            if( ($member->ifsc_code != null && $request->ifsc_code != null) && $member->ifsc_code != $request->ifsc_code){
               Member::where('id',$member->id)->update(['is_user_verified' =>   2 ]);
            }
        }
        // Retrieve the member to update
        $member = Member::findOrFail($request->hidden_id);
        $member->name = $request->name;
        $member->role_id = $request->role_id;
        $member->email = $request->email;
        $member->mobile_no = $request->mobile_no;
        $member->aadhar_no = $request->aadhar_no;
        $member->pan_no = $request->pan_no;
        $member->alt_mobile_no = $request->input('alt_mobile_no');
        $member->occupation = $request->input('occupation');
        $member->company_name = $request->input('company_name');
        $member->aadhar_no = $request->input('aadhar_no');
        $member->pan_no = $request->input('pan_no');
        $member->account_name = $request->input('account_name');
        $member->account_no = $request->input('account_no');
        $member->ifsc_code = $request->input('ifsc_code');
        $member->state = $request->input('state');
        $member->district = $request->input('district');
        $member->tehsil = $request->input('tehsil');
        $member->town = $request->input('town');
        $member->pin_code = $request->input('pin_code');
        if($request->provider_id){
            $member->provider_id = $request->provider_id;
        }
        // Handle file uploads if they exist
        if ($request->hasFile('bank_statement')) {
            $file = $request->file('bank_statement');
            $filePath = $file->store('bank_statements', 'public');
            $member->bank_statement = $filePath;
        }

        if ($request->hasFile('id_card_upload')) {
            $file = $request->file('id_card_upload');
            $filePath = $file->store('id_cards', 'public');
            $member->id_card_upload = $filePath;
        }

        if ($request->hasFile('office_photo')) {
            $file = $request->file('office_photo');
            $filePath = $file->store('office_photos', 'public');
            $member->office_photo = $filePath;
        }

        if($request->password)
        {
        $member->password = Hash::make($request->password);
        }

        // $member->status = $request->status;
        $member->save(); // Use save() to persist the changes

        // Redirect to the member list with a success message
        if($request->redirect == "update_profile") {
            $route_redirect = "profile.update";
        }else{
            $route_redirect = "member";
        }
        return redirect()->route($route_redirect)->with('success', 'Member Updated Successfully');
    }


    public function destroy($id)
    {

        $member = Member::findOrFail($id);
        $member->status = 3;
        $member->update();
        return redirect()->route('member')->with('success', 'Member deleted successfully.');
    }
    public function check_exist_data($request, $id)
    {
        $query = Member::where('status', '!=', 3);

        if ($id !== null) {
            // Exclude the current member from the check
            $query->where('id', '!=', $id);
        }

        // Check for existing email, mobile number, Aadhar number, or PAN number if provided in the request
        $check_member = $query->where(function ($q) use ($request) {
            if ($request->filled('email')) {
                $q->Where('email', $request->email);
            }
            if ($request->filled('mobile_no')) {
                $q->orWhere('mobile_no', $request->mobile_no);
            }
            if ($request->filled('aadhar_no')) {
                $q->orWhere('aadhar_no', $request->aadhar_no);
            }
            if ($request->filled('pan_no')) {
                $q->orWhere('pan_no', $request->pan_no);
            }
        })->first();

        return $check_member;
    }

    public function exportUsers(Request $request)
    {

        return Excel::download(new UsersExport($request->role,$request->provider), 'users.xlsx');
    }

}
