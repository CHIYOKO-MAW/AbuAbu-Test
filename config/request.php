<?php

return [
    'brand' => [
        'title' => 'ABU-ABU REQUEST',
        'subtitle' => 'Control room for intake, review, and publishing handoff.',
    ],

    'utility_nav' => [
        ['label' => 'Queue', 'href' => '#queue'],
        ['label' => 'Rules', 'href' => '#rules'],
        ['label' => 'Submit', 'href' => '#submit'],
        ['label' => 'Status', 'href' => '#status'],
    ],

    'hero' => [
        'eyebrow' => 'Request / control room',
        'title' => 'Masukkan request ke sistem yang rapi, lalu biarkan antriannya terbaca.',
        'copy' => 'Halaman request dibuat seperti intake dashboard: status jelas, aturan jelas, dan struktur pengisian cukup rapi untuk nanti dipasang ke backend.',
    ],

    'status_strip' => [
        ['label' => 'open lanes', 'value' => '03'],
        ['label' => 'review states', 'value' => '04'],
        ['label' => 'active intake', 'value' => 'online'],
    ],

    'steps' => [
        [
            'title' => 'Tulis kebutuhan',
            'copy' => 'Sebutkan item, sumber awal, dan shelf yang paling cocok.',
        ],
        [
            'title' => 'Masuk review',
            'copy' => 'Request masuk ke antrian untuk dicek sumber, hak, dan bentuk packaging-nya.',
        ],
        [
            'title' => 'Publish shell',
            'copy' => 'Kalau lolos, request dipindah ke reading, audio, atau tools dengan metadata yang lebih rapi.',
        ],
    ],

    'queue_states' => [
        [
            'title' => 'Pending review',
            'meta' => 'Stage 01',
            'copy' => 'Intake baru yang masih menunggu pengecekan sumber dan kategori.',
        ],
        [
            'title' => 'Need source check',
            'meta' => 'Stage 02',
            'copy' => 'Permintaan yang butuh verifikasi file, mirror, atau konteks lisensi.',
        ],
        [
            'title' => 'Ready for shelf',
            'meta' => 'Stage 03',
            'copy' => 'Sudah lolos review dan siap dipasang ke kategori yang sesuai.',
        ],
    ],

    'rules' => [
        'Request harus punya sumber awal, konteks file, atau catatan asal yang bisa dibaca.',
        'Item baru nanti harus bisa dipetakan ke reading, audio, atau tools tanpa bikin taxonomy berantakan.',
        'Metadata dasar seperti nama item, jenis file, platform, dan catatan instalasi harus bisa dibaca cepat.',
        'Queue dibuat transparan supaya nanti mudah dipindah ke backend atau workflow admin.',
    ],

    'request_types' => [
        'Reading / E-book / Journal',
        'Audio / Album / Track pack',
        'Tools / Utility / Game archive',
        'Custom mirror / metadata cleanup',
    ],

    'priority_tabs' => ['Normal', 'Review fast', 'Large archive'],

    'form_fields' => [
        ['label' => 'Request title', 'placeholder' => 'Contoh: Calm Browsing Patterns EPUB / Glass Harbor VR update'],
        ['label' => 'Category', 'placeholder' => 'Reading, Audio, Tools, atau Queue cleanup'],
        ['label' => 'Source context', 'placeholder' => 'Tulis singkat asal item, format, dan catatan yang perlu dicek'],
        ['label' => 'Notes', 'placeholder' => 'Catatan tambahan: format file, platform, mirror, metadata, atau hal yang perlu dicek'],
    ],

    'lanes' => [
        [
            'title' => 'Intake lane',
            'copy' => 'Tempat request baru masuk sebelum dicocokkan dengan kategori dan metadata.',
        ],
        [
            'title' => 'Review lane',
            'copy' => 'Dipakai untuk cek source, rights context, file shape, dan readiness.',
        ],
        [
            'title' => 'Publish lane',
            'copy' => 'Request yang sudah siap dipindah jadi item katalog dengan card dan detail page.',
        ],
    ],
];
