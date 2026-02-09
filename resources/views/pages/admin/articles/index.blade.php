<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if(session('success'))
            <div id="alert-success" class="mb-6 flex items-center p-4 text-emerald-400 border border-emerald-500/30 rounded-lg bg-emerald-500/10 role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Successo</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 text-emerald-400 hover:text-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-800/50 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Chiudi</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
        @endif
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach($articles as $article)
                <div class="group relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-white/5 p-4 transition hover:border-neutral-400 dark:border-neutral-700 dark:hover:border-neutral-500">

                    <a href="{{route('articles.show', $article)}}" class="block h-full">
                        <h1 class="text-lg font-bold text-white">{{$article->title}}</h1>
                        <p class="mt-2 text-sm text-gray-400 line-clamp-3">{!! strip_tags($article->content_html) !!}</p>
                    </a>

                    <div class="absolute top-2 right-2 flex gap-2 opacity-0 transition group-hover:opacity-100">

                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Sposta nel cestino?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded bg-amber-500/20 p-1 text-amber-500 hover:bg-amber-500 hover:text-white transition" title="Sposta nel cestino">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>

                        <form action="{{ route('articles.forceDelete', $article) }}" method="POST" onsubmit="return confirm('ELIMINARE DEFINITIVAMENTE? Questa azione è irreversibile.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded bg-red-500/20 p-1 text-red-500 hover:bg-red-500 hover:text-white transition" title="Elimina Definitivamente">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts::app>
