<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use App\Models\Pricelist;
use App\Models\Post;

class ServiceAreaController extends Controller
{
    public function jakartaBarat()
    {
        // Cache prices untuk 1 jam
        $prices = Cache::remember('service_prices', 3600, function () {
            return Pricelist::all();
        });

        $Posts = Cache::remember('latest_post', 3600, function () {
            return Post::latest()->take(3)->get();
        });

        $metaData = [
            'title' => 'Service AC Jakarta Barat | Teknisi 24 Jam | AirConPro',
            'description' => 'Layanan service AC terpercaya di Jakarta Barat. Melayani Kebon Jeruk, Tanjung Duren, Grogol. Teknisi profesional, hasil bergaransi.',
            'area' => 'Jakarta Barat',
            'services' => ['Cuci AC', 'Perbaikan AC', 'Instalasi AC Baru']
        ];

        return view('services.jakarta-barat', compact('prices', 'Posts', 'metaData'));
        // return view('services.jakarta-barat', compact('metaData'));
    }

    public function tangerang()
    {
        $metaData = [
            'title' => 'Service AC Tangerang | Teknisi Professional | AirConPro',
            'description' => 'Jasa service AC terbaik di Tangerang. Melayani area Karawaci, Gading Serpong, BSD. Teknisi ahli, pelayanan 24 jam.',
            'area' => 'Tangerang'
        ];

        return view('services.tangerang', compact('metaData'));
    }
}
