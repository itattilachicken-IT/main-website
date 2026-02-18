<?php

namespace App\Modules\EventInvitations\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;

class InvitationsExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $invitations;

    public function __construct(array $invitations)
    {
        $this->invitations = $invitations;
    }

    /**
     * Return the collection of invitations for export.
     */
    public function collection()
    {
        return collect($this->invitations);
    }

    /**
     * Define the column headings.
     */
    public function headings(): array
    {
        return [
            'Guest Name',
            'Guest Mobile',
            'Status',
            'Number of Attendees',
            'Event Dates',
        ];
    }

    /**
     * Format columns as needed (e.g., mobile as text).
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT, // Guest Mobile
        ];
    }
}
