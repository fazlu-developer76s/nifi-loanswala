@php
    $company = \App\Helpers\Global_helper::companyDetails();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ (!empty($title)) ? $title : "Loanswala" ; }} </title>
    <style>
        .app-sidebar , .app-header{
            position: fixed !important;
        }
        .app-sidebar-content, .find-link{
            overflow: hidden !important;
        }
        @media (max-width: 768px) {
    .app-sidebar {
        position: fixed;
        left: -250px;
        width: 250px;
        transition: left 0.3s ease;
    }
    .app-sidebar.open {
        left: 0;
    }
    .app-sidebar-overlay {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9;
    }
}

    </style>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/'.$company->favicon) }}">
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <!----Table-- -->
    <link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <!----Table---->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<!----Head----->
@include('layouts.header')
@if(Auth::user()->is_user_verified == 1)
@include('layouts.sidebar')
@endif
@yield('content')
@include('layouts.footer')
