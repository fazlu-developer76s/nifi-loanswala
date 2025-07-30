<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadExport implements FromArray, WithHeadings
{
    protected $loan_status;

    public function __construct($loan_status)
    {
        $this->loan_status = $loan_status;
    }

    public function array(): array
    {
        $query = DB::table('loan_requests as a')
            ->leftJoin('users as b', 'b.id', '=', 'a.created_user_id')
            ->leftJoin('routes as c', 'c.id', '=', 'a.service_id')
            ->leftJoin('roles as d', 'b.role_id', '=', 'd.id')
            ->select(
                'a.id',
                // 'a.user_id',
                // 'a.created_user_id',
                'a.service_id',
                'a.full_name',
                'a.father_name',
                'a.email',
                'a.date_of_birth',
                'a.residence_address',
                'a.state_name',
                'a.district_name',
                'a.tehsil_taluka',
                'a.pin_code',
                'a.loan_amount',
                'a.income',
                'a.income_proof_name',
                'a.res_lat',
                'a.res_long',
                'a.business_lat',
                'a.business_long',
                'a.business_address',
                'a.business_state',
                'a.business_district',
                'a.business_tehsil',
                'a.business_pin_code',
                'a.business_mobile_no',
                'a.is_lead_duplicate',
                'a.aadhar_front_docs',
                'a.aadhar_back_docs',
                'a.pan_card_docs',
                'a.voter_card_docs',
                'a.cibil_score',
                'a.cibil_doc_upload',
                'a.remark',
                'a.loan_status',
                'a.created_at',
                'a.updated_at',
                'a.status',
                'b.name as user_name',
                'c.title as service_name',
                'd.title as role_name'
            );

        if ($this->loan_status) {
            $query->where('a.loan_status', $this->loan_status);
        }

        $leads = $query->get();

        $data = [];
        foreach ($leads as $lead) {
            $data[] = [
                'ID' => $lead->id,
                // 'User ID' => $lead->user_id,
                // 'Created User ID' => $lead->created_user_id,
                // 'Service ID' => $lead->service_name,
                'Full Name' => $lead->full_name,
                'Father Name' => $lead->father_name,
                'Email' => $lead->email,
                'Date of Birth' => $lead->date_of_birth,
                'Residence Address' => $lead->residence_address,
                'State' => $lead->state_name,
                'District' => $lead->district_name,
                'Tehsil' => $lead->tehsil_taluka,
                'Pin Code' => $lead->pin_code,
                'Loan Amount' => $lead->loan_amount,
                'Income' => $lead->income,
                'Income Proof Name' => $lead->income_proof_name,
                'Residence Latitude' => $lead->res_lat,
                'Residence Longitude' => $lead->res_long,
                'Business Latitude' => $lead->business_lat,
                'Business Longitude' => $lead->business_long,
                'Business Address' => $lead->business_address,
                'Business State' => $lead->business_state,
                'Business District' => $lead->business_district,
                'Business Tehsil' => $lead->business_tehsil,
                'Business Pin Code' => $lead->business_pin_code,
                'Business Mobile No.' => $lead->business_mobile_no,
                'Is Lead Duplicate' => $lead->is_lead_duplicate ? 'Yes' : 'No',
                'Aadhar Front Docs' => $lead->aadhar_front_docs,
                'Aadhar Back Docs' => $lead->aadhar_back_docs,
                'PAN Card Docs' => $lead->pan_card_docs,
                'Voter Card Docs' => $lead->voter_card_docs,
                'Cibil Score' => $lead->cibil_score,
                'Cibil Doc Upload' => $lead->cibil_doc_upload,
                'Remark' => $lead->remark,
                'Loan Status' => $this->getLoanStatus($lead->loan_status),
                'Created At' => $lead->created_at,
                // 'Updated At' => $lead->updated_at,
                'Status' => $lead->status ? 'Active' : 'Inactive',
                'User Name' => $lead->user_name. '('.$lead->role_name.')',
                'Service Name' => $lead->service_name,
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            // 'User ID',
            // 'Created User ID',
            // 'Service ID',
            'Full Name',
            'Father Name',
            'Email',
            'Date of Birth',
            'Residence Address',
            'State',
            'District',
            'Tehsil',
            'Pin Code',
            'Loan Amount',
            'Income',
            'Income Proof Name',
            'Residence Latitude',
            'Residence Longitude',
            'Business Latitude',
            'Business Longitude',
            'Business Address',
            'Business State',
            'Business District',
            'Business Tehsil',
            'Business Pin Code',
            'Business Mobile No.',
            'Is Lead Duplicate',
            'Aadhar Front Docs',
            'Aadhar Back Docs',
            'PAN Card Docs',
            'Voter Card Docs',
            'Cibil Score',
            'Cibil Doc Upload',
            'Remark',
            'Loan Status',
            'Created At',
            // 'Updated At',
            'Status',
            'User Name',
            'Service Name',
        ];
    }

    protected function getLoanStatus($status)
    {
        $statusMap = [
            1 => 'Pending',
            2 => 'Viewed',
            3 => 'Under Process',
            4 => 'Move to Lender',
            5 => 'Sanction',
            6 => 'Disbursed',
            7 => 'Rejected',
        ];

        return $statusMap[$status] ?? 'Unknown';
    }
}
