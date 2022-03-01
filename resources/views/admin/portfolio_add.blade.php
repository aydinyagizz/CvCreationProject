@extends('layouts.admin')

@php


    @endphp
@section('title')
    Kişisel Bilgiler
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Kişisel Bilgiler </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>

                <li class="breadcrumb-item active" aria-current="page">Kişisel Bilgiler Düzenle</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" id="createEducationForm" method="POST" action=""
                          enctype="multipart/form-data">
                        @csrf



                        {{--                        Hataları çoklu şekilde nerede hata varsa hepsini çoklu halde gösterir--}}
                        {{--                        @if($errors->any())--}}
                        {{--                            <div class="alert alert-danger">--}}
                        {{--                                    @foreach($errors->all() as $error)--}}
                        {{--                                        <div>{{ $error }}</div>--}}
                        {{--                                    @endforeach--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}

                        <div class="form-group">
                            <label for="main_title">Anasayfa Başlık</label>
                            <input type="text" class="form-control" name="main_title" id="main_title"
                                   placeholder="Eğitim Tarihi"
                                   value="{{ $information->main_title }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('education_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="about_text">Hakkımda Yazısı</label>
                            <textarea class="form-control" name="about_text" id="about_text" cols="30" rows="10"
                                      placeholder="">{!! $information->about_text !!} </textarea>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('about_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            CKEDITOR.replace('about_text');
                        </script>

                        <div class="form-group">
                            <label for="btn_contact_text">Bana Ulaşın Butonu Text</label>
                            <input type="text" class="form-control" name="btn_contact_text" id="btn_contact_text"
                                   placeholder="Bana Ulaşın Butonu Text"
                                   value=" {{$information->btn_contact_text}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('btn_contact_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="btn_contact_link">Bana Ulaşın Butonu Link</label>
                            <input type="text" class="form-control" name="btn_contact_link" id="btn_contact_link"
                                   placeholder="Bana Ulaşın Butonu Link"
                                   value=" {{$information->btn_contact_link}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('btn_contact_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="small_title_left">Eğitim Başlığı Üzerindeki Ufak Başlık</label>
                            <input type="text" class="form-control" name="small_title_left" id="small_title_left"
                                   placeholder="Deneyim Başlığı Üzerindeki Ufak Başlık"
                                   value=" {{$information->small_title_left}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('small_title_left')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_left">Eğitim Başlığı</label>
                            <input type="text" class="form-control" name="title_left" id="title_left"
                                   placeholder="Eğitim Başlığ"
                                   value=" {{$information->title_left}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('title_left')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="small_title_right">Deneyim Başlığı Üzerindeki Ufak Başlık</label>
                            <input type="text" class="form-control" name="small_title_right" id="small_title_right"
                                   placeholder="Deneyim Başlığı Üzerindeki Ufak Başlık"
                                   value=" {{$information->small_title_left}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('small_title_right')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_right">Deneyim Başlığı</label>
                            <input type="text" class="form-control" name="title_right" id="title_right"
                                   placeholder="Deneyim Başlığı"
                                   value=" {{$information->title_right}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('title_right')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="full_name">Ad Soyad</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                   placeholder="Ad Soyad"
                                   value=" {{$information->full_name}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">Resim</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    <img width="100"
                                         src=" {{ asset($information->image ?  'storage/image/'. $information->image : 'assets/images/faces/face15.jpg') }}"
                                         alt="">

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="task_name">Pozisyon</label>
                            <input type="text" class="form-control" name="task_name" id="task_name"
                                   placeholder="Pozisyon"
                                   value=" {{$information->task_name}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birthday">Doğum Tarihi</label>
                            <input type="text" class="form-control" name="birthday" id="birthday"
                                   placeholder="Doğum Tarihi"
                                   value=" {{$information->birthday}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('birthday')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website">Web Sitesi</label>
                            <input type="text" class="form-control" name="website" id="website"
                                   placeholder="Web Sitesi"
                                   value=" {{$information->website}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="Telefon"
                                   value=" {{$information->phone}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mail">E Posta</label>
                            <input type="text" class="form-control" name="mail" id="mail"
                                   placeholder="E Posta"
                                   value=" {{$information->mail}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('mail')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Adres"
                                   value=" {{$information->address}} ">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cv">Öz Geçmiş</label>
                            <input type="file" class="form-control" name="cv" id="cv">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('cv')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lang">Diller</label>
                            <textarea class="form-control" name="lang" id="lang" cols="30" rows="10"
                                      placeholder="">{!! $information->lang !!}  </textarea>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('lang')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            CKEDITOR.replace('lang');
                        </script>


                        <div class="form-group">
                            <label for="interests">Hobiler</label>
                            <textarea class="form-control" name="interests" id="interests" cols="30" rows="10"
                                      placeholder="">{!! $information->interests !!}</textarea>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('interests')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            CKEDITOR.replace('interests');
                        </script>


                        <button type="submit" class="btn btn-primary me-2" id="createButton">Kaydet</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        // var editor1 = CKEDITOR.replace('ck1');

        let createButton = $('#createButton');
        createButton.click(function () {

            if ($('#education_date').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Eğitim Tarihi Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else if ($('#university_name').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Üniversite Adını Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else if ($('#university_branch').val().trim() == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı',
                    text: 'Lütfen Üniversite Bölümünü Giriniz',
                    confirmButtonText: 'Tamam'
                })
            } else {
                $('#createEducationForm').submit();
            }
        });
    </script>



@endsection
