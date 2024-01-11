<?php

namespace App\Exports;

use App\ServiceOrderDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;

class ServiceOrderDetailExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    private $date;

    public function __construct($date)
    {
        $this->date1 = $date[0];
        $this->date2 = $date[1];
    }

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return ServiceOrderDetail::
        select('service_order_id', 'service_order_id', 'service_order_id',
            'service_order_id', 'service_order_id', 'service_order_id', 'product_id',
            'kv', 'ma', 'dosis', 'extime', 'user_id', 'fullfilment_date' )->
        whereBetween('fullfilment_date', [$this->date1, Carbon::parse($this->date2)->endOfDay()]);
    }

    public function map($row): array
    {
        $fullfilment_date = Carbon::parse($row->fullfilment_date);
        return [            
            $row->fullfilment_date,
            $row->serviceorder->admission->doctype,
            $row->serviceorder->admission->invoice_number,
            $row->serviceorder->admission->patient->name,
            $row->serviceorder->admission->patient->legal_id,
            $row->serviceorder->admission->patient->birthday,
            $row->product->name,
            $row->kv,
            $row->ma,
            $row->dosis,
            $row->extime,
            $row->user->name,            
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha Cumplimiento',
            'Tipo Doc',
            'Numero Factura',
            'Paciente',
            'Identificación',
            'Fecha Nacimiento',
            'Estudio',
            'kv',
            'ma',
            'dosis',
            'extime',
            'Técnico'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
