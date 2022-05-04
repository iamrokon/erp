<?php

namespace App\AllClass\master;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExcelReportDownload implements WithHeadings, FromArray, WithEvents, ShouldAutoSize, WithChunkReading
{
    use Exportable;

    public $header;
    public $data;

    public function __construct($header, $data)
    {
        $this->header = $header;
        $this->data = $data;
    }


    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return array_keys($this->header);
    }

    /**
     * @inheritDoc
     */
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $getHighestColumn = $event->getSheet()->getDelegate()->getHighestColumn();
                $event->sheet->getDelegate()->getParent()->getDefaultStyle()->getFont()->setName('ＭＳ Ｐゴシック');
                $event->sheet->getDelegate()->getStyle('A1:' . $getHighestColumn . '1')->getFont()->setSize(10)->setBold(true);
            },
        ];

    }

    /**
     * @inheritDoc
     */
    public function chunkSize(): int
    {
        return 200;
    }

    public function array(): array
    {
        $headers = array_values($this->header);
        $data = json_decode($this->data);
        $result = [];
        foreach ($data as $keyData => $valData) {
            foreach ($headers as $header) {
                $result[$keyData][$header] = $valData->$header ;
            }
        }
        return $result;
    }
}
