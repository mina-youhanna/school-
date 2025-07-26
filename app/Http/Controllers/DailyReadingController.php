<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seneksar;
use App\Models\DailyReading;
use Carbon\Carbon;

class DailyReadingController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));

        // جلب السنكسار (كما هو عندك)
        $seneksar = Seneksar::where('gregorian_date', $date)->get();

        // جلب قراءة اليوم من جدول katamars_readings
        $reading = \DB::table('katamars_readings')
            ->where('gregorian_date', $date)
            ->first();

        $coptic_date = null;
        $prophecies = [];
        if ($reading) {
            $coptic_date = $reading->coptic_date;
            $prophecies = \DB::table('katamars_prophecies')
                ->where('reading_id', $reading->id)
                ->get();
        }

        // صنف القراءات حسب نوعها
        $groupedReadings = [];
        if ($reading) {
            $groupedReadings = [
                'العشية' => [
                    [
                        'section_title' => 'العشية',
                        'content' => $reading->vesper_prayer,
                    ]
                ],
                'باكر' => [
                    [
                        'section_title' => 'باكر',
                        'content' => $reading->morning_prayer,
                    ]
                ],
                'البولس' => [
                    [
                        'section_title' => 'البولس',
                        'content' => $reading->polis,
                    ]
                ],
                'الإبركسيس' => [
                    [
                        'section_title' => 'الإبركسيس',
                        'content' => $reading->apraksees,
                    ]
                ],
                'الكاثوليكون' => [
                    [
                        'section_title' => 'الكاثوليكون',
                        'content' => $reading->kathilycon,
                    ]
                ],
                'الإنجيل' => [
                    [
                        'section_title' => 'الإنجيل',
                        'content' => $reading->gospel,
                    ]
                ],
            ];
        }

        return view('daily_readings', [
            'seneksar' => $seneksar,
            'readings' => $groupedReadings,
            'coptic_date' => $coptic_date,
            'prophecies' => $prophecies,
        ]);
    }

    private function extractContent($reading)
    {
        // لو فيه نص HTML مباشر (مثلاً السنكسار)
        if (!empty($reading['html'])) {
            return $reading['html'];
        }
        // لو فيه passages (آيات)
        if (!empty($reading['passages'])) {
            $text = '';
            foreach ($reading['passages'] as $passage) {
                if (!empty($passage['verses'])) {
                    foreach ($passage['verses'] as $verse) {
                        $text .= $verse['text'] . '<br>';
                    }
                }
            }
            return $text;
        }
        return '';
    }
}
