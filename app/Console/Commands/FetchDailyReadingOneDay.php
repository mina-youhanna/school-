<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\DailyReading;
use Carbon\Carbon;

class FetchDailyReadingOneDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:daily-reading-one-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store daily reading for one day from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = '16-07-2025';
        $url = "https://api.katameros.app/readings/gregorian/{$date}?languageId=3";
        $response = Http::get($url);
        $data = $response->json();

        foreach ($data['sections'] ?? [] as $section) {
            $section_title = $section['title'] ?? '';
            foreach ($section['subSections'] ?? [] as $sub) {
                $sub_title = $sub['title'] ?? '';
                foreach ($sub['readings'] ?? [] as $reading) {
                    $reading_intro = $reading['introduction'] ?? '';
                    $reading_conclusion = $reading['conclusion'] ?? '';
                    $content = '';
                    $html = $reading['html'] ?? null;
                    $book_translation = null;
                    $ref = null;
                    $reading_title = $reading['title'] ?? '';
                    // لو فيه نص HTML (سنكسار أو غيره)
                    if (!empty($reading['html'])) {
                        $content = $reading['html'];
                    }
                    // لو فيه passages (آيات)
                    elseif (!empty($reading['passages'])) {
                        $verses = [];
                        foreach ($reading['passages'] as $passage) {
                            $book_translation = $passage['bookTranslation'] ?? null;
                            $ref = $passage['ref'] ?? null;
                            foreach ($passage['verses'] ?? [] as $verse) {
                                $verses[] = $verse['text'];
                            }
                        }
                        $content = implode("\n", $verses);
                    }
                    // لو مفيش نص، تجاهل
                    if (empty($content)) continue;

                    DailyReading::create([
                        'reading_date' => Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d'),
                        'coptic_date' => $data['copticDate'] ?? '',
                        'type' => $section_title,
                        'section_title' => $sub_title,
                        'reading_title' => $reading_title,
                        'book_translation' => $book_translation,
                        'ref' => $ref,
                        'content' => $content,
                        'introduction' => $reading_intro,
                        'conclusion' => $reading_conclusion,
                        'html' => $html,
                    ]);
                }
            }
        }
        $this->info('تم جلب وتخزين قراءات اليوم بنجاح!');
    }
}
