@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="bg-primary bg-opacity-10 p-2 rounded-lg">
            <i class="fas fa-edit text-2xl text-primary"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit FAQ</h1>
            <p class="text-gray-600 text-sm">Perbarui pertanyaan dan jawaban FAQ</p>
        </div>
    </div>
    <a href="{{ route('admin.faqs.index') }}"
       class="bg-white text-gray-600 px-6 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300
              flex items-center gap-2 border-2 border-gray-200 hover:border-gray-300 group">
        <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
        <span>Kembali</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-gray-100">
    <div class="border-b-2 border-gray-100 bg-gray-50 px-6 py-4">
        <h2 class="font-medium text-gray-700 flex items-center gap-2">
            <i class="fas fa-edit text-primary"></i>
            Form Edit FAQ
        </h2>
    </div>

    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text"
                           name="question"
                           id="question"
                           required
                           value="{{ old('question', $faq->question) }}"
                           placeholder="Masukkan pertanyaan"
                           class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200
                                  focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20
                                  transition-all duration-300 pl-10">
                    <i class="fas fa-question absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('question')
                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <textarea name="answer"
                              id="answer"
                              rows="4"
                              required
                              placeholder="Masukkan jawaban"
                              class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200
                                     focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20
                                     transition-all duration-300 pl-10">{{ old('answer', $faq->answer) }}</textarea>
                    <i class="fas fa-comment absolute left-3 top-3 text-gray-400"></i>
                </div>
                @error('answer')
                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">
                        Urutan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative w-32">
                        <input type="number"
                               name="order"
                               id="order"
                               required
                               value="{{ old('order', $faq->order) }}"
                               min="0"
                               class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-200
                                      focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20
                                      transition-all duration-300 pl-10">
                        <i class="fas fa-sort-numeric-down absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('order')
                        <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               {{ $faq->is_active ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4
                                  peer-focus:ring-primary peer-focus:ring-opacity-20 rounded-full peer
                                  peer-checked:after:translate-x-full peer-checked:after:border-white
                                  after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                  after:bg-white after:border-gray-300 after:border after:rounded-full
                                  after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Status Aktif</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.faqs.index') }}"
               class="px-6 py-2.5 rounded-lg border-2 border-gray-200 text-gray-700 hover:bg-gray-50
                      hover:border-gray-300 transition-all duration-300">
                <i class="fas fa-times mr-1"></i> Batal
            </a>
            <button type="submit"
                    class="bg-primary text-white px-6 py-2.5 rounded-lg hover:bg-secondary
                           transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                <i class="fas fa-save"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection
