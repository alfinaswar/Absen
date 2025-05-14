<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class AbsenExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle, ShouldAutoSize, WithCustomStartCell, WithEvents
{
    protected $data;
    protected $request;

    public function __construct($data, $request)
    {
        $this->data = $data;
        $this->request = $request;
    }

    public function collection()
    {
        return $this->data;
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function title(): string
    {
        return 'Laporan Absensi';
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Karyawan',
            'Tanggal',
            'Jam Masuk',
            'Jam Keluar',
            'Status Masuk',
            'Status Keluar',
            'Approval',
            'Lokasi Masuk',
            'Lokasi Keluar'
        ];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $item->nama_karyawan,
            Carbon::parse($item->tanggal)->format('d/m/Y'),
            $item->jam_masuk,
            $item->jam_keluar ?? '-',
            $item->ontime_masuk == 'Y' ? 'Tepat Waktu' : 'Terlambat',
            isset($item->ontime_keluar) ? ($item->ontime_keluar == 'Y' ? 'Tepat Waktu' : 'Terlambat') : '-',
            $item->approval_masuk == 'Y' ? 'Disetujui' : 'Pending',
            $item->lokasi_masuk ?? '-',
            $item->lokasi_keluar ?? '-'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 12,
            'D' => 12,
            'E' => 12,
            'F' => 15,
            'G' => 15,
            'H' => 10,
            'I' => 30,
            'J' => 30
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Styling headings row
        $sheet->getStyle('A7:' . $lastColumn . '7')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1F497D'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Styling data rows
        $sheet->getStyle('A8:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Styling specific columns alignment
        $sheet->getStyle('A8:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C8:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F8:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Zebra striping for rows
        for ($row = 8; $row <= $lastRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':' . $lastColumn . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F2F2F2'],
                    ],
                ]);
            }
        }

        // Conditional formatting for status columns
        for ($row = 8; $row <= $lastRow; $row++) {
            // Status Masuk
            $statusMasuk = $sheet->getCell('F' . $row)->getValue();
            if ($statusMasuk == 'Tepat Waktu') {
                $sheet->getStyle('F' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => '008000']],
                ]);
            } elseif ($statusMasuk == 'Terlambat') {
                $sheet->getStyle('F' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => 'FF0000']],
                ]);
            }

            // Status Keluar
            $statusKeluar = $sheet->getCell('G' . $row)->getValue();
            if ($statusKeluar == 'Tepat Waktu') {
                $sheet->getStyle('G' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => '008000']],
                ]);
            } elseif ($statusKeluar == 'Terlambat') {
                $sheet->getStyle('G' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => 'FF0000']],
                ]);
            }

            // Approval
            $approval = $sheet->getCell('H' . $row)->getValue();
            if ($approval == 'Disetujui') {
                $sheet->getStyle('H' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => '008000']],
                ]);
            } elseif ($approval == 'Pending') {
                $sheet->getStyle('H' . $row)->applyFromArray([
                    'font' => ['color' => ['rgb' => 'FFA500']],
                ]);
            }
        }

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Company header
                $sheet->mergeCells('A1:J1');
                $sheet->setCellValue('A1', 'PT. EXAMPLE CORPORATION');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => '1F497D'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Report title
                $sheet->mergeCells('A2:J2');
                $sheet->setCellValue('A2', 'LAPORAN ABSENSI KARYAWAN');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Report period
                $period = 'Periode: ';
                if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
                    $period .= Carbon::parse($this->request->start_date)->format('d/m/Y') . ' sampai ' .
                        Carbon::parse($this->request->end_date)->format('d/m/Y');
                } else {
                    $period .= Carbon::now()->startOfMonth()->format('d/m/Y') . ' sampai ' .
                        Carbon::now()->format('d/m/Y');
                }

                $sheet->mergeCells('A3:J3');
                $sheet->setCellValue('A3', $period);
                $sheet->getStyle('A3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Summary data
                $totalAbsen = count($this->data);
                $tepatWaktu = 0;
                $terlambat = 0;

                foreach ($this->data as $item) {
                    if ($item->ontime_masuk == 'Y') {
                        $tepatWaktu++;
                    } else {
                        $terlambat++;
                    }
                }

                $sheet->setCellValue('A5', 'Total Kehadiran:');
                $sheet->setCellValue('B5', $totalAbsen);

                $sheet->setCellValue('C5', 'Tepat Waktu:');
                $sheet->setCellValue('D5', $tepatWaktu);

                $sheet->setCellValue('E5', 'Terlambat:');
                $sheet->setCellValue('F5', $terlambat);

                $sheet->getStyle('A5:F5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Add footer
                $lastRow = $sheet->getHighestRow() + 2;
                $sheet->mergeCells('A' . $lastRow . ':J' . $lastRow);
                $sheet->setCellValue('A' . $lastRow, 'Laporan ini dihasilkan secara otomatis oleh Sistem Absensi PT. Example Corporation');
                $sheet->getStyle('A' . $lastRow)->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                        'color' => ['rgb' => '666666'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->mergeCells('A' . ($lastRow + 1) . ':J' . ($lastRow + 1));
                $sheet->setCellValue('A' . ($lastRow + 1), 'Tanggal cetak: ' . Carbon::now()->format('d/m/Y H:i:s'));
                $sheet->getStyle('A' . ($lastRow + 1))->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'color' => ['rgb' => '666666'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}