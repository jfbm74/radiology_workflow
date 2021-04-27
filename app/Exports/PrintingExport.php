<?php

namespace App\Exports;

use App\Printing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        return DB::
        table('printings')
            ->select('admissions.invoice_date', 'admissions.doctype', 'admissions.invoice_number',
                'patients.name as PatientName', 'patients.legal_id', 'patients.birthday', 'products.cod_manager',
                'products.name', 'PRO.name as ProfessionalName', 'printings.type', 'printings.quanty',
                'TEC.name as TechnicianName', 'service_order_details.kv', 'service_order_details.ma',
                'service_order_details.dosis', 'service_order_details.extime', 'statistic_admissions.attention_time', 'admissions.order_printing')
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.id', '=', 'admissions.id')
            ->join('patients', 'admissions.patient_id', '=', 'patients.id')
            ->join('users as PRO', 'admissions.user_id', '=', 'PRO.id')
            ->join('users as TEC', 'printings.user_id', '=', 'TEC.id')
            ->join('products', 'service_order_details.product_id', '=', 'products.id')
            ->join('statistic_admissions', 'statistic_admissions.admission_id', '=', 'admissions.id')
            ->whereBetween('admissions.invoice_date',[$this->date1, $this->date2])
            ->orderBy('admissions.invoice_date');

    }

    public function map($printing): array
    {
        $invoice_date = Carbon::parse($printing->invoice_date);

        return [
            Date::dateTimeToExcel($invoice_date),
            $printing->doctype,
            $printing->invoice_number,
            $printing->PatientName,
            $printing->legal_id,
            $printing->birthday,
            $printing->cod_manager,
            $printing->name,
            $printing->ProfessionalName,
            $printing->type,
            $printing->quanty,
            $printing->TechnicianName,
            $printing->kv,
            $printing->ma,
            $printing->dosis,
            $printing->extime,
            $printing->attention_time,
            $printing->order_printing
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha Admisión',
            'Tipo Documento',
            'Número Factura/OS',
            'Paciente',
            'Identificación',
            'Fecha Nacimiento',
            'Código Estudio',
            'Nombre Estudio',
            'Profesional',
            'Tipo',
            'Cantidad',
            'Técnico',
            'KV',
            'mA',
            'Dosis',
            'EXTIME',
            'Tiempo Atención',
            'Orden Impresa'
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
