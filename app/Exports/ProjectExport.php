<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ProjectExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Mendapatkan data koleksi project
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Project::select('id', 'name', 'description', 'start_date', 'end_date', 'is_active')
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'description' => $project->description,
                    'start_date' => $project->start_date->format('Y-m-d'),
                    'end_date' => $project->end_date->format('Y-m-d'),
                    'status' => $project->is_active ? 'Aktif' : 'Nonaktif',
                ];
            });
    }

    /**
     * Menambahkan headings untuk kolom Excel
     */
    public function headings(): array
    {
        return [
            'ID', 'Nama Project', 'Deskripsi', 'Tanggal Mulai', 'Tanggal Selesai', 'Status',
        ];
    }

    /**
     * Mengatur style untuk header dan data
     */
    public function styles($sheet)
{
    return [
        // Header (baris 1)
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
    ];
}

    /**
     * Mengatur lebar kolom otomatis menyesuaikan konten
     */
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'A' => 20,
            'C' => 40,  // Deskripsi
            'D' => 20,  // Tanggal Mulai
            'E' => 20,  // Tanggal Selesai
            'F' => 15,  // Status
        ];
    }
}
