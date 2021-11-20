<div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl {{ ($color == 'light') ? 'bg-white' : 'bg-gray-800' }} {{ ($page_module->enabled) ? '' : 'border-dashed border-4' }}">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:py-24 sm:px-6 lg:px-8 lg:flex lg:justify-between">
        <div class="max-w-xl">
            <h2 class="text-4xl font-extrabold {{ ($color == 'light') ? 'text-black' : 'text-white' }} sm:text-5xl sm:tracking-tight lg:text-6xl">{{ $header }}</h2>
            <p class="mt-5 text-xl {{ ($color == 'light') ? 'text-gray-800' : 'text-gray-400' }} text-gray-400">{{ $description }}</p>
        </div>
    </div>

    <div class="m-4 pb-2">
        <livewire:core.card-footer :page_module="$page_module" :duration="$updated_at" :modal="$page_module->module->edit_component" :modal_parameters="['header' => $header, 'description' => $description, 'page_module' => $page_module]" />
    </div>
</div>
