<x-layouts::app :title="$article->name">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div>
            {{$article}}
        </div>
    </div>
</x-layouts::app>
