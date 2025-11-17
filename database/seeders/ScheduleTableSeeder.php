<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada data movie dan theater
        $movies = Movie::all();
        $theaters = Theater::all();

        if ($movies->isEmpty() || $theaters->isEmpty()) {
            $this->command->info('Tidak ada data movie atau theater. Silakan jalankan seeder movie dan theater terlebih dahulu.');
            return;
        }

        $schedules = [];
        $startTime = Carbon::now()->startOfDay()->addHours(10); // Mulai jam 10:00
        
        // Buat jadwal untuk 7 hari ke depan
        for ($day = 0; $day < 7; $day++) {
            $currentTime = (clone $startTime)->addDays($day);
            
            // 4 sesi per hari (10:00, 13:00, 16:00, 19:00)
            for ($session = 0; $session < 4; $session++) {
                $sessionTime = (clone $currentTime)->addHours($session * 3);
                
                foreach ($movies as $movie) {
                    // Ambil theater secara bergantian
                    $theater = $theaters[($movie->id + $day + $session) % $theaters->count()];
                    
                    $schedules[] = [
                        'movie_id' => $movie->id,
                        'theater_id' => $theater->id,
                        'start_time' => $sessionTime,
                        'price' => 40000 + (($session + 1) * 10000), // Harga bervariasi per sesi
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Masukkan data ke database
        Schedule::insert($schedules);
    }
}
