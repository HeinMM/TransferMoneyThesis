<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionsExport implements FromQuery, WithHeadings,ShouldAutoSize,WithColumnFormatting, WithMapping
{

    use Exportable;

    protected $from;
    protected $to;
    protected $nationId;

    public function __construct($from,$to,$nationId=null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->nationId = $nationId;
    }

    public function query()
    {
        return Transaction::select(
            'id',
             'agentCode',
              'control_no',
              'nation_id',
              'senderName',
              'senderPhone',
              'recipentName',
              'recipentPhone',
              'recipentId',
              'paymentName',
              'paymentNumber',
              'receivingAmount',
              'created_at'
              )
            ->whereBetween('created_at', [$this->from, $this->to])->latest('id');
    }

    public function headings(): array
    {
        return [
            'Id',
            'Agent Name',
            'Transaction Number',
            'Country Code',
            'Sender Name',
            'Sender Phone',
            'Recipent Name',
            'Recipent Phone',
            'Recipent National Id',
            'Payment Name',
            'Payment Number',
            'Amount',
            'Date'
        ];
    }

    public function map($transaction): array
    {
        // Format the 'created_at' date field
        return [
            $transaction->id,
            $transaction->agentCode,
            $transaction->control_no,
            $transaction->nation_id,
            $transaction->senderName,
            $transaction->senderPhone,
            $transaction->recipentName,
            $transaction->recipentPhone,
            $transaction->recipentId,
            $transaction->paymentName,
            $transaction->paymentNumber,
            $transaction->receivingAmount,
            Carbon::parse($transaction->created_at)->format('m/d/Y H:i')
        ];
    }

    public function columnFormats(): array
    {
        return [
            'N' => NumberFormat::FORMAT_DATE_YYYYMMDD
        ];
    }


//     public function getUpdatedAtAttribute($date)
// {
//     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d:m:Y');
// }

}
