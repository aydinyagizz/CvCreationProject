<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Mukta:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendors/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/live-resume.css')}}">



    @yield('css')
    <script src="https://use.fontawesome.com/d93f216000.js"></script>
</head>

<body>

@include('layouts.menu')

<div class="content-wrapper">

    <aside>
        <div class="profile-img-wrapper">
            <img
                src="{{ asset($personal->image ?  'storage/image/'. $personal->image : 'assets/images/faces/face15.jpg') }}"
                alt="{{ $personal->full_name }}">
        </div>
        <h1 class="profile-name">{{ $personal->full_name }}</h1>
        <div class="text-center">
            <span class="badge badge-white badge-pill profile-designation">{{ $personal->task_name }}</span>
        </div>
        <nav class="social-links">
            @foreach($socialMediaData as $social)
                <a href="{{ $social->link ? $social->link : 'javascript:void(0)' }}" target="_blank" class="social-link"
                   title="{{ $social->name }}"> {!! $social->icon !!}</a>
            @endforeach
        </nav>
        <div class="widget">
            <h5 class="widget-title">Kişisel Bilgiler</h5>
            <div class="widget-content">
                <p>Doğum Tarihi : {{ $personal->birthday }}</p>
                <p>Web Site : {{ $personal->website }}</p>
                <p>Telefon : {{ $personal->phone }}</p>
                <p>Mail : {{ $personal->mail }}</p>
                <p>Adres : {{ $personal->address }}</p>

                <a href="{{ asset('storage/cv/'. $personal->cv) }}" target="_blank" class="btn btn-download-cv btn-primary rounded-pill"><img
                        src="{{asset('assets/images/download.svg')}}"
                        class="btn-img">Özgeçmişimi İndir
                </a>
            </div>
        </div>
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">Diller</h5>
                    {!! $personal->lang !!}
                </div>
            </div>
        </div>
        <div class="widget card">
            <div class="card-body">
                <div class="widget-content">
                    <h5 class="widget-title card-title">Hobiler</h5>
                    {!! $personal->interests !!}
                </div>
            </div>
        </div>
    </aside>
    <main>

        @yield('content')

        <footer>Live Resume @ <a href="https://www.bootstrapdash.com" target="_blank" rel="noopener noreferrer">BootstrapDash</a>.
            All Rights Reserved 2020
        </footer>
    </main>
</div>
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendors/@popperjs/core/dist/umd/popper-base.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/live-resume.js')}}"></script>
@yield('js')
</body>

</html>
