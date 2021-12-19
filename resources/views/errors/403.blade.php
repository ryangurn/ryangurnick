@extends('layouts.base')

@section('title')
    404
@endsection

@section('additional_body_css')
    h-full
@endsection

@section('additional_html_css')
    h-full overflow-hidden
@endsection

@section('main')
    <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="max-w-max mx-auto">
            <main class="sm:flex">
                <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">403</p>
                <div class="sm:ml-6">
                    <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Unauthorized Request</h1>
                        <p class="mt-1 text-base text-gray-500">You are currently not authorized to make this request.</p>
                        <p class="mt-2 text-xs text-gray-500">please contact an administrator if you feel you need access.</p>
                    </div>
                    <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Go back home
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
