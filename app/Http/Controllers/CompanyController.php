<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use DB;

class CompanyController extends Controller
{
    // Show the edit form
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    // Handle the update request
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:1024',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        // Find the company
        $company = Company::findOrFail($id);

        // Update the company's details
        $company->name = $request->name;

        if ($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            $company->favicon = $request->file('favicon')->store('favicons', 'public');
        }

        $company->address = $request->address;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->facebook = $request->facebook;
        $company->twitter = $request->twitter;
        $company->instagram = $request->instagram;
        $company->linkedin = $request->linkedin;

        // Save the updated company
        $company->save();

        // Redirect with success message
        return redirect()->route('company.edit', $company->id)
                         ->with('success', 'Company information updated successfully.');
    }

    public function enquiry(){
        $title = 'Enquiry List'   ;
        $alllead = DB::table('enquiry as a')->leftJoin('routes as b','a.service_id','=','b.id')->select('a.*','b.title as  service_name')->where('a.status',1)->orderBy('a.id','desc')->get();
        return view('company.enquiry', compact('alllead','title'));
    }

    public function send_otp(Request $request){
        if($otp = $this->userOTP($request->mobile_no))
        {

            $this->GenerateOTP($otp,$request->mobile_no);
            return response()->json([
                'status' => "OK",
                'message' => "Please Enter Otp to verify user",
                'data' => $request->all()
            ], 200);
        }
    }


    public function GenerateOTP($otp,$mobile_no)
    {
        $genrateOTP = DB::table('tbl_otp')->insert([
            'otp' => $otp,
            'module_type' => 2,
            'field_value' => $mobile_no,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if($genrateOTP)
        {
          return true;
        }
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
