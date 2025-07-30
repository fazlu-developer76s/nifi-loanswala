<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Global_helper as GlobalHelper;
use App\Services\PHPMailerService;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class SignupController extends Controller
{
    //
    protected $mailService;

    public function __construct(PHPMailerService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function signup(){

        return view('tutors.signup');
    }

    public function student_signup(Request $request)

    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mobile' => 'required|numeric|digits:10'
            ]
        );

        if ($request->otp) {
            $request->validate(
                [
                    'otp' => 'required|numeric|digits:4'
                ]
            );
            $otp = $request->otp;
            $id = $request->login_id;
            $module_type = 1;
            $otp_type = 2;
            $otp_details = $this->otpVerify($id, $otp, $otp_type, $module_type);

            if ($otp_details) {
                $current_time = Carbon::now();
                $otpTime = Carbon::parse($otp_details->created_at); // Convert to a Carbon instance
                if ($current_time->diffInMinutes($otpTime) > 10) {
                    return response()->json([
                        'status' => "Error",
                        'message' => "OTP is expired",
                        'data' => $request->all()
                    ]);
                } else {
                    GlobalHelper::ExpireOTP($id, $module_type, $otp_type);
                    $update_user_details = DB::table('users')
                        ->where('id', $id)
                        ->update(['email_verified_at' => date('Y-m-d H:i:s')]);
                    return response()->json(['success' => 'Registration successful!']);
                }
            }
        }
        $user = User::where('mobile_no', $request->mobile)->where('otp', $request->otp)->first();
        if ($user && Carbon::parse($user->otp_created_at)->addMinutes(15)->isPast()) {
            return response()->json(['error' => 'OTP expired!']);
        }
        $user->status = 1;
        $user->save();
        return response()->json(['success' => 'Registration successful!']);

        $users  = User::where(function ($query) use ($request) {
            $query->where('email', $request->email)
                ->orWhere('mobile_no', $request->mobile);
        })->where('status', 1)->get();

        if (sizeof($users)) {
            return response()->json(['error' => 'Email or mobile number already exists!']);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile;
        $user->role_id = 7; // student role id
        $user->password =  Hash::make($request->mobile);
        if ($user->save()) {
            $user_info = User::where('id', $user->id)->where('status', 1)->first();
            $module_type = 1;
            $otp_type = 2;
            if ($email_temp = GlobalHelper::GenerateEmailOTP($user_info, $module_type, $otp_type, $request->email)) {
                $this->mailService->sendEmail($email_temp['to'], $email_temp['subject'], $email_temp['body']);
                return response()->json(['success' => $user->id]);
            }
        }
        return response()->json(['error' => 'Registration failed!']);
    }


    public function tutors_signup(Request $request)

    {


        if ($request->otp) {
            $request->validate(
                [
                    'otp' => 'required|numeric|digits:4'
                ]
            );
            $otp = $request->otp;
            $id = $request->login_id;
            $module_type = 2;
            $otp_type = 1;
            $otp_details = $this->otpVerify($id, $otp, $otp_type, $module_type);

            if ($otp_details) {
                $current_time = Carbon::now();
                $otpTime = Carbon::parse($otp_details->created_at); // Convert to a Carbon instance
                if ($current_time->diffInMinutes($otpTime) > 10) {
                    return response()->json([
                        'status' => "error",
                        'message' => "OTP is expired",
                        'data' => $request->all()
                    ]);
                } else {

                    GlobalHelper::ExpireOTP($id, $module_type, $otp_type);
                    $update_user_details = DB::table('users')
                        ->where('id', $id)
                        ->update(['email_verified_at' => date('Y-m-d H:i:s')]);
                    DB::table('users')->where('id',$request->login_id)->update(['is_mobile_verified' => 1 ]);
                    return response()->json([
                        'status' => "success",
                        'message' => "Registration successfull!",
                        'data' => $request->all()
                    ]);
                }
            }else{
                return response()->json([
                    'status' => "error",
                    'message' => "Invalid OTP",
                    'data' => $request->all()
                ]);
            }
        } else {

            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'mobile' => 'required|numeric|digits:10'
                ]
            );

            $users  = User::where(function ($query) use ($request) {
                $query->where('email', $request->email)
                    ->orWhere('mobile_no', $request->mobile);
            })->where('status', 1)->get();

            if (sizeof($users)) {

                return response()->json([
                    'status' => "error",
                    'message' => "Email or mobile number already exists!",
                    'data' => $request->all()
                ]);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile;
            $user->role_id = "5"; // student role id
            $user->member_id = rand(100000, 999999);
            $user->password =  Hash::make($request->password);
            if ($user->save()) {
                $user_info = User::where('id', $user->id)->where('status', 1)->first();
                $module_type = 2;
                $otp_type = 1;
                $otp = rand(1000, 9999);
                // $otp = $this->userOTP($request->mobile);
                if (GlobalHelper::GenerateMobileOTP($user_info, $module_type, $otp_type,$otp, $request->mobile)) {
                    // $this->mailService->sendEmail($email_temp['to'], $email_temp['subject'], $email_temp['body']);

                    return response()->json([
                        'status' => "success",
                        'message' => "Verify Your Mobile No",
                        'data' => $user_info->id
                    ]);
                }
            }
            return response()->json([
                'status' => "error",
                'message' => "Registration failed!",
                'data' => $request->all()
            ]);
        }
    }

    public function otpVerify($user_id, $otp, $otp_type, $module_type)
    {
        $query = DB::table('tbl_otp')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->where('module_type', $module_type)
            ->where('otp_type', $otp_type)
            ->where('otp', $otp)
            ->orderBy('id', "desc")
            ->first();

        return $query;
    }

    public function user_login(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {

                session(['user_info' => $user]);
                return redirect()->route('user.profile')->with('success', 'Successfully logged in');
            } else {
                return redirect()->route('user.login')->with('error', 'Invalid username or password');
            }
        }

        return view('user-login');
    }

    public function userOTP($mobile_no)
{
    // Generate OTP
    $otp = rand(1000, 9999);

    // SMS API Integration
    $key = "8eeedfa2df46f6f6ed2a871aa2dcfa45";
    $route = 1;
    $sender = "KSPSPL";
    $template_id = "1707173512317691168";
    $sms = "$otp is OTP to authenticate your mobile number. Valid for 10 min only. Do not share with anyone. - For more information visit on www.loanswala.com -KSP SMART";

    $url = 'http://sms.dfyte.com/api/smsapi?' . http_build_query([
        'key'        => $key,
        'route'      => $route,
        'sender'     => $sender,
        'number'     => $mobile_no,
        'sms'        => $sms,
        'templateid' => $template_id
    ]);

    // Initialize cURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Error: $error";
    }

    // Close cURL
    curl_close($ch);

    // Return the OTP
    return $otp;
}

}
