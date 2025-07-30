<?php

namespace App\Http\Controllers;

use App\Models\Loan_request;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{

    public function create(Request $request)
    {


        if($request->hidden_id){
            $note_id = $request->hidden_id;
            $update_note = DB::table('notes')->where('id', $note_id)->update(['title' => $request->title]);
            if ($update_note) {
                return response()->json(['message' => 'Note updated successfully.'], 200);
            }
        }
        $user_id = $request->user_id;
        $lead_id = $request->lead_id;
        $status = $request->status;
        $title = $request->title;
        $provider_id = $request->provider_id;
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filePath = $file->store('notes', 'public');
            $file = $filePath;
        }else{
            $file = null;
        }
        if($request->loan_amount){
            $loan_amount = $request->loan_amount;
        }else{
            $loan_amount = null;
        }
        $insert_note = DB::table('notes')->insert(['user_id' => $user_id, 'loan_request_id' => $lead_id, 'title' => $title,'loan_status'=> $status,'provider_id' => $provider_id,'loan_amount'=>$loan_amount,'file'=>$file]);
        if(DB::table('loan_requests')->where('id',$lead_id)->update(['loan_status'=>$status])){
            echo 1; die;
        }


        if ($insert_note) {
            return response()->json(['message' => 'Note added successfully.'], 200);
        }
    }

    public function fetch_notes(Request $request)
{
    $lead_id = $request->lead_id;

    $login_user_id = Auth::user()->id;
    $login_role_id = Auth::user()->role_id;
    $get_log_info = DB::table('assign_lead')->where('lead_id', $lead_id)->first();

    // Fetching notes with users
    $query = DB::table('notes')
    ->leftJoin('users', 'notes.user_id', '=', 'users.id')
    ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
    ->leftJoin('providers', 'providers.id', '=', 'notes.provider_id')
    ->select('notes.*', 'users.name as username', 'roles.title as role_name', 'providers.title as provider_title')
    ->where('notes.loan_request_id', $lead_id)
    ->where('notes.status', 1)
    ->orderBy('notes.id', 'asc');
    if ($login_role_id != 1 && @$get_log_info->assign_user_id != $login_user_id) {
        $query->where('notes.user_id', $login_user_id);
    }

    $notes = $query->get();
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

            // Build HTML for each note with proper alignment and Bootstrap classes
            $html .= '
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0">Title: ' . $note->title . '</p>
                        <p class="mb-0">Provider: ' . $note->provider_title . '</p>
                        <p>' . str_replace('By', ' ', $added_by) . ' At: ' . date('d F Y h:i A', strtotime($note->created_at)) . '</p>
                        <small>' . $added_by . ': ' . ucwords($note->username) . ' (' . $note->role_name . ')</small>';

                        // Display loan amount if available
                        if (!empty($note->loan_amount)) {
                            $html .= '<p><strong>Loan Amount:</strong> ' . number_format($note->loan_amount, 2) . '</p>';
                        }

                        // Display file if available
                        if (!empty($note->file)) {
                            $html .= '<p><strong>File:</strong> <a href="' . asset('storage/' . $note->file) . '" target="_blank">View File</a></p>';
                        }

        $html .= '</div>
                    <span class="badge bg-' . $class . ' rounded-pill">' . str_replace('_', ' ', $loan_status) . '</span>
                </div>
            </li>';

        }
    }

    echo $html; // Output the generated HTML
}




    public function delete_notes(Request $request){
        $note_id = $request->note_id;
        $delete_note = DB::table('notes')->where('id', $note_id)->update(['status' => 3]);
        if($delete_note){
            return response()->json(['message' => 'Note deleted successfully.'], 200);
        }
    }

    public function notes_disscuss(Request $request){

        $id = $request->id;
        $user_id = $request->user_id;
        $get_note = DB::table('notes')->where('loan_request_id',$id)->where('title','View Lead')->where('user_id',$user_id)->first();
        if($get_note){
            DB::table('notes')->insert(['loan_request_id'=>$id,'user_id'=>$user_id,'loan_status'=>3,'title'=>"Under Processing"]);
            DB::table('loan_requests')->where('id', $id)->update(['loan_status' => 3]);

        }
    }
}
