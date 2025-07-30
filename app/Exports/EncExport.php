<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EncExport implements FromArray, WithHeadings
{
    protected $status;
    protected $fromDate;
    protected $toDate;

    public function __construct($status = null, $fromDate = null, $toDate = null)
    {
        $this->status = $status;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function array(): array
    {
        $query = DB::table('enquiry as c')
            ->leftJoin('routes as r', 'r.id', '=', 'c.service_id')
            ->select(
                'c.id',
                'c.name',
                'c.email',
                'c.mobile',
                'c.address',
                'r.title as service_name',
                'c.message',
                'c.created_at'
            );

        // Filter by status if provided
        if (!is_null($this->status)) {
            $query->where('c.status', $this->status);
        }

        // Filter by date range if provided
        if ($this->fromDate) {
            $query->whereDate('c.created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('c.created_at', '<=', $this->toDate);
        }

        $contacts = $query->get();

        $data = [];
        foreach ($contacts as $contact) {
            $data[] = [
                'ID' => $contact->id,
                'Name' => $contact->name,
                'Email' => $contact->email,
                'Mobile' => $contact->mobile,
                'Address' => $contact->address,
                'Service Name' => $contact->service_name,
                'Message' => $contact->message,
                'Created At' => $contact->created_at,
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Address',
            'Service Name',
            'Message',
            'Created At',
        ];
    }

    protected function getStatusLabel($status)
    {
        $map = [
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Deleted',
        ];
        return $map[$status] ?? 'Unknown';
    }
}
