<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PurchaseOrderExport implements FromCollection, WithHeadings
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return $this->data->map(function ($item) {
            return[
                'order_no' => $item->order_no,
                'order_id' => $item->order_id,
                'priority' => ($item->priority=='sync')?'completed':'pending',
                'priority_so' => $item->priority_so,
                'created_at' => $item->created_at,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'order_no',
            'order_id',
            'priority',
            'priority_so',
            'created_at'
        ];
    }
}
