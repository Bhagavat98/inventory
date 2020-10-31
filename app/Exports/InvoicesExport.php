<?php
namespace Inventory\Exports;

use Inventory\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Illuminate\Support\Facades\DB;



class InvoicesExport implements FromCollection,WithTitle, WithHeadings, ShouldAutoSize, WithEvents
{
   
    public function collection()
    {    ini_set('memory_limit','140M');
        return DB::table('advgps.tat_reports')->limit(10000)->get();
    }

    public function title(): string
    {
        return 'My Sheet Title';
    }

    /**
     * @return array
    */
    public function headings(): array
    {
        return [
            '#',
            'Vehicle Name',
            'Date',
            'Supplier Area',
            'Supplier In',
            'supplier Out',
            'Detention At Supplier',
            'Customer Area',
            'Customer In',
            'Customer Out',
            'Cetention At Customer',
            'Total',
        ];

        //return 'Tat Reports';    
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //$cellRange = 'A1:L1'; // All headers
                //$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                 
                $styleArray = [
                    'font'=>['name'=>'Calibri','size'=>14,'bold'=>true],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'dff0d8',
                         ]           
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('A1:L1')->applyFromArray($styleArray);

                
            },
        ];
    }


}