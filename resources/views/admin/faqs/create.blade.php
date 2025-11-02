@extends('admin.layouts.app')

@section('title', 'Tambah FAQ')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah FAQ</h1>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-6">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                <input type="text" name="question" id="question" required value="{{ old('question') }}"
                       class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700">Jawaban</label>
                <textarea name="answer" id="answer" rows="4" required
                          class="mt-1 w-full rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                <input type="number" name="order" id="order" required value="{{ old('order', 0) }}" min="0"
                       class="mt-1 w-32 rounded-md border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked
                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <span class="ml-2">Aktif</span>
                </label>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end">
            <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
            <button type="submit"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Simpan FAQ
            </button>
        </div>
    </form>
</div>
@endsection
