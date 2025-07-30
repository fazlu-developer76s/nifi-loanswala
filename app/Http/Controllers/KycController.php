<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use App\Models\Loan_request;
use Illuminate\Http\Request;
use DB;

class KycController  extends Controller
{
    //
    public function user_kyc_request(Request $request)
    {
        $request->validate([
            'loan_request_id' => 'required',
            'aadhar_no' => 'required|digits:12|numeric|regex:/^[2-9]{1}[0-9]{11}$/',
            'pan_no' => 'required|size:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'
        ]);
        $loan_request_id = $request->loan_request_id;
        $aadhar_no = $request->aadhar_no;
        $pan_no = $request->pan_no;
        if ($request->user->role_id != 1) {
            return response()->json(['status' => 'error', 'message' => 'You are not authorized to kyc process.', 'data' => $request->all()], 401);
        }
        $loan_request = Loan_request::find($loan_request_id);
        if (!$loan_request) {
            return response()->json(['status' => 'error', 'message' => 'Loan request detail not found.', 'data' => $request->all()], 401);
        }
        $kyc = new Kyc;
        $kyc_status = Kyc::where('loan_request_id', $loan_request_id)->orderBy('id', 'desc')->first();
        if ($kyc_status) {
            $kyc = Kyc::find($kyc_status->id); // Retrieve the existing KYC by ID
        } else {
            $kyc = new Kyc();
        }
        $kyc->loan_request_id = $loan_request_id;
        $kyc->user_id = $request->user->id;
        $kyc->aadhar_no = $aadhar_no;
        $kyc->pan_no = $pan_no;
        if ($kyc->save()) {
            $loan_request->loan_status = 4;
            $loan_request->save();
            if ($kyc_status) {
                return response()->json(['status' => 'Success', 'message' => 'KYC request updated successfully.', 'data' => $request->all()], 200);
            } else {
                return response()->json(['status' => 'Success', 'message' => 'KYC request submitted successfully.', 'data' => $request->all()], 200);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'KYC request failed to submit.', 'data' => $request->all()], 401);
        }
    }

    public function kyc_request_list(Request $request)
    {
        if ($request->user->role_id != 1) {
            return response()->json(['status' => 'error', 'message' => 'You are not authorized to view kyc list.', 'data' => $request->all()], 401);
        }
        $kyc_list = Kyc::where('status', '<', 3);
        if ($request->user_id) {
            $kyc_list->where('user_id', $request->user_id);
        }
        if ($request->loan_request_id) {
            $kyc_list->where('loan_request_id', $request->loan_request_id);
        }
        $kyc_list->orderBy('id', 'desc');
        $kyc_data = $kyc_list->get();
        if ($kyc_data) {
            return response()->json(['status' => 'Success', 'message' => 'KYC list.', 'data' => $kyc_data], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No KYC found for this user.', 'data' => $request->all()], 401);
        }
    }

    public function kyc_approval(Request $request)
    {
        if ($request->user->role_id != 1) {
            return response()->json(['status' => 'error', 'message' => 'You are not authorized to approve KYC.', 'data' => $request->all()], 401);
        }
        $request->validate([
            'kyc_id' => 'required',
            'kyc_status' => 'required'
        ]);
        $kyc_id = $request->kyc_id;
        $kyc_status = $request->kyc_status;
        if ($kyc_status  > 5) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid status'
            ], 400);
        }
        $kyc = Kyc::find($kyc_id);
        if (!$kyc) {
            return response()->json(['status' => 'error', 'message' => 'KYC detail not found.', 'data' => $request->all()], 401);
        }
        $kyc->kyc_status = $kyc_status;
        if ($kyc->save()) {
            switch ($kyc_status) {
                case 1:
                    $message = "kyc status is pending updated successfully";
                    break;
                case 2:
                    $message = "kyc status is In Progress updated successfully";
                    break;
                case 3:
                    $message = "kyc status is Completed updated successfully";
                    break;
                case 4:
                    $message = "kyc status is Approved updated successfully";
                    break;
                case 5:
                    $message = "kyc status is Rejected updated successfully";
                    break;
            }
            return response()->json([
                'status' => 'success',
                'message' => $message
            ], 200);
        }
    }

    public function kyc_pending_list(Request $request)
    {

        $user_id = 2;
        $get_kyc_data = DB::table('assignroutes')
            ->leftJoin('kyc_leads', 'assignroutes.route_id', '=', 'kyc_leads.route_id')
            ->select('assignroutes.id as assign_id', 'kyc_leads.*')
            ->where('assignroutes.user_id', $user_id)
            ->get();
            if($get_kyc_data){
                return response()->json(['status' => 'Success', 'message' => 'KYC list.', 'data' => $get_kyc_data], 200);
            }else{
              return response()->json(['status' => 'error', 'message' => 'No data Found.', 'data' => $request->all()], 401);
            }
    }

    public function kyc_submit(Request $request){

        return response()->json($_POST);
    }
}
