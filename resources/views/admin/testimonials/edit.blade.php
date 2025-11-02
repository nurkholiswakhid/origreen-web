@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Testimoni</h1>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $testimonial->name) }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="occupation" class="block text-sm font-medium text-gray-700">Pekerjaan/Asal</label>
                <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $testimonial->occupation) }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('occupation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="avatar_url" class="block text-sm font-medium text-gray-700">URL Avatar (Opsional)</label>
                <input type="url" name="avatar_url" id="avatar_url" value="{{ old('avatar_url', $testimonial->avatar_url) }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('avatar_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Ulasan</label>
                <textarea name="content" id="content" rows="4" required
                          class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('content', $testimonial->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <div class="flex items-center space-x-1">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" onclick="setRating({{ $i }})"
                            class="text-2xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none star-button">
                        <i class="fas fa-star"></i>
                    </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" value="{{ old('rating', $testimonial->rating) }}">
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <span class="ml-2 text-gray-700">Aktif</span>
                </label>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end space-x-3">
            <a href="{{ route('admin.testimonials.index') }}"
               class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function setRating(rating) {
    document.getElementById('rating').value = rating;
    document.querySelectorAll('.star-button').forEach((button, index) => {
        const star = button.querySelector('i');
        if (index < rating) {
            star.classList.add('text-yellow-400');
            star.classList.remove('text-gray-300');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Set initial rating
document.addEventListener('DOMContentLoaded', function() {
    setRating({{ old('rating', $testimonial->rating) }});
});
</script>
@endpush
@endsection
