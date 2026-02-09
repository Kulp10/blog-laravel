<x-layouts::app :title="'Create article'">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if ($errors->any())
            <div id="alert-error" class="mb-6 flex flex-col p-4 text-red-400 border border-red-500/30 rounded-lg bg-red-500/10" role="alert">
                <div class="flex items-center">
                    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Errore</span>
                    <div class="ms-3 text-sm font-bold">
                        Ops! Qualcosa è andato storto:
                    </div>
                    <button type="button" onclick="document.getElementById('alert-error').remove()" class="ms-auto -mx-1.5 -my-1.5 text-red-400 hover:text-red-200 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>

                <ul class="mt-2 ml-7 list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12 bg-gray-900 p-8 rounded-xl">
                <div class="border-b border-white/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-white">Nuovo Articolo</h2>
                    <p class="mt-1 text-sm/6 text-gray-400">Compila i campi principali per la pubblicazione del post.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm/6 font-medium text-white">Titolo</label>
                            <div class="mt-2">
                                <input id="title" type="text" name="title" placeholder="Il mio fantastico post" value="{{old('title')}}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="slug" class="block text-sm/6 font-medium text-white">Slug</label>
                            <div class="mt-2">
                                <input id="slug" type="text" name="slug" value="{{old('slug')}}" placeholder="il-mio-post" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="excerpt" class="block text-sm/6 font-medium text-white">Introduzione (Excerpt)</label>
                            <div class="mt-2">
                                <textarea id="excerpt" name="excerpt" rows="2" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
                            </div>
                            <p class="mt-3 text-sm/6 text-gray-400">Un breve riassunto visualizzato in anteprima.</p>
                        </div>

                        <div class="col-span-full">
                            <label for="content_html" class="block text-sm/6 font-medium text-white">Contenuto</label>
                            <div class="mt-2">
                                <textarea id="content_html" name="content_html" rows="6" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base font-mono text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" placeholder='{"body": "Scrivi qui..."}'></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-white/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-white">Impostazioni e Media</h2>
                    <p class="mt-1 text-sm/6 text-gray-400">Gestisci l'immagine di copertina e lo stato di pubblicazione.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="featured_image" class="block text-sm/6 font-medium text-white">Immagine in evidenza (URL)</label>
                            <div class="mt-2">
                                <input id="featured_image" type="text" name="featured_image" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="status" class="block text-sm/6 font-medium text-white">Stato</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="status" name="status" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                                    <option value="draft">Bozza</option>
                                    <option value="published">Pubblicato</option>
                                </select>
                                <svg viewBox="0 0 16 16" fill="currentColor" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                                    <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="reading_time" class="block text-sm/6 font-medium text-white">Tempo di lettura (min)</label>
                            <div class="mt-2">
                                <input id="reading_time" type="number" name="reading_time" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3 flex items-end pb-2">
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input type="hidden" name="is_featured" value="0">
                                        <input id="is_featured" type="checkbox" name="is_featured" value="1" class="col-start-1 row-start-1 appearance-none rounded-sm border border-white/10 bg-white/5 checked:border-indigo-500 checked:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" />
                                        <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white opacity-0 group-has-checked:opacity-100">
                                            <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <label for="is_featured" class="font-medium text-white text-sm/6">Metti in evidenza</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-white hover:text-gray-300">Annulla</button>
                <button type="submit" class="rounded-md bg-indigo-500 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Salva Post
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
