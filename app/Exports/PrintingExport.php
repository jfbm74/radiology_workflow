<?php

namespace App\Exports;

use App\Printing;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrintingExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting
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
        return Printing::select('service_order_details_id', 'service_order_details_id',
            'service_order_details_id', 'service_order_details_id','service_order_details_id',
            'service_order_details_id', 'service_order_details_id', 'service_order_details_id'
            , 'service_order_details_id', 'type', 'quanty', 'user_id',
            'service_order_details_id')->
            where('is_printed', 1)->
            whereBetween('created_at', [$this->date1, $this->date2]);
    }

    public function map($printing): array
    {
        $created_at = Carbon::parse($printing->serviceorderdetail->serviceorder->admission->invoice_date);
        return [
            Date::dateTimeToExcel($created_at),
            $printing->serviceorderdetail->serviceorder->admission->doctype,
            $printing->serviceorderdetail->serviceorder->admission->invoice_number,
            $printing->serviceorderdetail->serviceorder->admission->patient->name,
            $printing->serviceorderdetail->serviceorder->admission->patient->birthday,
            $printing->serviceorderdetail->serviceorder->admission->patient->legal_id,
            $printing->serviceorderdetail->product->cod_manager,
            $printing->serviceorderdetail->product->name,
            $printing->serviceorderdetail->serviceorder->admission->user->name,
            $printing->type,
            $printing->quanty,
            $printing->user->name,
            $printing->serviceorderdetail->serviceorder->statisticadmission->attention_time
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha Admisión',
            'Tipo Documento',
            'Número Factura/OS',
            'Paciente',
            'Fecha Nacimiento',
            'Identificación Paciente',
            'Código Estudio',
            'Nombre Estudio',
            'Profesional',
            'Tipo',
            'Cantidad',
            'Técnico',
            'Oportunidad (m)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}
