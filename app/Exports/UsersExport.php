<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Http\Client\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($from,$to,$nationId=null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->nationId = $nationId;
    }

    public function headings(): array
    {
        return [
            
            'transaction number',
            'country code',
            'sender name',
            'sender phone',
            'recipent name',
            'recipent phone',
            'recipent national id',
            'payment name',
            'payment number',
            'amount',
            '#',
            'date',
            '#',
            '#',
            '#',
            '#'
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         // F is the column
    //         'payment name' => '0'
    //     ];
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::where("nation_id", $this->nationId)->whereBetween('created_at', [$this->from, $this->to])->latest('id')->get();
    }
}
