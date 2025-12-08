@extends('layouts.app')
@section('title', 'Gestion des Types de media')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4"
                data-aos="fade-down">
                <div>
                    <nav class="flex mb-2" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-gray-500">
                            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-benin-green transition">Admin</a>
                            </li>
                            <li>/</li>
                            <li class="font-medium text-gray-800 dark:text-gray-200">Types de media</li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Types de <span class="text-benin-green">media</span>
                    </h1>
                </div>

                <a href="{{ route('types-media.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 dark:hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouveau Type
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700"
                data-aos="fade-up">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700/50 border-b dark:border-gray-700">
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">ID
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Libellé
                                </th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">
                                    Volume</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($typesmedia as $type)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">#{{ $type->id }}</td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="text-base font-semibold text-gray-900 dark:text-white">{{ $type->nom }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $type->medias_count > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $type->medias_count }} medias
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('types-media.edit', $type->id) }}"
                                            class="inline-flex p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Modifier">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('types-media.destroy', $type->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Attention : Cette suppression est irréversible.');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors {{ $type->medias_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $type->medias_count > 0 ? 'disabled' : '' }} title="Supprimer">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <p class="text-lg">Aucun type de media défini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($typesmedia instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="px-6 py-4 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        {{ $typesmedia->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
