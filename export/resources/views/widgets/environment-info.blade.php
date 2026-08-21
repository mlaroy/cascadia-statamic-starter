<div class="card h-full p-0 bg-amber-50 dark:bg-amber-300/6 border border-amber-200 dark:border-amber-400/25">
    <div class="flex items-center gap-3 p-4">
        <div class="opacity-70 text-amber-800 dark:text-amber-300">
            @cp_svg('icons/warning-diamond', 'size-5')
        </div>

        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-amber-800 dark:text-amber-300">You are viewing {{ $label }}</h2>

            <p class="text-sm text-amber-800 dark:text-amber-200">
                This is not production. Changes made here may be committed or deployed through the staging workflow.
                @if($url)
                    <span class="block font-mono text-xs">{{ $url }}</span>
                @endif
            </p>
        </div>
    </div>
</div>
