@extends('layouts.admin')

@php
    if($experience) {
       $experienceText = "Deneyim Düzenleme";
        }
    else {
       $experienceText = "Yeni Deneyim Ekleme";
        }

@endphp
@section('title')
    {{ $experienceText }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">  {{ $experienceText }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.experience.list')}}">Deneyim Bilgileri Listesi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $experienceText }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf

                        @if($experience)
                            <input type="hidden" name="educationID" value="{{ $experience->id }}">
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
                            <label for="date">Çalışma Tarihi</label>
                            <input type="text" class="form-control" name="date" id="date"
                                   placeholder="Çalışma Tarihi"
                                   value=" {{ $experience ? $experience->date : '' }}">
                            <small>Örneğin: 2012 - 2017</small>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="task_name">Çalıştığınız Pozisyon</label>
                            <input type="text" class="form-control" name="task_name" id="task_name"
                                   placeholder="lıştığınız Pozisyon"
                                   value=" {{ $experience ? $experience->task_name : '' }}">
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="company_name">Çalıştığınız Firma</label>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                   placeholder="Çalıştığınız Firma"
                                   value=" {{ $experience ? $experience->company_name : '' }}">
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea class="form-control" type="textarea" name="description" id="description" cols="70"
                                      rows="7"
                                      placeholder="Açıklama">{{ $experience ? $experience->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="order">Deneyim Sırası</label>
                            <input type="text" class="form-control" name="order" id="order"
                                   placeholder="Deneyim Sırası"
                                   value=" {{ $experience ? $experience->order : '' }}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label for="status" class="form-check-label">
                                    @php
                                        if ($experience) {
                                            $checkStatus = $experience->status ? 'checked' : '';
                                        } else {
                                            $checkStatus = '';
                                        }
                                    @endphp
                                    <input type="checkbox" name="status" id="status"
                                           class="form-check-input" {{ $checkStatus }}> Deneyim
                                    Anasayfa da Gösterilme Durumu
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label for="active" class="form-check-label">
                                    @php
                                        if ($experience) {
                                            $checkActive = $experience->active ? 'checked' : '';
                                        } else {
                                            $checkActive = '';
                                        }
                                    @endphp
                                    <input type="checkbox" name="active" id="active"
                                           class="form-check-input" {{ $checkActive }}> İlgili pozisyonda çalışmaya
                                    devam ediyor musunuz?
                                </label>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary me-2" id="createButton">Kaydet</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let createButton = $('#createButton');
        createButton.click(function () {

            if ($('#date').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Çalışma Tarihi Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else if ($('#task_name').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Çalıştığınız Pozisyonu Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else if ($('#company_name').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Çalıştığınız Firmayı Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else {
                $('#createExperienceForm').submit();
            }
        });
    </script>
@endsection
