<?php

namespace App\Http\Controllers;

use App\Exports\LeadExport;
use App\Exports\EncExport;
use DB;
use Illuminate\Http\Request;
use App\Models\Loan_request;
use App\Models\Member;
use App\Helpers\Global_helper as GlobalHelper;
use App\Models\Providers;
use App\Models\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use Maatwebsite\Excel\Facades\Excel;
use NunoMaduro\Collision\Provider;

class LeadController extends Controller
{

   public function index()
{
    $title = "Lead List";
    $login_user_id = Auth::user()->id;
    $login_role_id = Auth::user()->role_id;

    $get_assign_log = DB::table('assign_lead')->where('assign_user_id', $login_user_id)->where('status',1)->get();

    $merged = [];
    foreach ($get_assign_log as $item) {
        if (!isset($merged[$item->lead_id])) {
            $merged[$item->lead_id] = [
                'lead_id' => $item->lead_id,
                'assign_user_ids' => [],
                'created_at' => $item->created_at
            ];
        }
        $merged[$item->lead_id]['assign_user_ids'][] = $item->assign_user_id;
    }

    $assin_users_id = [];
    foreach ($merged as $get_assign_id) {
        $assin_users_id[] = $get_assign_id['lead_id'];
    }

    // $assin_users_id is now an array
    $query = DB::table('loan_requests')
        ->leftJoin('users', 'loan_requests.created_user_id', '=', 'users.id')
        ->leftJoin('routes', 'loan_requests.service_id', '=', 'routes.id')
        ->select('loan_requests.*', 'users.name as username', 'routes.title as service')
        ->where('loan_requests.status', '!=', '3')
        ->where('loan_requests.loan_status', '<=', '5');

    if ($login_role_id != 1) {
        $query->whereIn('loan_requests.id', $assin_users_id); // Pass the array here
    }

    $alllead = $query->orderBy('loan_requests.id', 'desc')->get();
    // $get_user = User::where('status', 1)
    //     ->where('role_id', '!=', 1)
    //     ->where('is_user_verified', 1)
    //     ->get();

    $get_user = DB::table('users as a')
    ->join('roles as b', 'a.role_id', '=', 'b.id')
    ->leftJoin('providers as c', 'c.id', '=', 'a.provider_id')
    ->select('a.*', 'b.title as role_name', 'c.title as provider_title')
    ->where('a.status', 1)
    ->where('a.role_id', '!=', 1)
    ->where('a.role_id', '!=', 6)
    ->where('a.is_user_verified', 1)
    ->where('b.status', 1)
    ->get();


    return view('lead.index', compact('title', 'alllead', 'get_user'));
}

    public function qualified_leads()
    {
        $title = "Lead List";
        $login_user_id = Auth::user()->id;
        $login_role_id = Auth::user()->role_id;
        $query = DB::table('loan_requests')
            ->leftJoin('users', 'loan_requests.created_user_id', '=', 'users.id')
            ->leftJoin('routes', 'loan_requests.service_id', '=', 'routes.id')
            ->select('loan_requests.*', 'users.name as username', 'routes.title as service')
            ->where('loan_requests.status', '!=', '3')
            ->where('loan_requests.loan_status', '=', 6);
        if ($login_role_id != 1) {
            $query->where('loan_requests.user_id', $login_user_id);
        }
        $alllead = $query->orderBy('loan_requests.id', 'desc')->get();
        $get_user = User::where('status',1)->where('role_id','!=',1)->get();

        return view('lead.qualified_leads', compact('title', 'alllead','get_user'));
    }

    public function rejected()
    {
        $title = "Lead List";
        $login_user_id = Auth::user()->id;
        $login_role_id = Auth::user()->role_id;
        $query = DB::table('loan_requests')
            ->leftJoin('users', 'loan_requests.created_user_id', '=', 'users.id')
            ->leftJoin('routes', 'loan_requests.service_id', '=', 'routes.id')
            ->select('loan_requests.*', 'users.name as username', 'routes.title as service')
            ->where('loan_requests.status', '!=', '3')
            ->where('loan_requests.loan_status', '=', 7);
        if ($login_role_id != 1) {
            $query->where('loan_requests.user_id', $login_user_id);
        }
        // $get_user = User::where('status',1)->where('role_id','!=',1)->get();
        $get_user = DB::table('users as a')
        ->join('roles as b', 'a.role_id', '=', 'b.id')
        ->leftJoin('providers as c', 'c.id', '=', 'a.provider_id')
        ->select('a.*', 'b.title as role_name', 'c.title as provider_title')
        ->where('a.status', 1)
        ->where('a.role_id', '!=', 1)
        ->where('a.role_id', '!=', 6)
        ->where('a.is_user_verified', 1)
        ->where('b.status', 1)
        ->get();

        $alllead = $query->orderBy('loan_requests.id', 'desc')->get();
        return view('lead.rejected', compact('title', 'alllead','get_user'));
    }



    public function create(Request $request)
    {

        if ($request->method() == 'POST') {

            $request->validate([
                'service_id' => 'required',
                'full_name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'loan_amount' => 'required|int',
                'address' => 'required|string|max:255',
                'state' => 'required|string|max:100',
                'district_name' => 'required|string|max:100',
                'tehsil_taluka' => 'required|string|max:100',
                'pin_code' => 'required|digits:6', // Exactly 6 digits
                'income' => 'required|numeric',
                'income_proof_name' => 'required|string|max:255',
                'business_address' => 'required|string|max:255',
                'business_state' => 'required|string|max:100',
                'business_district' => 'required|string|max:100',
                'business_tehsil' => 'required|string|max:100',
                'business_pin_code' => 'required|digits:6', // Exactly 6 digits
                'business_mobile_no' => 'required|digits:10|integer', // Exactly 10 digits and integer
                'remark' => 'nullable|string|max:500',
                'aadhar_front_doc' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'aadhar_back_doc' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'pan_card_doc' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'voter_id_doc' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'cibil_score' => 'required',
                'cibil_doc_upload' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',

            ]);
            $duplicate_record = Loan_request::where('business_mobile_no',$request->business_mobile_no)->first();
            $user_id = Auth::user()->id;
            // Save data to the database
            $lead = new Loan_request();
            $lead->user_id = $user_id;
            $lead->created_user_id = $user_id;
            $lead->service_id = $request->service_id;
            $lead->full_name = $request->full_name;
            $lead->father_name = $request->father_name;
            $lead->date_of_birth = $request->date_of_birth;
            $lead->residence_address = $request->address;
            $lead->state_name = $request->state;
            $lead->district_name = $request->district_name;
            $lead->tehsil_taluka = $request->tehsil_taluka;
            if($request->loan_amount){
                $lead->loan_amount = $request->loan_amount;
            }
            $lead->pin_code = $request->pin_code;
            $lead->income = $request->income;
            $lead->res_lat = $request->res_lat;
            $lead->res_long = $request->res_long;
            $lead->business_lat = $request->business_lat;
            $lead->business_long = $request->business_long;
            $lead->income_proof_name = $request->income_proof_name;
            $lead->business_address = $request->business_address;
            $lead->business_state = $request->business_state;
            $lead->business_district = $request->business_district;
            $lead->business_tehsil = $request->business_tehsil;
            $lead->business_pin_code = $request->business_pin_code;
            $lead->business_mobile_no = $request->business_mobile_no;
            $lead->cibil_score = $request->cibil_score;
            $lead->remark = $request->remark;
            if($duplicate_record){
                $lead->is_lead_duplicate = 1;
            }else{
                $lead->is_lead_duplicate = 0;
            }
            // Handle file uploads
            if ($request->hasFile('aadhar_front_doc')) {
                $lead->aadhar_front_docs = $request->file('aadhar_front_doc')->store('uploads/docs', 'public');
            }
            if ($request->hasFile('aadhar_back_doc')) {
                $lead->aadhar_back_docs = $request->file('aadhar_back_doc')->store('uploads/docs', 'public');
            }
            if ($request->hasFile('pan_card_doc')) {
                $lead->pan_card_docs = $request->file('pan_card_doc')->store('uploads/docs', 'public');
            }
            if ($request->hasFile('voter_id_doc')) {
                $lead->voter_card_docs = $request->file('voter_id_doc')->store('uploads/docs', 'public');
            }
            if ($request->hasFile('cibil_doc_upload')) {
                $lead->cibil_doc_upload = $request->file('cibil_doc_upload')->store('uploads/docs', 'public');
            }

            $lead->save();
            $insert_id = $lead->id;
            DB::table('notes')->insert(['loan_request_id' => $insert_id, 'user_id' => $user_id, 'loan_status' => 1, 'title' => "Create Lead"]);
             DB::table('assign_lead')->insert([
                'lead_id' => $insert_id,
                'current_user_id' => $user_id,
                'assign_user_id' => $user_id
            ]);
            return redirect()->route('lead')->with('success', 'Lead Added Successfully');
        }
        $title = "Add Lead";
        $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
        $get_service = Route::where('status', 1)->get();
        $get_user = Member::where('status', 1)->get();
        return view('lead.create', compact('title', 'get_user','get_service','states'));
    }

    public function edit($id)
    {
        $title = "Edit Lead";
        $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
        $get_lead = Loan_request::where('status', '!=', 3)->where('id', $id)->first();
        $get_user = Member::where('status', 1)->where('id', '!=', 1)->get();
        return view('lead.create', compact('title', 'get_lead', 'get_user','states'));
    }

    public function view($id)
    {

        $user_id = Auth::user()->id;
        $get_note = DB::table('notes')->where('loan_request_id', $id)->where('title', 'View Lead')->where('user_id', $user_id)->where('status',1)->first();

        if (!$get_note) {
            DB::table('notes')->insert(['loan_request_id' => $id, 'user_id' => $user_id, 'loan_status' => 2, 'title' => "View Lead"]);
            Loan_request::where('id', $id)->update(['loan_status' => 2]);
        }
        $title = "View Lead";
        $get_lead = DB::table('loan_requests')->join('users', 'loan_requests.user_id', '=', 'users.id')->leftJoin('routes','loan_requests.service_id','=','routes.id')->select('loan_requests.*', 'users.name as username','routes.title as service')->where('loan_requests.status', '!=', '3')->where('loan_requests.id',$id)->orderBy('loan_requests.id', 'desc')->first();
        $get_providers = Providers::where('status',1)->get();
        $get_assign_id = DB::table('assign_lead')->where('lead_id',$id)->orderBy('id', 'desc')->limit(1)->first();

        return view('lead.view', compact('title', 'get_lead','get_providers','get_assign_id'));
    }

    public function kyclead_view($id)
    {
        $title = "Kyc Lead View";
        $get_lead = DB::table('kyc_leads')
            ->leftJoin('users', 'kyc_leads.user_id', '=', 'users.id')
            ->leftJoin('users as b', 'kyc_leads.agent_id', '=', 'b.id')
            ->leftJoin('routes', 'routes.id', '=', 'kyc_leads.route_id')
            ->leftJoin('kyc_leads_guarantor', 'kyc_leads_guarantor.kyc_id', '=', 'kyc_leads.id')
            ->leftJoin('loan_requests', 'kyc_leads.loan_request_id', '=', 'loan_requests.id')
            ->select(
                'kyc_leads.*',
                'users.name as username',
                'b.name as agent_name',
                'routes.route as route_no',
                'loan_requests.name as lead_name',
                'loan_requests.email as lead_email',
                'loan_requests.mobile as lead_mobile',
                'loan_requests.loan_amount as lead_loan_amount',
                'loan_requests.address as lead_address',
                'loan_requests.zip_code as lead_zip_code',
                'loan_requests.reason_of_loan as lead_reason_of_loan',
                'kyc_leads_guarantor.id as guarantor_id',
                'kyc_leads_guarantor.kyc_id as guarantor_kyc_id',
                'kyc_leads_guarantor.name as guarantor_name',
                'kyc_leads_guarantor.son_of as guarantor_son_of',
                'kyc_leads_guarantor.type_of_work as guarantor_type_of_work',
                'kyc_leads_guarantor.shop_address as guarantor_shop_address',
                'kyc_leads_guarantor.shop_type as guarantor_shop_type',
                'kyc_leads_guarantor.mobile_no_1 as guarantor_mobile_no_1',
                'kyc_leads_guarantor.mobile_no_2 as guarantor_mobile_no_2',
                'kyc_leads_guarantor.home_address as guarantor_home_address',
                'kyc_leads_guarantor.land_load as guarantor_land_load'
            )
            ->where('kyc_leads.status', '!=', '3')
            ->where('kyc_leads.id', $id)
            ->orderBy('kyc_leads.id', 'desc')
            ->get();


        return view('lead.kycview', compact('title', 'get_lead'));
    }

    public function update(Request $request)
    {





        if ($request->loan_status == "approved") {
            $request->validate([
                'name' => 'required|string|max:255',
                'reason_of_loan' => 'required|string|max:500',
                'loan_amount' => 'required',
                'user_id' => 'required',
                'address' => 'required|string|max:500',
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
                ],
                'mobile' => [
                    'required',
                    'regex:/^[6-9]\d{9}$/'
                ],
                'zip_code' => [
                    'required',
                    'regex:/^\d{6}$/'
                ],
                'frequency' => 'required',
                'rate_of_interest' => 'required|integer',
                'tenure' => 'required|integer',
                'process_charge' => 'required|integer',
                'file_charge' => 'required|integer',
                'other_charges_1' => 'required|integer',
                'other_charges_2' => 'required|integer',
                'other_charges_3' => 'required|integer',
                'other_charges_4' => 'required|integer',
                'other_charges_5' => 'required|integer',
                'start_date' => 'required'
            ]);
        }


        if ($request->loan_status != "approved") {
            $request->validate([
                'name' => 'required|string|max:255',
                'reason_of_loan' => 'required|string|max:500',
                'loan_amount' => 'required',
                'user_id' => 'required',
                'address' => 'required|string|max:500',
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
                ],
                'mobile' => [
                    'required',
                    'regex:/^[6-9]\d{9}$/'
                ],
                'zip_code' => [
                    'required',
                    'regex:/^\d{6}$/'
                ],
            ]);
        }

        $lead = Loan_request::findOrFail($request->hidden_id);
        $lead->user_id = $request->user_id;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->mobile = $request->mobile;
        if ($request->loan_status == "approved") {
            $lead->loan_status = 5;
        }
        $lead->loan_amount = $request->loan_amount;
        $lead->reason_of_loan = $request->reason_of_loan;
        $lead->zip_code = $request->zip_code;
        $lead->address = $request->address;
        $lead->save();
        $genrate_loan_number = rand(9999999999, 0000000000);
        if ($request->loan_status == "approved") {

            $insertedId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'aadhar_no' => $lead->aadhar_no,
                'mobile_no' => $request->mobile,
                'role_id' => 4
            ]);

            $disbrused_amount = $request->loan_amount - ($request->file_charge + $request->other_charges_1 + $request->other_charges_2 + $request->other_charges_3 + $request->other_charges_4 + $request->other_charges_5);
            $emiData = GlobalHelper::calculateEMI($request->loan_amount, $request->rate_of_interest, $request->tenure);
            $emi_amount = "";
            switch ($request->frequency) {
                case '1':
                    $emi_amount = $emiData['daily_emi'];
                    break;
                case '2':
                    $emi_amount = $emiData['weekly_emi'];
                    break;
                case '3':
                    $emi_amount = $emiData['monthly_emi'];
                    break;
            }
            $disbrused_amount_ = $disbrused_amount;
            $pending_amount   = number_format((floatval(str_replace(',', '', $emi_amount)) * floatval($request->tenure)), 2);
            $emi_amount_   = $emi_amount;
            $loan_start_date  = date('Y-m-d', strtotime($request->start_date));
            // echo $loan_start_date; die;

            DB::table('loans')->insert([
                'loan_request_id' => $request->hidden_id,
                'user_id' => $insertedId,
                'loan_number' => $genrate_loan_number,
                'amount' => $request->loan_amount,
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
                'disbrused_amount' => $disbrused_amount_,
                'pending_amount' => $pending_amount,
                'emi_amount' => $emi_amount_,
                'loan_start_date' => $loan_start_date,
                'loan_status' => 2,
            ]);
        }

        return redirect()->route('lead')->with('success', 'Lead Update Successfully');
    }


    public function destroy($id)
    {
        $lead = Loan_request::findOrFail($id);
        $lead->status = 3;
        $lead->update();
        return redirect()->route('lead')->with('success', 'Lead deleted successfully.');
    }

    public function viewright_modal(Request $request)
    {
        $lead_id = $request->lead_id;

        // Fetching notes with users
        $notes = DB::table('notes')
        ->leftJoin('users', 'notes.user_id', '=', 'users.id')
        ->leftJoin('roles','users.role_id','=','roles.id')
        ->leftJoin('providers','providers.id','=','notes.provider_id')
        ->select('notes.*', 'users.name as username','roles.title as role_name','providers.title as provider_title')
        ->where('notes.loan_request_id', $lead_id)
        ->where('notes.status', 1)
        // ->where('roles.status',1)
        // ->where('users.status',1)
        // ->where('providers.status',1)
        ->orderBy('notes.id', 'asc')
        ->get();
    // dd($notes);

        $html = ''; // Initialize the HTML variable

        if (!empty($notes)) {
            foreach ($notes as $note) {
                // Switch for loan status
                switch ($note->loan_status) {
                    case 1:
                               $loan_status = "Pending";
                               $class = "warning";
                               $added_by = "Created By";
                               break;
                           case 2:
                               $loan_status = "View";
                               $class = "primary";
                               $added_by = "Viewed By";
                               break;
                           case 3:
                               $loan_status = "Under Processing";
                               $class = "secondary";
                               $added_by = "Processing By";
                               break;

                           case 4:
                               $loan_status = "Move to Lender";
                               $class = "dark";
                               $added_by = "Move to Lende By";
                               break;

                           case 5:
                               $loan_status = "Sanction";
                               $class = "info";
                               $added_by = "Sanction By";
                               break;

                           case 6:
                               $loan_status = "Disbursed";
                               $added_by = "Disbursed By";
                               $class = "success";
                               break;
                           case 7:
                               $loan_status = "Rejected";
                               $added_by = "Rejected By";
                               $class = "danger"; // Corrected typo "dangeer"
                               break;
                           case 8:
                               $loan_status = "Assign";
                               $class = "success"; // Corrected typo "dangeer"
                               $added_by = "Assign By";
                               break;
                           default:
                               $loan_status = "Unknown";
                               $class = "light";
                               $added_by = " ";
                               break;
                   }

                // Build HTML for each note using the new structure with loan status badge
                $html .= '
            <div class="status submitted">
                <div class="status-dot"></div>
                <div class="status-text">
                    <strong>Title: ' . htmlspecialchars($note->title) . '</strong><br>
                    <strong>Provider: ' . htmlspecialchars($note->provider_title) . '</strong><br>
                    <small>' . str_replace('By', ' ', $added_by) . ' At : ' . date('d F Y h:i A', strtotime($note->created_at)) . '</small><br>
                    <small>' . $added_by . '  : ' . ucwords(htmlspecialchars($note->username)) . ' (' . $note->role_name . ')' . '</small><br>
                    <small>Lead Status :
                        <span class="badge bg-' . $class . ' rounded-pill">' . htmlspecialchars(str_replace('_', ' ', $loan_status)) . '</span>
                    </small>
                </div>
            </div>';
            }
        }

        echo $html; // Output the generated HTML
    }

    public function kyc_process(Request $request)
    {

        if ($request->kyc_status == 4) {
            $insert_reason = DB::table('kyc_reject_reasons')->insert([
                'kyc_id' => $request->hidden_id,
                'reason' => $request->reason,
            ]);
            DB::table('kyc_leads')->where('id', $request->hidden_id)->update(['kyc_status' => $request->kyc_status]);
            if ($insert_reason) {
                return redirect()->route('kyclead.view', ['id' => $request->hidden_id]);
            }
        } else {
            $lead = DB::table('kyc_leads')->where('id', $request->hidden_id)->first();

            if ($request->kyc_status == 3) {
                $request->validate([
                    'frequency' => 'required',
                    'rate_of_interest' => 'required|integer',
                    'tenure' => 'required|integer',
                    'process_charge' => 'required|integer',
                    'file_charge' => 'required|integer',
                    'other_charges_1' => 'required|integer',
                    'other_charges_2' => 'required|integer',
                    'other_charges_3' => 'required|integer',
                    'other_charges_4' => 'required|integer',
                    'other_charges_5' => 'required|integer',
                    'start_date' => 'required'
                ]);
            }

            if ($request->kyc_status == 3) {
                $check_exist_user = DB::table('users')->where('aadhar_no', $lead->aadhar_no)->orWhere('mobile_no', $lead->mobile_no)->first();
                if ($check_exist_user) {
                    $insertedId = $check_exist_user->id;
                }else{
                    $insertedId = DB::table('users')->insertGetId([
                        'name' => $lead->customer_name,
                        'aadhar_no' => $lead->aadhar_no,
                        'mobile_no' => $lead->mobile_no,
                        'role_id' => 4
                    ]);
                }
                $disbrused_amount = $lead->loan_amount - ($request->file_charge + $request->other_charges_1 + $request->other_charges_2 + $request->other_charges_3 + $request->other_charges_4 + $request->other_charges_5);
                $emiData = GlobalHelper::calculateEMI($lead->loan_amount, $request->rate_of_interest, $request->tenure);
                $emi_amount = "";
                switch ($request->frequency) {
                    case '1':
                        $emi_amount = $emiData['daily_emi'];
                        break;
                    case '2':
                        $emi_amount = $emiData['weekly_emi'];
                        break;
                    case '3':
                        $emi_amount = $emiData['monthly_emi'];
                        break;
                }
                $disbrused_amount_ = $disbrused_amount;
                $pending_amount   = number_format((floatval(str_replace(',', '', $emi_amount)) * floatval($request->tenure)), 2);
                $emi_amount_   = $emi_amount;
                $loan_start_date  = date('Y-m-d', strtotime($request->start_date));
                // echo $loan_start_date; die;
                $genrate_loan_number = rand(999999999999, 000000000000);

                DB::table('loans')->insert([
                    'kyc_id' => $request->hidden_id,
                    'user_id' => $insertedId,
                    'route_id' => $lead->route_id,
                    'loan_number' => $genrate_loan_number,
                    'amount' => $lead->loan_amount,
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
                    'disbrused_amount' => $disbrused_amount_,
                    'pending_amount' => $pending_amount,
                    'emi_amount' => $emi_amount_,
                    'loan_start_date' => $loan_start_date,
                    'loan_status' => 2,
                ]);

                DB::table('kyc_leads')->where('id', $request->hidden_id)->update(['kyc_status' => $request->kyc_status]);
                return redirect()->route('kyclead.view', ['id' => $request->hidden_id])->with('success','kyc successfully updated');
            }
        }
    }

    public function assign_lead(Request $request) {
       if($request->rejected == 1){
        DB::table('assign_lead')->where('lead_id',$request->lead_id)->update(['status' => 3]);
        DB::table('notes')->where('loan_request_id',$request->lead_id)->update(['status' => 3]);
       }
        $lead_id = $request->lead_id;
        $current_user_id = $request->current_user_id;
        $assign_user_id = $request->assign_user_id;
        $check_duplicate = DB::table('assign_lead')->where('lead_id',$lead_id)->where('assign_user_id',$assign_user_id)->where('status',1)->first();
        if($check_duplicate){
            echo 1; die;
        }
        $insert_log = DB::table('assign_lead')->insert([
            'lead_id' => $lead_id,
            'current_user_id' => $current_user_id,
            'assign_user_id' => $assign_user_id
        ]);
        $get_assing_user = DB::table('users')->where('id',$assign_user_id)->where('status',1)->first();
        $insert_notes = DB::table('notes')->insert([
            'loan_request_id' => $lead_id,
            'user_id' => $current_user_id,
            'loan_status' => 8,
            'title' => 'Lead Assign To ' .$get_assing_user->name.''

        ]);
        $update_lead_status  = DB::table('loan_requests')->where('id',$lead_id)->update(['loan_status'=>3]);
        $update_user_id = DB::table('loan_requests')
        ->where('user_id', $current_user_id)
        ->where('id', $lead_id)
        ->update(['user_id' => $assign_user_id]);
        if ($insert_log) {
            return response()->json(['success' => true, 'message' => 'Lead assigned successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to assign lead']);
        }
    }

    public function exportLead(Request $request){
        return Excel::download(new LeadExport($request->loan_status), 'lead.xlsx');
    }
    
        public function exportEnc(Request $request){
        return Excel::download(new EncExport($request->status,$request->from_date,$request->to_date), 'enquiry.xlsx');
    }
    
    


}
