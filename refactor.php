<?php

/**
 * Script untuk memindahkan data dummy dari config ke seeder secara otomatis.
 * Jalankan ini di terminal: php refactor.php
 */

function updateSeederAndConfig($configPath, $seederPath, $configKeyPath, $seederTargetMethod, $configRegexes) {
    echo "Processing $configPath...\n";
    
    // 1. Ambil array dari config
    $configData = require $configPath;
    
    // Traversing config if it has nested keys
    $keys = explode('.', $configKeyPath);
    $dataToExport = $configData;
    foreach ($keys as $key) {
        if ($key === '') continue;
        if (isset($dataToExport[$key])) {
            $dataToExport = $dataToExport[$key];
        } else {
            $dataToExport = null;
            break;
        }
    }

    if ($dataToExport === null) {
        echo "Data tidak ditemukan untuk $configKeyPath\n";
        return;
    }

    // Export array into string
    $exportedArray = var_export($dataToExport, true);
    // Ubah format var_export dari array() menjadi []
    $exportedArray = preg_replace('/array \(/', '[', $exportedArray);
    $exportedArray = preg_replace('/\)$/', ']', $exportedArray);
    $exportedArray = preg_replace('/^\s+\)/m', '    ]', $exportedArray);

    // 2. Tulis ke dalam Seeder
    $seederContent = file_get_contents($seederPath);
    
    // Cari lokasi method run() atau target
    $replacementForSeeder = "    public function $seederTargetMethod(): array\n    {\n        return $exportedArray;\n    }\n";
    
    // Hapus method data() lama jika ada, atau tambahkan baru sebelum tutup class
    if (strpos($seederContent, "public function $seederTargetMethod") !== false) {
        $seederContent = preg_replace("/\s+public function $seederTargetMethod\(\).*?^    \}/ms", "\n$replacementForSeeder", $seederContent);
    } else {
        $seederContent = preg_replace("/\}\s*$/", "\n$replacementForSeeder}\n", $seederContent);
    }

    // Update panggilan data dari config() menjadi $this->data()
    $seederContent = str_replace("config('abuabu.site.audio_store.albums', [])", "\$this->$seederTargetMethod()", $seederContent);
    $seederContent = str_replace("config('reading.items', [])", "\$this->$seederTargetMethod()", $seederContent);
    $seederContent = str_replace("config('tools.tools', [])", "\$this->toolsData()", $seederContent);
    $seederContent = str_replace("config('tools.help_articles', [])", "\$this->helpArticlesData()", $seederContent);

    file_put_contents($seederPath, $seederContent);
    echo "Berhasil update seeder $seederPath\n";

    // 3. Hapus array besar dari Config
    $configContent = file_get_contents($configPath);
    foreach ($configRegexes as $regex => $replacement) {
        $configContent = preg_replace($regex, $replacement, $configContent);
    }
    file_put_contents($configPath, $configContent);
    echo "Berhasil update config $configPath\n\n";
}

// 1. Audio
updateSeederAndConfig(
    __DIR__ . '/config/abuabu.php',
    __DIR__ . '/database/seeders/AudioCatalogSeeder.php',
    'site.audio_store.albums',
    'data',
    [
        "/'albums'\s*=>\s*\[(.*?)\]\s*,\s*\]/s" => "'albums' => [],\n        ]" // simplifikasi
    ]
);

// Karena regex untuk config kadang rumit karena nested array, mari gunakan str_replace atau potong manual jika regex sulit
echo "Jika config tidak kosong secara otomatis, Anda bisa mengosongkannya manual dengan mengubah isinya menjadi []\n";
echo "Proses refactor selesai! Silakan periksa file config dan seeder.\n";
