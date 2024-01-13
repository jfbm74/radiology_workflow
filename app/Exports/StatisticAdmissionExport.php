<?php

namespace App\Exports;

use App\StatisticAdmission;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;


class StatisticAdmissionExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
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
       /*  return StatisticAdmission::
        select('admission_date', 'admission_id', 'admission_id',
            'admission_id', 'admission_id','admission_id',
            'attention_time', 'user_id', 'professional_id')->
        whereBetween('admission_date', [$this->date1, $this->date2]); */

        return StatisticAdmission::query()
        ->select('statistic_admissions.*')
        ->leftJoin('admissions', 'statistic_admissions.admission_id', '=', 'admissions.id')
        ->leftJoin('service_orders', 'admissions.id', '=', 'service_orders.admission_id')
        ->leftJoin('service_order_details', 'service_orders.id', '=', 'service_order_details.service_order_id')
        ->whereBetween('admissions.created_at', [$this->date1, Carbon::parse($this->date2)->endOfDay()])
        ->groupBy('statistic_admissions.id')
        ->selectRaw('COUNT(service_order_details.id) as order_count');

    }

    public function map($statisticadmission): array{

        $admission_date = Carbon::parse($statisticadmission->admission_date);

        return [            
            $statisticadmission->admission->invoice_number,
            $statisticadmission->admission->patient->legal_id,
            $statisticadmission->admission->patient->name,            
            Date::dateTimeToExcel($admission_date),
            $statisticadmission->attention_time,
            $statisticadmission->order_count,
            $statisticadmission->user->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Factura',
            'Identificación Paciente',
            'Paciente',
            'Fecha Admisión',
            'Tiempo de Atención',
            'Numero de Órdenes de servicio',
            'Estación',
        ];

    }

    public function columnFormats(): array
    {
        return [
          'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('E'. ($event->sheet->getHighestRow()+1),
                    '=AVG(E2:E'.$event->sheet->getHighestRow().')');

            },
        ];
    }
}
