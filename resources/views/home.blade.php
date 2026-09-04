@extends('layouts.app')

@section('title', 'Ekskul Bulu Tangkis SMKN 2 Purwakarta - Agile Court Portal')

@section('content')
    <!-- Hero Section -->
    @include('partials.hero')

    <!-- Interactive Match Scoreboard -->
    @include('partials.scoreboard')

    <!-- About Us & Interactive Badminton Court Tactics -->
    @include('partials.about')

    <!-- Weekly Practice Schedule -->
    @include('partials.schedule')

    <!-- Achievements & Trophy Showcase -->
    @include('partials.achievements')

    <!-- Bento Gallery with Lightbox -->
    @include('partials.gallery')

    <!-- Dynamic Registration Form -->
    @include('partials.registration')
@endsection
