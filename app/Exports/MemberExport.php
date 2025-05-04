<?php
namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class MemberExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Mendapatkan data koleksi member
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Member::all();
    }

    /**
     * Menambahkan headings untuk kolom Excel
     */
    public function headings(): array
    {
        return [
            'No','ID', 'Nama', 'Email', 'Tanggal Bergabung',
        ];
    }

    /**
     * Mengatur style untuk header dan data
     */
    public function styles($sheet)
    {
        return [
            // Menambahkan style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '4F81BD'],
                ],
            ],
            // Menambahkan style untuk data
            'A2:D1000' => [  // Sesuaikan dengan jumlah baris data
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
                'font' => [
                    'size' => 10,
                ],
            ],
        ];
    }

    /**
     * Mengatur lebar kolom otomatis menyesuaikan konten
     */
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 30,
            'D' => 20,
            'E' => 20,
        ];
    }
}
