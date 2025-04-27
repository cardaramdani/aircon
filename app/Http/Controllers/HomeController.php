<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Pricelist;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // Cache prices untuk 1 jam
        $prices = Cache::remember('service_prices', 3600, function () {
            return Pricelist::all();
        });

        $posts = Cache::remember('latest_post', 3600, function () {
            return Post::latest()->take(3)->get();
        });

        $metaData = [
            'title' => 'AirConPro - Jasa Service AC Professional Jakarta & Tangerang',
            'description' => 'Layanan service AC berkualitas di Jakarta dan Tangerang. Teknisi berpengalaman, bergaransi, tersedia 24/7. Hubungi 082298520919 untuk konsultasi gratis.',
            'keywords' => 'service ac jakarta, service ac tangerang, jasa service ac, teknisi ac berpengalaman'
        ];

        return view('home', compact('prices', 'posts', 'metaData'));
    }

}
