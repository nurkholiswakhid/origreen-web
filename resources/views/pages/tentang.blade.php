@extends('layouts.app')

@section('content')
<!-- Tentang Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Origreen</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="w-full h-96 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-3xl flex items-center justify-center">
                    <i class="fas fa-tree text-9xl text-primary"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Wisata Alam Terbaik Indonesia</h3>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Origreen adalah destinasi wisata alam yang menawarkan pengalaman tak terlupakan di tengah keindahan alam Indonesia. Dengan konsep eco-tourism, kami berkomitmen untuk melestarikan lingkungan sambil memberikan pengalaman wisata terbaik.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Dikelilingi oleh pemandangan hijau yang asri, udara segar pegunungan, dan berbagai wahana menarik, Origreen adalah tempat sempurna untuk berlibur bersama keluarga dan teman-teman.
                </p>

                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center p-6 bg-white rounded-xl shadow-md">
                        <i class="fas fa-users text-4xl text-primary mb-3"></i>
                        <h4 class="text-2xl font-bold text-gray-800">50K+</h4>
                        <p class="text-gray-600">Pengunjung</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-md">
                        <i class="fas fa-award text-4xl text-primary mb-3"></i>
                        <h4 class="text-2xl font-bold text-gray-800">4.8/5</h4>
                        <p class="text-gray-600">Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
