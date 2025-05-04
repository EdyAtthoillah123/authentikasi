<?php

namespace App\Imports;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Illuminate\Support\Facades\Log;

class ProjectImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithEvents
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        return new Project([
            'uuid' => Str::uuid(),
            'name' => $row['name'] ?? null,
            'description' => $row['description'] ?? null,
            'start_date' => $row['start_date'] ?? null,
            'end_date' => $row['end_date'] ?? null,
            'is_active' => isset($row['is_active']) ? (bool)$row['is_active'] : false,
            'documents' => isset($row['documents']) ? json_decode($row['documents'], true) : [],
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function registerEvents(): array
{
    return [
        AfterImport::class => function () {
            Log::info('✅ AfterImport dijalankan untuk user ID: ' . $this->userId);
            Cache::put('import_done_' . $this->userId, true, now()->addMinutes(10));
        },
    ];
}
}
