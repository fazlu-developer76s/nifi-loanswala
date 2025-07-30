<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan_request;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use DB;

class Home extends Controller
{
    //
    public function lead_create(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->otp) {
                $get_otp = DB::table('tbl_otp')->where('field_value', $request->mobile_no)->where('otp', $request->otp)->where('otp_type', 1)->where('module_type', 2)->where('status', 1)->first();
                if ($get_otp) {
                    $user_details = User::where('role_id', '=', 1)->orderBy('id', 'desc')->first();
                    $user_id = $user_details->id;
                    $lead = new Enquiry();
                    $lead->service_id = $request->service_id;
                    $lead->name = $request->full_name;
                    $lead->email = $request->email;
                    $lead->mobile = $request->mobile_no;
                    $lead->address = $request->address;
                    $lead->message = $request->message;
                    $lead->save();
                    $get_service = DB::table('routes')->where('id',$request->service_id)->first();
                    $lead_details = array(
                        'name' => $request->full_name,
                        'email' => $request->email,
                        'mobile' => $request->mobile_no,
                        'address' => $request->address,
                        'message' => $request->message,
                        'service_name' => $get_service->title,
                    );
                    Mail::to($request->email)->send(new OtpMail($lead_details));
                    $insert_id = $lead->id;
                    DB::table('notes')->insert(['loan_request_id' => $insert_id, 'user_id' => $user_id, 'loan_status' => 1, 'title' => "Create Lead"]);
                    DB::table('tbl_otp')->where('id', $get_otp->id)->update(['status' => 2]);
                    return redirect()->route('front.home')->with('success', 'Lead Added Successfully');
                } else {
                        DB::table('tbl_otp')->where('field_value', $request->mobile_no)->update(['status' => 2]);
                       return redirect()->route('front.home')->with('error', 'Invalid OTP');
                }
            }
            return view('home.home');
        }
    }
}
