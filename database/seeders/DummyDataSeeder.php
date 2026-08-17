<?php

namespace Database\Seeders;

use App\Models\Children;
use App\Models\Quiz;
use App\Models\User;
use App\Models\WhoStandard;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Mengisi data dummy yang realistis (orang Indonesia) supaya aplikasi
 * terlihat seperti sudah dipakai oleh banyak orang tua: akun ibu, data anak,
 * riwayat pengukuran (z-score dihitung konsisten dengan MeasurementController),
 * kebiasaan makan, catatan ibu, dan hasil pretest/posttest.
 *
 * Idempoten: data hasil seeding sebelumnya dihapus dulu berdasarkan penanda
 * pada kolom remember_token (tidak tampil di UI), lalu dibuat ulang. Cascade
 * FK membersihkan children, measurements, feeding_habits, notes, dan
 * quiz_results. Email dummy memakai @gmail.com agar terlihat seperti user asli.
 *
 * Jalankan: php artisan db:seed --class=DummyDataSeeder
 */
class DummyDataSeeder extends Seeder
{
    /** Domain email dummy (tampil seperti user asli). */
    private const EMAIL_DOMAIN = 'gmail.com';

    /** Penanda pada remember_token agar data dummy bisa dibersihkan & dibuat ulang. */
    private const MARKER_TOKEN = 'dummy-seeder';

    /** Password yang sama untuk semua akun dummy (di-hash otomatis oleh model). */
    private const DUMMY_PASSWORD = 'password';

    private const PARENT_COUNT = 20;

    /* ----------------------------- Kumpulan data ---------------------------- */

    private array $femaleNames = [
        'Siti', 'Nur', 'Dewi', 'Ayu', 'Putri', 'Sri', 'Wati', 'Endang', 'Yuni',
        'Rina', 'Fitri', 'Indah', 'Maya', 'Sari', 'Ratna', 'Yanti', 'Sumiati',
        'Wulan', 'Ningsih', 'Rahma', 'Tiara', 'Lina', 'Mega', 'Okta', 'Vina',
        'Zahra', 'Marlina', 'Ika', 'Lastri', 'Yuliani', 'Tuti', 'Aminah', 'Rosmiati',
        'Yeyen', 'Lis', 'Dwi', 'Enung', 'Kartini', 'Musrifah', 'Nurhaliza',
    ];

    private array $maleNames = [
        'Budi', 'Agus', 'Andi', 'Eko', 'Hadi', 'Joko', 'Kurnia', 'Lukman',
        'Rudi', 'Slamat', 'Taufik', 'Usman', 'Wahyu', 'Yusuf', 'Asep', 'Bambang',
        'Hendra', 'Nurdin', 'Mansyur', 'Dedi',
    ];

    private array $lastNames = [
        'Wijaya', 'Santoso', 'Pratama', 'Hartono', 'Susilo', 'Nugroho', 'Kusuma',
        'Safitri', 'Anggraini', 'Maulana', 'Setiawan', 'Permata', 'Cahyani',
        'Oktaviani', 'Ramadhan', 'Handayani', 'Lestari', 'Wulandari', 'Fatimah',
        'Siregar', 'Simanjuntak', 'Pratiwi', 'Utami', 'Saputri', 'Halimah',
    ];

    private array $childNames = [
        'Aisyah', 'Arka', 'Bima', 'Bunga', 'Cinta', 'Dafa', 'Dimas', 'Fajar',
        'Galang', 'Hanif', 'Jihan', 'Kirana', 'Malik', 'Nabil', 'Naya', 'Putri',
        'Qori', 'Rafa', 'Rangga', 'Salfa', 'Sasa', 'Tegar', 'Umar', 'Vania',
        'Yusuf', 'Zahra', 'Zidan', 'Raihan', 'Kenzo', 'Calya', 'Kinara', 'Naira',
        'Sekar', 'Mahesa', 'Pradnya', 'Abimanyu', 'Kirea', 'Aleta', 'Rania', 'Dafa',
    ];

    private array $cities = [
        'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Medan',
        'Makassar', 'Bogor', 'Bekasi', 'Depok', 'Tangerang', 'Malang', 'Surakarta',
        'Denpasar', 'Palembang', 'Balikpapan', 'Cirebon', 'Tasikmalaya', 'Padang', 'Banjarmasin',
    ];

    private array $streets = [
        'Melati', 'Kenanga', 'Mawar', 'Anggrek', 'Flamboyan', 'Kamboja', 'Cempaka',
        'Dahlia', 'Seroja', 'Bougenville', 'Teratai', 'Beringin', 'Cendana', 'Mahoni',
        'Pahlawan', 'Merdeka', 'Diponegoro', 'Ahmad Yani', 'Gajah Mada', 'Sudirman',
    ];

    /** Pasangan makanan: [nama, URT, kandungan gizi]. */
    private array $foods = [
        ['Nasi Putih', '1 porsi kecil', 'Karbohidrat'],
        ['Nasi Merah', '1 mangkok', 'Karbohidrat'],
        ['Ayam Goreng', '1 potong', 'Protein'],
        ['Telur Rebus', '1 butir', 'Protein'],
        ['Tempe Goreng', '2 potong', 'Protein'],
        ['Tahu Rebus', '1 buah', 'Protein'],
        ['Ikan Bakar', '1 potong', 'Protein & Omega-3'],
        ['Sayur Bayam', '1 mangkok', 'Serat & Zat Besi'],
        ['Sayur Asem', '1 mangkok', 'Serat & Vitamin'],
        ['Sup Wortel', '1 mangkok', 'Vitamin A'],
        ['Cah Kangkung', '1 mangkok', 'Serat & Vitamin'],
        ['Pisang', '1 buah', 'Kalium & Karbohidrat'],
        ['Pepaya', '1 potong', 'Serat & Vitamin'],
        ['Jeruk', '1 buah', 'Vitamin C'],
        ['Brokoli Rebus', '1 mangkok', 'Vitamin & Serat'],
        ['Susu Formula', '1 gelas (200 ml)', 'Protein & Kalsium'],
        ['Susu Sapi', '1 gelas (200 ml)', 'Protein & Kalsium'],
        ['Kentang Rebus', '1 buah sedang', 'Karbohidrat'],
        ['Jagung Manis', '1 buah', 'Karbohidrat & Serat'],
        ['Bubur Ayam', '1 mangkok', 'Karbohidrat & Protein'],
        ['Pisang Kukus', '1 buah', 'Kalium & Karbohidrat'],
        ['Roti Gandum', '1 lembar', 'Karbohidrat'],
    ];

    private array $foodConsumed = [
        'Semua dihabiskan dengan lahap',
        'Nasi setengah porsi, lauk habis',
        'Sayur sedikit tersisa, sisanya habis',
        'Dihabiskan sekitar 3/4 porsi',
        'Hanya mau makan lauknya saja',
        'Dipancing-pancing baru mau setengah porsi',
        'Semua habis, minta ditambah buah',
        'Nasi dan lauk habis, sayur ditinggal',
    ];

    private array $keluhan = [
        'Anak susah makan sayur hari ini.',
        'Batuk-pilek sejak kemarin, nafsu makan berkurang.',
        'Sering minta camilan sebelum makan.',
        'Anak sedang tumbuh gigi jadi rewel saat makan.',
        'Maunya minum susu terus, makan berkurang.',
        'Mual pagi tadi, siangnya sudah mau makan.',
        'Sembelit dua hari terakhir.',
        'Muntah setelah makan ikan.',
        'Tidak ada keluhan, nafsu makan baik.',
        'Agak demam, makannya sedikit.',
    ];

    private array $vegFruitFreq = ['Setiap hari', '4-5 kali/minggu', '2-3 kali/minggu', 'Saat akhir pekan saja', 'Jarang'];
    private array $milkFreq = ['Setiap hari (2 gelas)', 'Setiap hari (1 gelas)', '3-4 kali/minggu', 'Jarang', 'Sudah tidak minum susu'];
    private array $snackFreq = ['Setiap hari', '3-4 kali/minggu', '1-2 kali/minggu', 'Jarang', 'Tidak pernah'];

    /** @var array<string,int> email yang sudah dipakai agar unik */
    private array $usedEmails = [];

    /* --------------------------------- Run --------------------------------- */

    public function run(): void
    {
        $this->command->info('Membersihkan data dummy sebelumnya ...');
        // Penanda sekarang di remember_token; @dummy.id dipakai seeder versi
        // lama, dibersihkan juga sekali agar tidak tersisa.
        $removed = User::where('remember_token', self::MARKER_TOKEN)
            ->orWhere('email', 'like', '%@dummy.id')
            ->delete();
        $this->command->info("  -> {$removed} user dummy lama dihapus (cascade membersihkan data terkait).");

        // Struktur quiz: maksimum skor per (konten, tipe) = jumlah soal.
        $quizInfo = Quiz::selectRaw('education_content_id, type, count(*) as c')
            ->groupBy('education_content_id', 'type')->get();
        $maxByContent = [];
        foreach ($quizInfo as $q) {
            $maxByContent[$q->education_content_id][$q->type] = (int) $q->c;
        }
        $contentIds = array_keys($maxByContent);

        $stats = ['users' => 0, 'children' => 0, 'measurements' => 0, 'feeding' => 0, 'notes' => 0, 'quizzes' => 0];

        for ($i = 0; $i < self::PARENT_COUNT; $i++) {
            $parent = $this->createParentUser();

            $numChildren = random_int(1, 2);
            $childNames = $this->pickDistinct($this->childNames, $numChildren);

            foreach ($childNames as $childName) {
                $child = $this->createChild($parent, $childName);
                $stats['children']++;
                $stats['measurements'] += $this->seedMeasurements($child);
                $stats['feeding'] += $this->seedFeedingHabits($child);
            }

            $stats['notes'] += $this->seedNotes($parent);
            $stats['quizzes'] += $this->seedQuizResults($parent, $contentIds, $maxByContent);
            $stats['users']++;
        }

        $this->command->info('Selesai.');
        $this->command->info(sprintf(
            'Dibuat: %d user, %d anak, %d pengukuran, %d kebiasaan makan, %d catatan ibu, %d hasil kuis.',
            $stats['users'], $stats['children'], $stats['measurements'], $stats['feeding'], $stats['notes'], $stats['quizzes']
        ));
        $this->command->info('Login contoh: ' . $this->firstDummyEmail() . ' / ' . self::DUMMY_PASSWORD);
    }

    /* ------------------------------- Entities ------------------------------ */

    private function createParentUser(): User
    {
        $isMother = (bool) random_int(0, 1);
        $first = $isMother
            ? $this->femaleNames[array_rand($this->femaleNames)]
            : $this->maleNames[array_rand($this->maleNames)];
        $last = $this->lastNames[array_rand($this->lastNames)];

        $name = "{$first} {$last}";
        $email = $this->uniqueEmail($first, $last);
        $city = $this->cities[array_rand($this->cities)];
        $street = $this->streets[array_rand($this->streets)];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => self::DUMMY_PASSWORD,
            'role' => 'user',
            'phone' => $this->indonesianPhone(),
            'address' => sprintf('Jl. %s No. %d, RT %02d/RW %02d, %s', $street, random_int(1, 120), random_int(1, 12), random_int(1, 10), $city),
        ]);

        // Penanda dummy — remember_token tidak masuk $fillable, jadi di-set
        // lewat property assignment (kolom ini tidak pernah tampil di UI).
        $user->remember_token = self::MARKER_TOKEN;
        $user->save();

        return $user;
    }

    private function createChild(User $parent, string $name): Children
    {
        $gender = random_int(0, 1) ? 'laki-laki' : 'perempuan';
        // Usia saat ini 8-58 bulan agar selalu masuk rentang WHO & menarik.
        $currentMonths = random_int(8, 58);
        $birthDate = Carbon::today()->subMonths($currentMonths)->subDays(random_int(0, 27));

        return Children::create([
            'parent_id' => $parent->id,
            'name' => $name,
            'birth_date' => $birthDate->toDateString(),
            'gender' => $gender,
        ]);
    }

    /**
     * Membuat beberapa riwayat pengukuran untuk seorang anak, dengan z-score &
     * status yang dihitung konsisten dengan MeasurementController (menggunakan
     * tabel who_standards). created_at disebar 6 bulan terakhir supaya grafik
     * dashboard terisi.
     *
     * @return int jumlah baris yang benar-benar dibuat
     */
    private function seedMeasurements(Children $child): int
    {
        $birth = Carbon::parse($child->birth_date);
        $now = Carbon::now();
        $totalMonthsAtNow = (int) $birth->diffInMonths($now);

        $startM = 3;
        $endM = max($startM, $totalMonthsAtNow);
        $k = random_int(3, 6);
        $months = $this->spreadMonths($startM, $endM, $k);

        $rows = [];
        foreach ($months as $m) {
            $measuredAt = $birth->copy()->addMonths($m)->addDays(random_int(-5, 5));
            if ($measuredAt->gt($now)) {
                $measuredAt = $now->copy()->subDays(random_int(1, 20));
            }

            $row = $this->computeMeasurementRow($child, $measuredAt);
            if (!$row) {
                continue;
            }

            $created = $now->copy()->subDays(random_int(0, 180))
                ->setTime(random_int(7, 20), random_int(0, 59), random_int(0, 59));
            $row['created_at'] = $created;
            $row['updated_at'] = $created;
            $rows[] = $row;
        }

        if ($rows) {
            DB::table('measurements')->insert($rows);
        }
        return count($rows);
    }

    private function seedFeedingHabits(Children $child): int
    {
        $now = Carbon::now();
        $count = random_int(1, 2);
        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $filled = $now->copy()->subDays(random_int(1, 90));
            $rows[] = [
                'child_id' => $child->id,
                'filled_at' => $filled->toDateString(),
                'meals_per_day' => random_int(3, 5),
                'veg_fruit_freq' => $this->vegFruitFreq[array_rand($this->vegFruitFreq)],
                'milk_freq' => $this->milkFreq[array_rand($this->milkFreq)],
                'snack_freq' => $this->snackFreq[array_rand($this->snackFreq)],
                'created_at' => $filled,
                'updated_at' => $filled,
            ];
        }
        DB::table('feeding_habits')->insert($rows);
        return $count;
    }

    private function seedNotes(User $parent): int
    {
        $now = Carbon::now();
        $count = random_int(3, 6);
        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $when = $now->copy()->subDays(random_int(1, 170));

            // Pilih makanan dulu, lalu susun menu darinya supaya konsisten
            // dengan baris detail (seperti inputan user asli).
            $picked = $this->pickDistinct($this->foods, random_int(2, 4));
            $items = [];
            $names = [];
            foreach ($picked as $food) {
                $items[] = ['makanan' => $food[0], 'urt' => $food[1], 'gizi' => $food[2]];
                $names[] = $food[0];
            }
            $menu = count($names) > 2
                ? implode(', ', array_slice($names, 0, -1)) . ', dan ' . end($names)
                : implode(' dan ', $names);

            // ~45% catatan ada keluhan.
            $keluhan = random_int(1, 100) <= 45
                ? $this->keluhan[array_rand($this->keluhan)]
                : null;

            $rows[] = [
                'user_id' => $parent->id,
                'food_menu' => $menu,
                'food_consumed' => $this->foodConsumed[array_rand($this->foodConsumed)],
                'items' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'photo' => null,
                'keluhan' => $keluhan,
                'created_at' => $when,
                'updated_at' => $when,
            ];
        }
        DB::table('notes')->insert($rows);
        return $count;
    }

    /**
     * @param array<int> $contentIds
     * @param array<int,array<string,int>> $maxByContent
     */
    private function seedQuizResults(User $parent, array $contentIds, array $maxByContent): int
    {
        if (!$contentIds) {
            return 0;
        }

        $pickCount = random_int(1, min(3, count($contentIds)));
        $chosen = $this->pickDistinctValues($contentIds, $pickCount);
        $now = Carbon::now();
        $count = 0;

        foreach ($chosen as $cid) {
            $max = $maxByContent[$cid] ?? [];
            $maxPre = $max['pretest'] ?? 0;
            $maxPost = $max['posttest'] ?? 0;

            $preScore = 0;
            if ($maxPre > 0) {
                $preScore = random_int(0, $maxPre);
                $this->insertQuizResult($parent->id, $cid, 'pretest', $preScore, $now->copy()->subDays(random_int(1, 160)));
                $count++;
            }
            // Tidak semua langsung lanjut ke posttest.
            if ($maxPost > 0 && (bool) random_int(0, 1)) {
                $postScore = min($maxPost, $preScore + random_int(1, $maxPost));
                $this->insertQuizResult($parent->id, $cid, 'posttest', $postScore, $now->copy()->subDays(random_int(0, 150)));
                $count++;
            }
        }
        return $count;
    }

    private function insertQuizResult(int $userId, int $contentId, string $type, int $score, Carbon $when): void
    {
        // updateOrCreate agar tidak dobel bila sudah ada (mis. akun lama).
        DB::table('quiz_results')->updateOrInsert(
            ['user_id' => $userId, 'education_content_id' => $contentId, 'type' => $type],
            ['score' => $score, 'created_at' => $when, 'updated_at' => $when]
        );
    }

    /* ---------------------- Perhitungan z-score (mirip controller) -------- */

    /**
     * Mengembalikan satu baris pengukuran dengan z-score & status yang konsisten
     * dengan MeasurementController. Mengembalikan null bila data WHO tak tersedia
     * untuk kombinasi usia/tinggi tertentu.
     *
     * @return array<string,mixed>|null
     */
    private function computeMeasurementRow(Children $child, Carbon $measuredAt): ?array
    {
        $gender = $child->gender;
        $birth = Carbon::parse($child->birth_date);
        $ageInDays = (int) $birth->diffInDays($measuredAt);
        if ($ageInDays < 60 || $ageInDays > 1856) {
            return null;
        }

        $ageMonths = (int) floor($ageInDays / 30.4375);
        $isLength = $ageMonths < 24;
        $bbtbIndicator = $isLength ? 'length' : 'height';

        $sTbU = WhoStandard::getStandard($ageInDays, $gender, 'height');
        $sBbU = WhoStandard::getStandard($ageInDays, $gender, 'weight');
        if (!$sTbU || !$sBbU) {
            return null;
        }

        // Sampel target z-score (sedikit bias negatif mencerminkan kondisi nyata).
        $zH = $this->clamp($this->gauss(-0.5, 1.0), -2.8, 2.8);
        $zW = $this->clamp($this->gauss(-0.4, 1.0), -2.8, 2.8);

        // Tinggi dari standar TB/U (linear pada simpang baku).
        $sdH = ((float) $sTbU->SD1 - (float) $sTbU->SD1neg) / 2;
        $height = round((float) $sTbU->M + $zH * $sdH, 1);
        [$hMin, $hMax] = $isLength ? [45.0, 110.0] : [65.0, 120.0];
        $height = (float) max($hMin, min($hMax, $height));

        // Berat dari inversi LMS standar BB/U.
        $L = (float) $sBbU->L;
        $M = (float) $sBbU->M;
        $S = (float) $sBbU->S;
        $base = 1 + $L * $S * $zW;
        if ($base <= 0) {
            $base = 0.0001;
        }
        $weight = $M * pow($base, 1 / $L);
        $weight = round(max(5.0, min(25.0, $weight)), 1); // batas validasi controller: 5-25 kg

        // Hitung ulang z-score dari nilai akhir (konsisten dgn controller).
        $zTbU = (float) $sTbU->calculateZScoreTbU($height);
        $zBbU = (float) $sBbU->calculateZScoreBbU($weight);

        $sBbTb = $this->nearestBbTb($height, $gender, $bbtbIndicator);
        if (!$sBbTb) {
            return null;
        }
        $zBbTb = (float) $sBbTb->calculateZScoreBbTb($weight);

        return [
            'child_id' => $child->id,
            'measured_at' => $measuredAt->toDateString(),
            'weight_kg' => $weight,
            'height_cm' => $height,
            'zscore_bb_u' => round($zBbU, 2),
            'bb_u_status' => $this->statusBbU($zBbU),
            'zscore_tb_u' => round($zTbU, 2),
            'tb_u_status' => $this->statusTbU($zTbU),
            'zscore_bb_tb' => round($zBbTb, 2),
            'bb_tb_status' => $this->statusBbTb($zBbTb),
        ];
    }

    private function nearestBbTb(float $height, string $gender, string $indicator)
    {
        $exact = WhoStandard::getBbTbStandard($height, $gender, $indicator);
        if ($exact) {
            return $exact;
        }
        // Fallback: ambil length/height terdekat pada grid 0.1 cm.
        return DB::table('who_standards')
            ->where('indicator', $indicator)
            ->where('gender', $gender)
            ->whereNotNull('length_height_value')
            ->orderByRaw('ABS(length_height_value - ?)', [$height])
            ->first();
    }

    private function statusBbU(float $z): string
    {
        if ($z < -3) return 'Berat Badan Sangat Kurang';
        if ($z < -2) return 'Berat Badan Kurang';
        if ($z <= 1) return 'Berat Badan Normal';
        return 'Risiko Berat Badan Lebih';
    }

    private function statusTbU(float $z): string
    {
        if ($z < -3) return 'Sangat Pendek';
        if ($z < -2) return 'Pendek';
        if ($z <= 3) return 'Normal';
        return 'Tinggi';
    }

    private function statusBbTb(float $z): string
    {
        if ($z < -3) return 'Gizi Buruk';
        if ($z < -2) return 'Gizi Kurang';
        if ($z <= 1) return 'Gizi Baik (Normal)';
        if ($z <= 2) return 'Berisiko Gizi Lebih';
        if ($z <= 3) return 'Gizi Lebih';
        return 'Obesitas';
    }

    /* ------------------------------ Utilities ----------------------------- */

    /** Distribusi normal (Box–Muller) — random tersedia di PHP seeder. */
    private function gauss(float $mean, float $sd): float
    {
        $u1 = mt_rand(1, PHP_INT_MAX - 1) / PHP_INT_MAX;
        $u2 = mt_rand(1, PHP_INT_MAX - 1) / PHP_INT_MAX;
        $z = sqrt(-2.0 * log($u1)) * cos(2.0 * M_PI * $u2);
        return $mean + $sd * $z;
    }

    private function clamp(float $v, float $min, float $max): float
    {
        return max($min, min($max, $v));
    }

    /** @return int[] nilai bulan menanjak di [$min,$max] */
    private function spreadMonths(int $min, int $max, int $count): array
    {
        $max = max($min, $max);
        $span = $max - $min + 1;
        $count = min($count, $span);
        if ($count <= 0) {
            return [];
        }
        $step = $count <= 1 ? 0 : ($span - 1) / ($count - 1);
        $out = [];
        for ($i = 0; $i < $count; $i++) {
            $out[] = (int) round($min + $step * $i);
        }
        $out = array_values(array_unique($out));
        sort($out);
        return $out;
    }

    /**
     * Ambil sejumlah elemen unik dari array terindeks.
     * @return array<int,mixed>
     */
    private function pickDistinct(array $pool, int $n): array
    {
        $n = min($n, count($pool));
        $keys = (array) array_rand($pool, max(1, $n));
        $out = [];
        foreach ($keys as $k) {
            $out[] = $pool[$k];
        }
        return $out;
    }

    /** @param array<int,int> $values */
    private function pickDistinctValues(array $values, int $n): array
    {
        return $this->pickDistinct(array_values($values), $n);
    }

    private function uniqueEmail(string $first, string $last): string
    {
        $base = strtolower($this->slug($first) . '.' . $this->slug($last));
        $email = "{$base}@" . self::EMAIL_DOMAIN;
        $i = 2;
        while (isset($this->usedEmails[$email])) {
            $email = "{$base}{$i}@" . self::EMAIL_DOMAIN;
            $i++;
        }
        $this->usedEmails[$email] = true;
        return $email;
    }

    private function firstDummyEmail(): string
    {
        $keys = array_keys($this->usedEmails);
        return $keys ? $keys[0] : '(-)';
    }

    private function slug(string $text): string
    {
        $text = strtolower($text);
        $text = str_replace([' ', '.', ','], '-', $text);
        return preg_replace('/[^a-z0-9\-]/', '', $text) ?? $text;
    }

    private function indonesianPhone(): string
    {
        $prefix = ['0812', '0813', '0821', '0822', '0852', '0856', '0857', '0878', '0838', '0896'];
        $p = $prefix[array_rand($prefix)];
        return $p . '-' . str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
    }
}
