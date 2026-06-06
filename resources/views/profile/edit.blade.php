@extends('layouts.customer')

@section('header')
    {{ __('Pengaturan Profil') }}
@endsection

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
