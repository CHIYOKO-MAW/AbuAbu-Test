<?php

return [
    'brand' => [
        'name' => 'Abu-Abu',
        'description' => 'A quiet archive for reading rooms, audio shelves, tool desks, and strange requests.',
        'tagline' => 'Quiet shelves. Unclear edges.',
    ],

    'navigation' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Browse', 'href' => '/browse'],
        ['label' => 'Request', 'href' => '/request'],
    ],

    'hero' => [
        'eyebrow' => 'Curated cloud archive',
        'title' => 'A moody shell for very real, very readable collections.',
        'lead' => 'Abu-Abu keeps ebooks, journals, lossless music, and tool shelves in one soft-dark interface that feels a little strange, but stays easy to scan.',
        'primary_cta' => [
            'label' => 'Browse archive',
            'href' => '/browse',
        ],
        'secondary_cta' => [
            'label' => 'Open request queue',
            'href' => '/request',
        ],
        'stats' => [
            ['value' => '4', 'label' => 'curated shelves'],
            ['value' => '12', 'label' => 'mirror-ready slots'],
            ['value' => '24/7', 'label' => 'readable UI'],
        ],
        'aside' => [
            'eyebrow' => 'Signal snapshot',
            'title' => 'Absurd by design, disciplined by layout.',
            'description' => 'The system is intentionally offbeat, but the hierarchy stays clean so people can find things fast.',
            'chips' => [
                'Dark-soft palette',
                'Rounded cards',
                'Fast scan',
            ],
        ],
    ],

    'categories' => [
        [
            'title' => 'Ebook / Journal',
            'slug' => 'ebooks',
            'description' => 'Long-form reading, reference material, and research-friendly shelves.',
            'meta' => 'Reading',
            'accent' => 'violet',
            'icon' => 'EJ',
        ],
        [
            'title' => 'Lossless Music',
            'slug' => 'music',
            'description' => 'High-fidelity audio with tidy metadata and album-friendly browsing.',
            'meta' => 'Audio',
            'accent' => 'teal',
            'icon' => 'LM',
        ],
        [
            'title' => 'Software Tools',
            'slug' => 'software',
            'description' => 'Companion utilities, recovery notes, and install-ready packs.',
            'meta' => 'Tools',
            'accent' => 'amber',
            'icon' => 'SW',
        ],
        [
            'title' => 'Custom Request',
            'slug' => 'request',
            'description' => 'Drop a request and let the queue sort it into the right shelf.',
            'meta' => 'Queue',
            'accent' => 'rose',
            'icon' => 'RQ',
        ],
    ],

    'featured' => [
        [
            'title' => 'Modern Research Bundle',
            'description' => 'A compact reading pack for architecture, tradeoffs, and practical product thinking.',
            'meta' => 'Ebook / Journal',
            'tag' => 'New drop',
            'accent' => 'violet',
        ],
        [
            'title' => 'Late Night Sessions',
            'description' => 'A lossless playlist shelf with a calm pace, crisp lows, and room to breathe.',
            'meta' => 'Lossless Music',
            'tag' => 'Fresh mirror',
            'accent' => 'teal',
        ],
        [
            'title' => 'Workspace Utility Kit',
            'description' => 'A neat collection of helpers for everyday workflows and repetitive tasks.',
            'meta' => 'Software Tools',
            'tag' => 'Stable',
            'accent' => 'amber',
        ],
        [
            'title' => 'Request Queue Preview',
            'description' => 'A simple intake card for things that should exist but have not been sorted yet.',
            'meta' => 'Custom Request',
            'tag' => 'Waiting',
            'accent' => 'rose',
        ],
    ],

    'providers' => [
        [
            'name' => 'Cloudflare R2',
            'status' => 'Primary mirror',
            'accent' => 'violet',
        ],
        [
            'name' => 'Backblaze B2',
            'status' => 'Cold storage',
            'accent' => 'teal',
        ],
        [
            'name' => 'S3 Mirror',
            'status' => 'Fast access',
            'accent' => 'amber',
        ],
        [
            'name' => 'Private Vault',
            'status' => 'Restricted',
            'accent' => 'rose',
        ],
    ],

    'browse_sections' => [
        [
            'slug' => 'ebooks',
            'title' => 'Ebook / Journal',
            'eyebrow' => 'Reading shelf',
            'description' => 'Books, journal-style notes, and structured references.',
            'items' => [
                [
                    'title' => 'Foundations of Systems Design',
                    'description' => 'A long-form reading pack for architecture, tradeoffs, and practical product thinking.',
                    'meta' => 'PDF • 42 min read',
                    'tag' => 'Curated',
                    'accent' => 'violet',
                ],
                [
                    'title' => 'Research Notes Volume 08',
                    'description' => 'A journal bundle with clean indexing for quick scans and deep dives.',
                    'meta' => 'Journal • 18 entries',
                    'tag' => 'Indexed',
                    'accent' => 'teal',
                ],
                [
                    'title' => 'Type-Heavy Reading List',
                    'description' => 'A compact shelf of practical reading with a focus on clear execution.',
                    'meta' => 'Ebook • 12 chapters',
                    'tag' => 'Popular',
                    'accent' => 'amber',
                ],
                [
                    'title' => 'Archive Companion Notes',
                    'description' => 'A small set of support materials for users who want a fast overview first.',
                    'meta' => 'Notes • 9 pages',
                    'tag' => 'Quick scan',
                    'accent' => 'rose',
                ],
            ],
        ],
        [
            'slug' => 'music',
            'title' => 'Lossless Music',
            'eyebrow' => 'Audio shelf',
            'description' => 'High-fidelity listening, neatly grouped for people who care about detail.',
            'items' => [
                [
                    'title' => 'Midnight Tape Remasters',
                    'description' => 'Warm, clean masters with a soft edge and consistent levels.',
                    'meta' => 'FLAC • 14 tracks',
                    'tag' => 'Hi-fi',
                    'accent' => 'teal',
                ],
                [
                    'title' => 'Quiet Room Sessions',
                    'description' => 'A low-noise listening set made for focus, not volume wars.',
                    'meta' => 'ALAC • 11 tracks',
                    'tag' => 'Calm',
                    'accent' => 'violet',
                ],
                [
                    'title' => 'Analog Drift Collection',
                    'description' => 'Lossless files with careful tagging and album art that stays intact.',
                    'meta' => 'FLAC • 9 albums',
                    'tag' => 'Tagged',
                    'accent' => 'amber',
                ],
                [
                    'title' => 'After Hours B-Sides',
                    'description' => 'A smaller shelf of deep cuts for late-night browsing and repeat plays.',
                    'meta' => 'WAV • 7 releases',
                    'tag' => 'Deep cut',
                    'accent' => 'rose',
                ],
            ],
        ],
        [
            'slug' => 'software',
            'title' => 'Software Tools',
            'eyebrow' => 'Utility shelf',
            'description' => 'Utility shelves and companion apps with a clean install path.',
            'items' => [
                [
                    'title' => 'Workspace Utility Kit',
                    'description' => 'Everyday helpers for notes, file handling, and lightweight automation.',
                    'meta' => 'Desktop • 6 apps',
                    'tag' => 'Stable',
                    'accent' => 'amber',
                ],
                [
                    'title' => 'Creative Toolkit Pack',
                    'description' => 'Utilities for editors, designers, and other visually demanding jobs.',
                    'meta' => 'Desktop • 8 apps',
                    'tag' => 'Creative',
                    'accent' => 'violet',
                ],
                [
                    'title' => 'Command Line Extras',
                    'description' => 'Small tools for people who like fast workflows and fewer clicks.',
                    'meta' => 'CLI • 15 tools',
                    'tag' => 'Lean',
                    'accent' => 'teal',
                ],
                [
                    'title' => 'Support Companion Suite',
                    'description' => 'Internal helpers, docs, and install notes that keep the shelf tidy.',
                    'meta' => 'Bundle • 5 guides',
                    'tag' => 'Docs',
                    'accent' => 'rose',
                ],
            ],
        ],
    ],

    'request' => [
        'eyebrow' => 'Request queue',
        'title' => 'Tell us what should exist next.',
        'description' => 'The intake shell gives new requests enough structure to keep the queue tidy once backend support lands.',
        'steps' => [
            'Describe the item and the source context.',
            'Choose the shelf: ebook, journal, lossless music, or software.',
            'Submit the request and let the queue sort it for review.',
        ],
        'queue' => [
            [
                'title' => 'Pending review',
                'description' => 'New request lands here first so the team can verify scope and source.',
                'meta' => 'Queue state',
                'tag' => 'Stage 01',
                'accent' => 'violet',
            ],
            [
                'title' => 'Ready to place',
                'description' => 'Reviewed items move into a shelf and get a clean browsing card.',
                'meta' => 'Queue state',
                'tag' => 'Stage 02',
                'accent' => 'teal',
            ],
            [
                'title' => 'Published shell',
                'description' => 'The item becomes visible in the browse view with consistent metadata.',
                'meta' => 'Queue state',
                'tag' => 'Stage 03',
                'accent' => 'amber',
            ],
        ],
    ],

    'footer' => [
        'disclaimer' => 'Abu-Abu is a frontend shell for collections, metadata, mirrors, and request paths that still need a careful backend.',
        'links' => [
            ['label' => 'Browse', 'href' => '/browse'],
            ['label' => 'Request', 'href' => '/request'],
        ],
    ],

    'site' => [
        'languages' => [
            'default' => 'id',
            'available' => ['id', 'en'],
        ],
        'navigation' => [
            ['label' => ['id' => 'Beranda', 'en' => 'Home'], 'href' => '/'],
            ['label' => ['id' => 'Reading', 'en' => 'Reading'], 'href' => '/browse/reading'],
            ['label' => ['id' => 'Audio', 'en' => 'Audio'], 'href' => '/browse/audio'],
            ['label' => ['id' => 'Tools', 'en' => 'Tools'], 'href' => '/browse/tools'],
            ['label' => ['id' => 'Request', 'en' => 'Request'], 'href' => '/request'],
        ],
        'home' => [
            'hero' => [
                'eyebrow' => ['id' => 'Arsip, bukan etalase.', 'en' => 'Archive, not storefront.'],
                'title' => [
                    'id' => 'Beberapa file ditemukan. Sisanya menunggu dibuka pelan-pelan.',
                    'en' => 'Some files are already in sight. The rest wait to be opened slowly.',
                ],
                'lead' => [
                    'id' => 'Abu-Abu bukan etalase. Ia lebih mirip pintu masuk ke rak-rak yang tenang, gelap, dan sengaja tidak menjelaskan semuanya sekaligus.',
                    'en' => 'Abu-Abu is not a storefront. It behaves more like an entry point into quiet, dim shelves that refuse to explain everything at once.',
                ],
                'primary_cta' => ['id' => 'Masuk ke arsip', 'en' => 'Enter archive'],
                'secondary_cta' => ['id' => 'Buka jalur masuk', 'en' => 'Open access paths'],
                'aside_title' => ['id' => 'Peta tidak pernah lengkap.', 'en' => 'The map is never complete.'],
                'aside_copy' => [
                    'id' => 'Empat jalur tetap terbaca. Yang berubah hanya suasananya: ruang baca, rak audio, workshop, dan ruang intake.',
                    'en' => 'Four entry points remain readable. Only the atmosphere shifts: reading room, audio shelf, workshop, and intake room.',
                ],
                'aside_notes' => [
                    ['id' => 'Akses terbuka untuk yang tahu jalurnya.', 'en' => 'Access stays open for those who know the route.'],
                    ['id' => 'Kategori terlihat jelas, niatnya tidak selalu dijelaskan.', 'en' => 'The categories stay clear, while the intent remains less obvious.'],
                    ['id' => 'Tenang dulu. Pilih pintu yang tepat.', 'en' => 'Slow down first. Pick the right door.'],
                ],
            ],
            'categories' => [
                [
                    'slug' => 'reading',
                    'title' => ['id' => 'Reading', 'en' => 'Reading'],
                    'description' => [
                        'id' => 'Rak yang lebih terang, lebih hening, dan penuh jejak catatan panjang.',
                        'en' => 'A brighter, quieter shelf filled with long-form traces and notes.',
                    ],
                    'meta' => ['id' => 'ruang baca', 'en' => 'reading room'],
                    'accent' => 'paper',
                ],
                [
                    'slug' => 'audio',
                    'title' => ['id' => 'Audio', 'en' => 'Audio'],
                    'description' => [
                        'id' => 'Transmisi yang lebih tajam: album, genre, artis, dan jejak rilisan.',
                        'en' => 'A sharper transmission: albums, genres, artists, and release trails.',
                    ],
                    'meta' => ['id' => 'transmisi', 'en' => 'transmission'],
                    'accent' => 'wave',
                ],
                [
                    'slug' => 'tools',
                    'title' => ['id' => 'Tools', 'en' => 'Tools'],
                    'description' => [
                        'id' => 'Workshop yang lebih padat: utilitas, game archive, dan recovery notes.',
                        'en' => 'A denser workshop: utilities, game archives, and recovery notes.',
                    ],
                    'meta' => ['id' => 'workshop', 'en' => 'workshop'],
                    'accent' => 'terminal',
                ],
                [
                    'slug' => 'request',
                    'title' => ['id' => 'Request', 'en' => 'Request'],
                    'description' => [
                        'id' => 'Ruang intake untuk sesuatu yang belum punya rak, tapi sudah punya alasan.',
                        'en' => 'An intake room for things without a shelf yet, but with a reason to exist.',
                    ],
                    'meta' => ['id' => 'intake room', 'en' => 'intake room'],
                    'accent' => 'control',
                ],
            ],
            'fragments' => [
                [
                    'title' => ['id' => 'Fragmen arsip', 'en' => 'Archive fragment'],
                    'copy' => [
                        'id' => 'Beberapa jalur terasa seperti ditemukan, bukan diumumkan.',
                        'en' => 'Some routes feel discovered rather than announced.',
                    ],
                ],
                [
                    'title' => ['id' => 'Sinyal aktif', 'en' => 'Active signal'],
                    'copy' => [
                        'id' => 'Reading, audio, tools, dan request bergerak dengan bahasa yang berbeda.',
                        'en' => 'Reading, audio, tools, and request move with different languages.',
                    ],
                ],
                [
                    'title' => ['id' => 'Catatan pintu masuk', 'en' => 'Entry note'],
                    'copy' => [
                        'id' => 'Yang penting bukan seberapa keras ia bicara, tapi seberapa jelas jalurnya.',
                        'en' => 'What matters is not how loudly it speaks, but how clearly the path holds.',
                    ],
                ],
            ],
            'footer' => [
                'disclaimer' => [
                    'id' => 'Abu-Abu adalah shell frontend untuk koleksi, metadata, mirror, dan jalur request yang nanti perlu backend rapi.',
                    'en' => 'Abu-Abu is a frontend shell for collections, metadata, mirrors, and request paths that will need a careful backend.',
                ],
            ],
        ],
        'themes' => [
            'audio' => [
                'slug' => 'audio',
                'hero' => [
                    'eyebrow' => ['id' => 'Audio / wave room', 'en' => 'Audio / wave room'],
                    'title' => [
                        'id' => 'Cari track, album, genre, atau artis tanpa bikin pusing.',
                        'en' => 'Find tracks, albums, genres, or artists without the headache.',
                    ],
                    'lead' => [
                        'id' => 'Theme audio dibuat paling hidup: ada filter genre, artis, dan pencarian cepat untuk lagu atau album.',
                        'en' => 'The audio theme is the liveliest one: genre, artist, and fast search controls for songs or albums.',
                    ],
                ],
                'local_nav' => [
                    ['label' => ['id' => 'Library', 'en' => 'Library'], 'href' => '#library'],
                    ['label' => ['id' => 'Filters', 'en' => 'Filters'], 'href' => '#filters'],
                    ['label' => ['id' => 'Artists', 'en' => 'Artists'], 'href' => '#artists'],
                    ['label' => ['id' => 'Collections', 'en' => 'Collections'], 'href' => '#collections'],
                ],
                'search' => [
                    'placeholder' => ['id' => 'Cari lagu, album, atau artis', 'en' => 'Search song, album, or artist'],
                    'genres' => ['All', 'Ambient', 'City Pop', 'Jazz', 'Electronic', 'Rock', 'Neo-Soul'],
                    'artists' => ['All', 'Nujabes', 'Ichiko Aoba', 'Mitski', 'Siti Nurhaliza', 'Yussef Dayes'],
                ],
                'collections' => [
                    [
                        'slug' => 'night-drive',
                        'title' => ['id' => 'Night Drive Files', 'en' => 'Night Drive Files'],
                        'artist' => ['id' => 'Various Artists', 'en' => 'Various Artists'],
                        'genre' => 'Electronic',
                        'mood' => ['id' => 'late night pulse', 'en' => 'late night pulse'],
                    ],
                    [
                        'slug' => 'soft-static',
                        'title' => ['id' => 'Soft Static Sessions', 'en' => 'Soft Static Sessions'],
                        'artist' => ['id' => 'Yussef Dayes', 'en' => 'Yussef Dayes'],
                        'genre' => 'Jazz',
                        'mood' => ['id' => 'warm and loose', 'en' => 'warm and loose'],
                    ],
                    [
                        'slug' => 'paper-moon',
                        'title' => ['id' => 'Paper Moon Archive', 'en' => 'Paper Moon Archive'],
                        'artist' => ['id' => 'Ichiko Aoba', 'en' => 'Ichiko Aoba'],
                        'genre' => 'Ambient',
                        'mood' => ['id' => 'quiet room', 'en' => 'quiet room'],
                    ],
                ],
                'tracks' => [
                    ['collection' => 'night-drive', 'title' => ['id' => 'City Lights Drift', 'en' => 'City Lights Drift'], 'artist' => 'Nujabes', 'genre' => 'Electronic', 'album' => 'Night Drive Files', 'year' => '2024', 'duration' => '03:42'],
                    ['collection' => 'night-drive', 'title' => ['id' => 'Neon Window', 'en' => 'Neon Window'], 'artist' => 'Mitski', 'genre' => 'Rock', 'album' => 'Night Drive Files', 'year' => '2023', 'duration' => '04:11'],
                    ['collection' => 'soft-static', 'title' => ['id' => 'Blue Room Loop', 'en' => 'Blue Room Loop'], 'artist' => 'Yussef Dayes', 'genre' => 'Jazz', 'album' => 'Soft Static Sessions', 'year' => '2022', 'duration' => '05:02'],
                    ['collection' => 'soft-static', 'title' => ['id' => 'Slow Hands', 'en' => 'Slow Hands'], 'artist' => 'Yussef Dayes', 'genre' => 'Jazz', 'album' => 'Soft Static Sessions', 'year' => '2022', 'duration' => '04:28'],
                    ['collection' => 'paper-moon', 'title' => ['id' => 'Moonlit Grain', 'en' => 'Moonlit Grain'], 'artist' => 'Ichiko Aoba', 'genre' => 'Ambient', 'album' => 'Paper Moon Archive', 'year' => '2021', 'duration' => '03:17'],
                    ['collection' => 'paper-moon', 'title' => ['id' => 'Drift Notes', 'en' => 'Drift Notes'], 'artist' => 'Siti Nurhaliza', 'genre' => 'City Pop', 'album' => 'Paper Moon Archive', 'year' => '2020', 'duration' => '03:59'],
                ],
                'theme' => [
                    'shell' => 'from-[#140B28] via-[#0F1115] to-[#111827]',
                    'accent' => 'text-[#C3B2FF]',
                    'surface' => 'bg-white/[0.05]',
                    'border' => 'border-[#7D67FF]/20',
                ],
            ],
            'reading' => [
                'slug' => 'reading',
                'hero' => [
                    'eyebrow' => ['id' => 'Reading / editorial stack', 'en' => 'Reading / editorial stack'],
                    'title' => [
                        'id' => 'Baca pelan, navigasi padat, dan arsip yang terasa seperti majalah.',
                        'en' => 'Read slowly, navigate densely, and browse an archive that feels like a magazine.',
                    ],
                    'lead' => [
                        'id' => 'Bagian reading dirancang seperti ruang editorial: daftar, indeks, catatan, dan seri semuanya lebih rapat dan terarah.',
                        'en' => 'The reading section is designed like an editorial room: lists, indexes, notes, and series feel denser and more directed.',
                    ],
                ],
                'local_nav' => [
                    ['label' => ['id' => 'Index', 'en' => 'Index'], 'href' => '#index'],
                    ['label' => ['id' => 'Series', 'en' => 'Series'], 'href' => '#series'],
                    ['label' => ['id' => 'Notes', 'en' => 'Notes'], 'href' => '#notes'],
                    ['label' => ['id' => 'Recently added', 'en' => 'Recently added'], 'href' => '#latest'],
                ],
                'index_items' => [
                    ['title' => ['id' => 'Research Notes', 'en' => 'Research Notes'], 'meta' => ['id' => 'index 01', 'en' => 'index 01']],
                    ['title' => ['id' => 'Longform Journal', 'en' => 'Longform Journal'], 'meta' => ['id' => 'index 02', 'en' => 'index 02']],
                    ['title' => ['id' => 'Reading List', 'en' => 'Reading List'], 'meta' => ['id' => 'index 03', 'en' => 'index 03']],
                ],
                'items' => [
                    ['title' => ['id' => 'Design Systems, Again', 'en' => 'Design Systems, Again'], 'author' => 'A. Researcher', 'type' => ['id' => 'Essay', 'en' => 'Essay'], 'year' => '2024', 'blurb' => ['id' => 'Catatan editorial tentang struktur, kebiasaan, dan keputusan desain.', 'en' => 'Editorial notes on structure, habits, and design decisions.']],
                    ['title' => ['id' => 'Field Notes for Calm Browsing', 'en' => 'Field Notes for Calm Browsing'], 'author' => 'M. Editor', 'type' => ['id' => 'Journal', 'en' => 'Journal'], 'year' => '2023', 'blurb' => ['id' => 'Lebih padat, lebih tenang, lebih cocok buat dibaca cepat.', 'en' => 'Denser, calmer, and better for quick reading.']],
                    ['title' => ['id' => 'Index Without Noise', 'en' => 'Index Without Noise'], 'author' => 'S. Archive', 'type' => ['id' => 'Book', 'en' => 'Book'], 'year' => '2022', 'blurb' => ['id' => 'Buku ringkas dengan struktur yang gampang di-skim.', 'en' => 'A compact book with a structure that is easy to skim.']],
                ],
                'theme' => [
                    'shell' => 'from-[#101318] via-[#0F1115] to-[#1A1F24]',
                    'accent' => 'text-[#E8DCC1]',
                    'surface' => 'bg-[#161B22]',
                    'border' => 'border-white/10',
                ],
            ],
            'tools' => [
                'slug' => 'tools',
                'hero' => [
                    'eyebrow' => ['id' => 'Tools / workshop console', 'en' => 'Tools / workshop console'],
                    'title' => [
                        'id' => 'Rasa terminal, kartu modular, dan layout yang serasa workspace.',
                        'en' => 'Terminal feel, modular cards, and a layout that behaves like a workspace.',
                    ],
                    'lead' => [
                        'id' => 'Theme tools dibuat lebih fungsional dan sedikit industrial, cocok buat utility, changelog, dan modul kerja cepat.',
                        'en' => 'The tools theme is more functional and a little industrial, ideal for utilities, changelogs, and quick-work modules.',
                    ],
                ],
                'local_nav' => [
                    ['label' => ['id' => 'Console', 'en' => 'Console'], 'href' => '#console'],
                    ['label' => ['id' => 'Utilities', 'en' => 'Utilities'], 'href' => '#utilities'],
                    ['label' => ['id' => 'Changelog', 'en' => 'Changelog'], 'href' => '#changelog'],
                    ['label' => ['id' => 'Stack', 'en' => 'Stack'], 'href' => '#stack'],
                ],
                'items' => [
                    ['title' => ['id' => 'File Relay', 'en' => 'File Relay'], 'tag' => 'v2.4', 'type' => ['id' => 'Utility', 'en' => 'Utility'], 'blurb' => ['id' => 'Pindahkan file, rapikan folder, dan jaga workflow tetap singkat.', 'en' => 'Move files, tidy folders, and keep the workflow short.']],
                    ['title' => ['id' => 'Workspace Scanner', 'en' => 'Workspace Scanner'], 'tag' => 'v1.8', 'type' => ['id' => 'Utility', 'en' => 'Utility'], 'blurb' => ['id' => 'Cocok buat cek metadata, nama file, dan status cepat.', 'en' => 'Useful for metadata, filenames, and quick status checks.']],
                    ['title' => ['id' => 'Batch Notes', 'en' => 'Batch Notes'], 'tag' => 'v3.1', 'type' => ['id' => 'Module', 'en' => 'Module'], 'blurb' => ['id' => 'Modul kerja kecil dengan output yang langsung kebaca.', 'en' => 'A small work module with instantly readable output.']],
                    ['title' => ['id' => 'Queue Helper', 'en' => 'Queue Helper'], 'tag' => 'v1.2', 'type' => ['id' => 'Script', 'en' => 'Script'], 'blurb' => ['id' => 'Buat ngatur daftar tunggu tanpa ribet.', 'en' => 'Helps manage waitlists without the fuss.']],
                ],
                'theme' => [
                    'shell' => 'from-[#061312] via-[#0F1115] to-[#0B0F11]',
                    'accent' => 'text-[#9FF0BF]',
                    'surface' => 'bg-[#111814]',
                    'border' => 'border-[#3DBF79]/20',
                ],
            ],
            'request' => [
                'slug' => 'request',
                'hero' => [
                    'eyebrow' => ['id' => 'Request / control room', 'en' => 'Request / control room'],
                    'title' => [
                        'id' => 'Masukkan request ke antrian, lalu biarkan prosesnya rapi.',
                        'en' => 'Drop requests into the queue, then let the process stay tidy.',
                    ],
                    'lead' => [
                        'id' => 'Bagian request dibuat seperti control room: jelas statusnya, jelas langkahnya, dan mudah diteruskan ke backend nanti.',
                        'en' => 'The request area feels like a control room: clear status, clear steps, and ready for a backend later.',
                    ],
                ],
                'local_nav' => [
                    ['label' => ['id' => 'Queue', 'en' => 'Queue'], 'href' => '#queue'],
                    ['label' => ['id' => 'Submit', 'en' => 'Submit'], 'href' => '#submit'],
                    ['label' => ['id' => 'Rules', 'en' => 'Rules'], 'href' => '#rules'],
                    ['label' => ['id' => 'Status', 'en' => 'Status'], 'href' => '#status'],
                ],
                'steps' => [
                    ['title' => ['id' => 'Tulis kebutuhan', 'en' => 'Write the need'], 'copy' => ['id' => 'Sebutkan konten, konteks hak, dan kategori yang cocok.', 'en' => 'State the content, rights context, and the right category.']],
                    ['title' => ['id' => 'Masuk antrian', 'en' => 'Enter the queue'], 'copy' => ['id' => 'Request dimasukkan ke queue untuk diperiksa sebelum tampil.', 'en' => 'The request enters the queue for review before it appears.']],
                    ['title' => ['id' => 'Publish shell', 'en' => 'Publish the shell'], 'copy' => ['id' => 'Kalau sudah siap, request jadi item yang rapi di browse page.', 'en' => 'When ready, the request becomes a neat item on the browse page.']],
                ],
                'theme' => [
                    'shell' => 'from-[#1A120B] via-[#0F1115] to-[#21150F]',
                    'accent' => 'text-[#F6B26B]',
                    'surface' => 'bg-[#1A1814]',
                    'border' => 'border-[#F6B26B]/20',
                ],
            ],
        ],
        'audio_store' => [
            'brand' => [
                'title' => 'ABUABU AUDIO',
                'subtitle' => 'Curated digital music archive',
            ],
            'utility_nav' => [
                ['label' => 'Hello', 'href' => '#'],
                ['label' => 'My Account', 'href' => '#'],
                ['label' => 'Downloads', 'href' => '#'],
                ['label' => 'Wishlist', 'href' => '#'],
                ['label' => 'Cart', 'href' => '#'],
            ],
            'browse_tabs' => [
                ['label' => 'All', 'value' => 'all'],
                ['label' => 'Albums', 'value' => 'album'],
                ['label' => 'EPs', 'value' => 'ep'],
                ['label' => 'Singles', 'value' => 'single'],
            ],
            'format_tabs' => [
                ['label' => 'All', 'value' => 'all'],
                ['label' => 'FLAC', 'value' => 'FLAC'],
                ['label' => 'Hi-Res', 'value' => '24-bit'],
                ['label' => 'Lossless', 'value' => 'Lossless'],
            ],
            'genre_tabs' => ['Featured', 'J-Pop', 'Alternative', 'Idol', 'Soundtrack', 'Electronic', 'Rock', 'Ballad'],
            'hero' => [
                'eyebrow' => 'New in the archive',
                'title' => 'Japanese digital releases with a cleaner storefront and a calmer brain.',
                'copy' => 'The audio side of Abu-Abu now behaves like its own download catalog: browse by genre, search by artist or album, then jump into a structured album page.',
            ],
            'promo' => [
                'label' => 'Featured albums',
                'link_label' => 'View all releases',
            ],
            'detail_tabs' => ['Tracks', 'Editor\'s Notes', 'Technical Notes'],
            'albums' => [],
        ],
    ],
];
