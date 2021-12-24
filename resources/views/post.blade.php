<x-app-layout>
    <x-slot name="title">
        <livewire:framework.site-title :page="$page" :post="$identifier" />
    </x-slot>

    <x-slot name="menu">
        <livewire:framework.menubar />
    </x-slot>

    <div class="cards-container space-y-6 my-6">
        <x-module-loop :page="$page" :identifier="$identifier" />
    </div>


    <livewire:core.footer />

    <livewire:framework.auth-template :page_id="$page->id" />
</x-app-layout>
