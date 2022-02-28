@extends('layouts.admin')

@section('title')
    @php
        if($socialMedia) {
        $socialMediaText = "Sosyal Medya Hesabı Düzenleme";
        }
        else {
        $socialMediaText = "Sosyal Medya Hesabı Ekleme";
        }
    @endphp
    {{$socialMediaText}}
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">  {{ $socialMediaText }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.socialMedia.list')}}">Sosyal Medya Hesaplarınız</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $socialMediaText }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf

                        @if($socialMedia)
                            <input type="hidden" name="socialMediaID" value="{{ $socialMedia->id }}">
                        @endif

                        {{--                        Hataları çoklu şekilde nerede hata varsa hepsini çoklu halde gösterir--}}
                        {{--                        @if($errors->any())--}}
                        {{--                            <div class="alert alert-danger">--}}
                        {{--                                    @foreach($errors->all() as $error)--}}
                        {{--                                        <div>{{ $error }}</div>--}}
                        {{--                                    @endforeach--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}

                        <div class="form-group">
                            <label for="name">Ad</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Ad"
                                   value=" {{ $socialMedia ? $socialMedia->name : '' }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="link">link</label>
                            <input type="text" class="form-control" name="link" id="link"
                                   placeholder="link"
                                   value=" {{ $socialMedia ? $socialMedia->link : '' }}">
                            @error('link')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="social_order">Sıralama</label>
                            <input type="text" class="form-control" name="social_order" id="order"
                                   placeholder="Sıralama"
                                   value=" {{ $socialMedia ? $socialMedia->social_order : '' }}">
                            @error('social_order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="icon">İcon</label>
                            <input type="text" class="form-control" name="icon" id="icon"
                                   placeholder="İcon"
                                   value=" {{ $socialMedia ? $socialMedia->icon : '' }}">
                            <a href="https://fontawesome.com/search" target="_blank"><small>Kullanabileceğiniz Sosyal
                                    Medya İconları İçin Tıklayınız.</small></a><br>

                            @error('icon')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label for="status" class="form-check-label">
                                    @php
                                        if ($socialMedia) {
                                            $checkStatus = $socialMedia->status ? 'checked' : '';
                                        } else {
                                            $checkStatus = '';
                                        }
                                    @endphp
                                    <input type="checkbox" name="status" id="status"
                                           class="form-check-input" {{ $checkStatus }}> Hesap
                                    Anasayfa da Gösterilme Durumu
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2" id="createButton">Kaydet</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
