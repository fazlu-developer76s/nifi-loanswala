<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromArray, WithHeadings
{

    protected $role;
    protected $provider;

    // Accept a parameter through the constructor
    public function __construct($role,$provider)
    {
        $this->role = $role;
        $this->provider = $provider;
    }
    public function array(): array
    {

        $query = DB::table('users as a')
        ->leftJoin('providers as b', 'a.provider_id', '=', 'b.id')
        ->leftJoin('roles as c', 'a.role_id', '=', 'c.id')
        ->select('a.*', 'b.title as provider_name','c.title as role_name');
            if ($this->role) {
                $query->where('a.role_id', '!=', 1);
            }

            if ($this->provider) {
                $query->where('a.provider_id', $this->provider);
            }

    // Execute the query and get the result
    $users = $query->get();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'ID' => $user->id,
                'Provider ID' => $user->provider_name,
                'Member ID' => $user->member_id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Mobile No.' => $user->mobile_no,
                'Aadhar No.' => $user->aadhar_no,
                'PAN No.' => $user->pan_no,
                'Is Mobile Verified' => $user->is_mobile_verified ? 'Yes' : 'No',
                'Email Verified At' => $user->email_verified_at,
                'Occupation' => $user->occupation,
                'Company Name' => $user->company_name,
                'Account Name' => $user->account_name,
                'Account No.' => $user->account_no,
                'IFSC Code' => $user->ifsc_code,
                'Bank Statement' => $user->bank_statement,
                'Office Address' => $user->office_address,
                'State' => $user->state,
                'District' => $user->district,
                'Tehsil' => $user->tehsil,
                'Town' => $user->town,
                'Pin Code' => $user->pin_code,
                'Alternate Mobile No.' => $user->alt_mobile_no,
                'Role ID' => $user->role_name,
                'Is User Verified' => $user->is_user_verified ? 'Yes' : 'No',
                'Created At' => $user->created_at,
                'Updated At' => $user->updated_at,
                'Status' => $user->status ? 'Active' : 'Inactive',
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Provider ID',
            'Member ID',
            'Name',
            'Email',
            'Mobile No.',
            'Aadhar No.',
            'PAN No.',
            'Is Mobile Verified',
            'Email Verified At',
            'Occupation',
            'Company Name',
            'Account Name',
            'Account No.',
            'IFSC Code',
            'Bank Statement',
            'Office Address',
            'State',
            'District',
            'Tehsil',
            'Town',
            'Pin Code',
            'Alternate Mobile No.',
            'Role ID',
            'Is User Verified',
            'Created At',
            'Updated At',
            'Status',
        ];
    }
}
