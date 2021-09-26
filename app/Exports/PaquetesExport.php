<?php

namespace App\Exports;

use App\BillDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PaquetesExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    protected $from_date;
    protected $to_date;

    public function __construct($from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    use Exportable;

    /**
    * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $new_end_date = Carbon::parse($this->to_date)->addDay();
        $data = BillDetail::query()
            ->select('bill_details.id', 'bill_details.codprod', 'bill_details.desprod', 'bill_details.quanty',
                    'bill_details.admission_id', 'bill_details.created_at', 'admissions.invoice_number', 'admissions.doctype' ,
                    'PRO.name as nom_prof', 'PAT.name as nombre_paciente', 'PAT.legal_id as identificacion')
            ->join('admissions', 'bill_details.admission_id', '=', 'admissions.id')
            ->join('users AS PRO', 'admissions.user_id', '=', 'PRO.id')
            ->join('patients AS PAT', 'admissions.patient_id', '=', 'PAT.id')
            ->whereBetween('bill_details.created_at', [$this->from_date, $new_end_date]);
        return $data;
    }

    public function map($data): array
    {
        $created_date = Carbon::parse($data->created_at);
        return [
            $data->invoice_number,
            $data->doctype,
            $data->codprod,
            $data->desprod,
            $data->quanty,
            $data->nom_prof,
            $data->nombre_paciente,
            $data->identificacion,
            Date::dateTimeToExcel($created_date)
        ];
    }

    public function headings(): array
    {
        return [
            'Factura #',
            'Tipo Doc',
            'Codigo',
            'Producto',
            'Cantidad',
            'Profesional',
            'Paciente',
            'Identificacion Paciente',
            'Fecha'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}
