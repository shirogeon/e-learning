<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('teacher.courses.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course Title</label>
                        <input type="text" name="title" id="title" required value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                            <option value="" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Difficulty Level</label>
                            <select name="level" id="level" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Beginner</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Intermediate</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Advanced</option>
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (USD) - 0 for Free</label>
                            <input type="number" step="0.01" name="price" id="price" required value="{{ old('price', 0) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="6" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-3 border-t border-gray-100 dark:border-gray-700 pt-6">
                        <a href="{{ route('teacher.dashboard') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-md text-sm font-bold shadow-md shadow-amber-500/10 transition duration-200">
                            Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
