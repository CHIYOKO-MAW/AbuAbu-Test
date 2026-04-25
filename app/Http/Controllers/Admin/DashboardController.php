<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\ReadingItem;
use App\Models\Tool;
use App\Models\IntakeRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'artists' => Artist::count(),
                'albums' => Album::count(),
                'albumsFeatured' => Album::where('featured', true)->count(),
                'reading' => ReadingItem::count(),
                'tools' => Tool::count(),
                'toolsFeatured' => Tool::where('featured', true)->count(),
                'requests' => IntakeRequest::where('status', 'pending')->count(),
                'requestsTotal' => IntakeRequest::count(),
            ],
            'recentAlbums' => Album::with('artist')->latest()->take(5)->get(),
            'recentReading' => ReadingItem::latest()->take(5)->get(),
            'recentTools' => Tool::latest()->take(5)->get(),
        ]);
    }
}