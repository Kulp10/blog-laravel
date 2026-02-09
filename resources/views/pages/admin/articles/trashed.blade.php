<x-layouts::app :title="__('Cestino Articoli')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- Alert Successo --}}
        @if(session('success'))
            <div id="alert-success" class="mb-6 flex items-center p-4 text-emerald-400 border border-emerald-500/30 rounded-lg bg-emerald-500/10" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
                <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 text-emerald-400 hover:text-emerald-200 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
        @endif

        @if($articles->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 border border-dashed border-white/10 rounded-xl">
                <p>Il cestino è vuoto.</p>
            </div>
        @else
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                @foreach($articles as $article)
                    <div class="group relative aspect-video overflow-hidden rounded-xl border border-red-500/20 bg-white/5 p-4 transition hover:border-red-500/40 dark:border-neutral-700">

                        {{-- Info Articolo (Non cliccabile perché è nel cestino) --}}
                        <div>
                            <h1 class="text-lg font-bold text-gray-400 line-through">{{$article->title}}</h1>
                            <p class="mt-2 text-sm text-gray-500 line-clamp-3 italic">Eliminato il: {{ $article->deleted_at->format('d/m/Y H:i') }}</p>
                        </div>

                        {{--Toolbar Azioni (Sempre visibile o al passaggio del mouse) --}}
                        <div class="absolute bottom-4 right-4 flex gap-3 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity">

                            {{-- Bottone Restore --}}
                            <form action="{{ route('articles.restore', $article) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-500 transition shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Ripristina
                                </button>
                            </form>

                            {{-- Bottone Force Delete --}}
                            <form action="{{ route('articles.forceDelete', $article) }}" method="POST" onsubmit="return confirm('ATTENZIONE: Eliminazione definitiva. Sei sicuro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-2 rounded-md bg-red-600/20 px-3 py-1.5 text-xs font-semibold text-red-400 border border-red-600/30 hover:bg-red-600 hover:text-white transition shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Svuota
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::app>
