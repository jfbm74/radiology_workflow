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
            'service_order_id', 'product_id', 'exposure_time', 'ionizing_radiation_dose', 'user_id' )->
        whereBetween('fullfilment_date', [$this->date1, $this->date2]);
    }

    public function map($row): array
    {
        $fullfilment_date = Carbon::parse($row->fullfilment_date);
        return [
            Date::dateTimeToExcel($fullfilment_date),
            $row->serviceorder->admission->doctype,
            $row->serviceorder->admission->invoice_number,
            $row->serviceorder->admission->patient->name,
            $row->product->name,
            $row->exposure_time,
            $row->ionizing_radiation_dose,
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
            'Estudio',
            'Tiempo Exposición (s)',
            'Dosis Radiación (mSv)',
            'Técnico',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
