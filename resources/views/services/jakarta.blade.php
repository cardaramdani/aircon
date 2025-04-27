@extends('layouts.app')

@section('content')
<div class="area-service">
    <div class="container">
        <h1>Jasa Service AC Jakarta Barat</h1>

        <div class="service-highlights mt-4">
            <h2>Layanan Service AC di {{ $metaData['area'] }}</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <h3>Cuci AC Berkala</h3>
                        <ul>
                            <li>Pembersihan Filter</li>
                            <li>Pembersihan Evaporator</li>
                            <li>Cek Freon</li>
                        </ul>
                    </div>
                </div>
                <!-- Add more service cards -->
            </div>
        </div>

        <div class="area-coverage mt-4">
            <h2>Area Layanan di Jakarta Barat</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>Kebon Jeruk</li>
                        <li>Tanjung Duren</li>
                        <li>Grogol Petamburan</li>
                        <li>Palmerah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "AirConPro Service AC {{ $metaData['area'] }}",
    "description": "{{ $metaData['description'] }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ $metaData['area'] }}",
        "addressRegion": "Jakarta",
        "addressCountry": "ID"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": -6.1751,
        "longitude": 106.8272
    },
    "url": "{{ url()->current() }}",
    "telephone": "+6282298520919"
}
</script>
@endpush
@endsection
