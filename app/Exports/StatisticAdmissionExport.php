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
        return StatisticAdmission::
        select('admission_date', 'admission_id', 'admission_id', 'admission_id',
            'attention_time', 'user_id', 'professional_id')->
        whereBetween('admission_date', [$this->date1, $this->date2]);
    }

    public function map($statisticadmission): array{

        $admission_date = Carbon::parse($statisticadmission->admission_date);

        return [

            Date::dateTimeToExcel($admission_date),
            $statisticadmission->admission->invoice_number,
            $statisticadmission->admission->doctype,
            $statisticadmission->admission->patient->name,
            $statisticadmission->attention_time,
            $statisticadmission->user->name,
            $statisticadmission->user->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha Admisión',
            'Numero Factura',
            'Tipo Doc',
            'Paciente',
            'Tiempo Atención',
            'Técnico',
            'Profesional',
        ];

    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
          'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
