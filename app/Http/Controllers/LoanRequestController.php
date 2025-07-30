<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan_request;
use App\Models\Kyc;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Http\Middleware\JwtMiddleware;
use App\Models\User;
use App\Models\Loan;
use App\Helpers\Global_helper as GlobalHelper;

use DB;
class LoanRequestController extends Controller
{
    //

    public function create_loan_request(Request $request)
    {
        if ($request->bearerToken()) {

           try {
              $decoded = JWT::decode($request->bearerToken(), new Key(env('JWT_SECRET'), 'HS256'));
              $request->auth = $decoded;
              $request->user = User::find($decoded->sub);

              if(!$this->CheckToken($request->user->id,$request->bearerToken())) {
                return response()->json([
                    'status' => 'error',
                   'message' => 'Token is invalid or expired'
                  ],401);
              }
           }
           catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid or expired'
              ], 401);
        }
       }
        $request->validate([
            'mobile' => 'required',
            'loan_amount' => 'required',
            'email' => 'required',
            'name'  => 'required',
            'zip_code' => 'required|digits:6|numeric',
        ]);

        $loan_request = new Loan_request();
        $loan_request->name = $request->name;
        $loan_request->mobile = $request->mobile;
        $loan_request->email = $request->email;
        $loan_request->loan_amount = $request->loan_amount;
        $loan_request->reason_of_loan = $request->reason_of_loan;
        $loan_request->zip_code = $request->zip_code;
        
        if($request->user)
        {

            $loan_request->user_id = $request->user->id;
            $loan_request->referal_name = $request->user->name;
            $loan_request->referal_mobile = $request->user->mobile_no;
        }
        $token = $this->createJwtToken($request->all());
        $loan_request->token = $token;
        if($loan_request->save())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Loan request created successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
               'message' => 'Failed to create loan request'
            ], 500);
        }
    }

    private function createJwtToken($lead_info)
    {
        $key = env('JWT_SECRET');  // Secret key
        $payload = [
            'iss' => "loan-request", // Issuer of the token
            'sub' => $lead_info,           // Subject of the token (user ID)
            'iat' => time(),              // Issued at time
            'exp' => time() + 60*60       // Expiration time (1 hour)
        ];

        // Encode the token
        return JWT::encode($payload, $key, 'HS256');
    }

    public function CheckToken($user_id,$token)
    {
        $checkToken = DB::table('tbl_token')
            ->where('user_id', $user_id)
            ->where('token', $token)
            ->where('status', 1)
            ->first();
        if($checkToken)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function loan_request_list(Request $request)
    {

        $loan_requests = Loan_request::where('status',1);
        if($request->loan_status)
        {
            $loan_requests->where('loan_status',$request->loan_status);
        }
        if($request->name)
        {
            $loan_requests->where('name','like',"%$request->name%");
        }
        if($request->mobile)
        {
            $loan_requests->where('mobile','like',"%$request->mobile%");
        }
        if($request->email)
        {
            $loan_requests->where('email','like',"%$request->email%");
        }
        if($request->loan_amount)
        {
            $loan_requests->where('loan_amount','like',"%$request->loan_amount%");
        }
        if($request->user->role_id != 1)
        {
            $loan_requests->where('user_id',$request->user->id);
        }
        $get_loan_list = $loan_requests->get();
        if($get_loan_list)
        {
        return response()->json([
            'status' => 'success',
           'message' => 'Loan request list',
            'data' => $get_loan_list
        ], 200);
       }
       else
       {
         return response()->json([
            'status' => 'error',
           'message' => 'No loan request found'
        ], 404);
       }

    }


    public function create_loan(Request $request){

        $request->validate([
            'loan_request_id' =>'required',
            'amount' =>'required',
            'rate_of_interest' =>'required',
            'frequency' =>'required',
            'tenure' =>'required'
        ]);
        $check_kyc = $this->get_kyc_details($request->loan_request_id);
        if(!$check_kyc)
        {
            return response()->json([
               'status' => 'error',
               'message' => 'KYC details not found'
            ], 401);
        }
        else
        {
            if($check_kyc->kyc_status != 4)
            {
                return response()->json([
                   'status' => 'error',
                   'message' => 'KYC verification pending'
                ], 401);
            }
        }
        $loan_request = Loan_request::find($request->loan_request_id);
        $getRoute = $this->getRoute($loan_request->zip_code);
        if(!$getRoute)
        {
            return response()->json([
               'status' => 'error',
               'message' => 'Invalid zip code'
            ], 400);
        }
        $loan_details = Loan::where('status',3)->orderBy('id', 'desc')->first();
        $checkLoanRequest =  Loan::where('loan_request_id',$request->loan_request_id)->orderBy('id', 'desc')->first();
        if($checkLoanRequest)
        {
            return response()->json([
               'status' => 'error',
               'message' => 'Loan request already processed'
            ], 401);
        }
        $loan_number = ($loan_details) ? $loan_details->loan_number + 1 : 110000000001;
        if($loan_request)
        {
             $loan = Loan::insert([
                'loan_request_id' => $request->loan_request_id,
                'route_id' => $getRoute->route_id,
                'amount' => $request->amount,
                'loan_number' => $loan_number,
                'rate_of_interest' => $request->rate_of_interest,
                'frequency' => $request->frequency,
                'tenure' => $request->tenure,
                'process_charge' => $request->process_charge,
                'file_charge' => $request->file_charge,
                'other_charges_1' => $request->other_charges_1,
                'other_charges_2' => $request->other_charges_2,
                'other_charges_3' => $request->other_charges_3,
                'other_charges_4' => $request->other_charges_4,
                'other_charges_5' => $request->other_charges_5,
                'created_at' => now()
             ]);
             if($loan)
             {
                return response()->json([
                   'status' =>'success',
                   'message' => 'Loan created successfully.Please wait untill admin disbrused the loan amount'
                ], 200);
             }
        }
        else
        {
            return response()->json([
               'status' => 'error',
               'message' => 'Loan request not found'
            ], 401);
        }
    }

    public function loan_list(Request $request)
    {
        $loan_status = $request->loan_status;
        $loan_request_id = $request->loan_request_id;
        $loan_id  = $request->id;
        $loan_number = $request->loan_number;

        $loan_request= Loan::where('status',1);
        if($loan_status)
        {
            $loan_request->where('loan_status', $loan_status);
        }
        if($loan_request_id)
        {
            $loan_request->where('loan_request_id', $loan_request_id);
        }
        if($loan_id)
        {
            $loan_request->where('id', $loan_id);
        }
        if($loan_number)
        {
            $loan_request->where('loan_number', $loan_number);
        }

        $list = $loan_request->get();
        if($list)
        {
        return response()->json([
           'status' =>'success',
           'message' => 'Loan list',
            'data' => $list
        ], 200);
       }
       else
       {
         return response()->json([
            'status' => 'error',
           'message' => 'No loan found'
        ], 404);
       }
    }

    public function loan_approval(Request $request)
    {
        if($request->user->role_id!=1)
       {
        return response()->json([
            'status' => 'error',
           'message' => 'You Dont have permission to view loan request list'
        ], 401);
       }
        $request->validate([
            'loan_id' =>'required',
            'loan_status' =>'required',
            'loan_start_date' =>'required'
        ]);
        $loan_id = $request->loan_id;
        $loan_status = $request->loan_status;
        $loan_start_date = $request->loan_start_date;
        $loan = Loan::find($loan_id);
        $kyc_details = $this->get_kyc_details($loan->loan_request_id);
        if(!$kyc_details)
        {
            return response()->json([
               'status' => 'error',
               'message' => 'KYC details not found for this loan'
            ], 401);
        }
        else
        {
            if($kyc_details->kyc_status != 4)
            {
                return response()->json([
                   'status' => 'error',
                   'message' => 'KYC is not approved for this loan'
                ], 401);
            }
        }
        if($loan)
        {
            $loan_request = Loan_request::find($loan->loan_request_id);
            if($loan_status == 3)
            {
            $disbrused_amount = $loan->amount - ($loan->file_charge + $loan->other_charges_1 + $loan->other_charges_2 + $loan->other_charges_3 + $loan->other_charges_4 + $loan->other_charges_5);

            $emiData = GlobalHelper::calculateEMI($loan->amount, $loan->rate_of_interest, $loan->tenure);
            $emi_amount = "";
            switch($loan->frequency)
            {
                case 1 : $emi_amount = $emiData['daily_emi'];
                break;
                case 2 : $emi_amount = $emiData['weekly_emi'];
                break;
                case 3 : $emi_amount = $emiData['monthly_emi'];
                break;
            }
            // $users_details = User::where('aadhar_no', $kyc_details->aadhar_no)->where('status',1)->first();

            $users_details = User::where(function($query) use ($kyc_details, $loan_request) {
                $query->where('aadhar_no', $kyc_details->aadhar_no)
                      ->orWhere('mobile_no', $loan_request->mobile)
                      ->orWhere('email', $loan_request->email);
            })
            ->where('status', 1)
            ->first();

            $loan->disbrused_amount = $disbrused_amount;
            $loan->pending_amount   = number_format((floatval(str_replace(',','',$emi_amount)) * floatval($loan->tenure)),2);
            $loan->emi_amount   = $emi_amount;
            $loan->loan_start_date  = $loan_start_date;
            $loan->loan_status = $loan_status;
            $loan->save();

            if($users_details)
            {
                $user_record = User::find($users_details->id);
            }
            else
            {
                $user_record = new User();
            }
            $user_record->aadhar_no = (@$users_details->aadhar_no) ? $users_details->aadhar_no :  $kyc_details->aadhar_no;
            $user_record->mobile_no = (@$users_details) ?  $users_details->mobile_no : $loan_request->mobile;
            $user_record->name = ($loan_request->name) ? $loan_request->name : @$users_details->name;
            $user_record->email = (@$users_details->email) ? $users_details->email : $loan_request->email;
            $user_record->role_id = 4;
            $user_record->save();
            $insertedId = $user_record->id;
            $loan->user_id = $insertedId;
            $loan->route_id = $routes->route_id;
            }


            $loan_request->status = 5;
            $loan_request->save();
            $message = "";
            switch($loan_status)
            {
                case 1 : $message = "Loan status is pending.";
                break;
                case 2 : $message =  "Loan status is Approvad but not disbursed.";
                break;
                case 3 : $message =  "Congratulations. you have successfully disbrused the loan.";
                break;
                case 4 : $message =  "Loan status is rejected.";
                break;
            }
            return response()->json([
               'status' =>'success',
               'message' => $message
            ], 200);
        }
        else
        {
            return response()->json([
               'status' => 'error',
               'message' => 'Loan not found'
            ], 200);
        }
    }

    public function get_kyc_details($loan_request_id)
    {
        $kyc_details = Kyc::where('loan_request_id',$loan_request_id)
                           ->where('status',1)
                           ->orderBy('id', 'DESC')
                           ->first();
        if($kyc_details)
        {
            return $kyc_details;
        }

            return false;
    }

    public function getRoute($zipcode)
    {
        $getZipcode = DB::table('routezips')->where('zip_code',$zipcode)->where('status',1)->first();
        if($getZipcode)
        {
            return $getZipcode;
        }
        return false;
    }

}
