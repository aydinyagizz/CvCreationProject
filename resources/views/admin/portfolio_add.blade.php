@extends('layouts.admin')

@php


    @endphp
@section('title')
    Portfolio Yönetimi
@endsection

@section('css')
    /*admin.blade.php sayfasında olduğu için çaıkışıyor ve editör içerisinde resime izin verimiyor.*/
{{--    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>--}}
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Portfolio Yönetimi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{route('portfolio.index')}}">Portfolio Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolio Yönetimi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" id="portfolioForm" method="POST"
                          action="{{ isset($portfolio) ? route('portfolio.update', ['portfolio' => request('portfolio')]) : route('portfolio.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        @isset($portfolio)
                            @method('PUT')
                        @endisset


                        {{--                        Hataları çoklu şekilde nerede hata varsa hepsini çoklu halde gösterir--}}
                        {{--                        @if($errors->any())--}}
                        {{--                            <div class="alert alert-danger">--}}
                        {{--                                    @foreach($errors->all() as $error)--}}
                        {{--                                        <div>{{ $error }}</div>--}}
                        {{--                                    @endforeach--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}

                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Başlık"
                                   {{--                                   ?? isset fonksiyonu gibi --}}
                                   value="{{ $portfolio->title ?? '' }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Etiketler</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                   placeholder="Etiketler"
                                   value="{{ $portfolio->tags ?? '' }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('tags')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="about">Portfolio Hakkında</label>
                            <textarea class="form-control" name="about" id="about" cols="30" rows="10"
                                      placeholder="Portfolio Hakkında">{!! $portfolio->about ?? '' !!}
                            </textarea>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('about')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            CKEDITOR.replace('about');
                        </script>

                        <div class="form-group">
                            <label for="website">Web Site</label>
                            <input type="text" class="form-control" name="website" id="website"
                                   placeholder="Web Site"
                                   value="{{ $portfolio->website ?? '' }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords"
                                   placeholder="Keywords"
                                   value="{{ $portfolio->keywords ?? '' }}">
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('keywords')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                      placeholder="Description">{!! $portfolio->description ?? '' !!}
                            </textarea>
                            {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            CKEDITOR.replace('description');
                        </script>

                        @isset($portfolio)
                        @else
                            <div class="form-group">
                                <label for="images">Portfolio Görselleri</label>
                                <input type="file" multiple class="form-control" name="images[]" id="images"
                                       placeholder="Keywords">
                                {{--                            Hataları tek tek inputların altında gösterilmesi --}}
                                @if($errors->has('images.*'))
                                    @foreach($errors->get('images.*') as $key=>$value)
                                        <div class="alert alert-danger">{{ $errors->first($key) }}</div>
                                    @endforeach
                                @endif
                            </div>
                        @endisset

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label for="status" class="form-check-label">
                                    <input type="checkbox" name="status" id="status"
                                           class="form-check-input" {{ isset($portfolio) ? ($portfolio->status ? 'checked' : '' ) : '' }}>
                                    Portfolio
                                    Anasayfa da Gösterilme Durumu
                                </label>
                            </div>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="button" class="btn btn-primary me-2"
                                id="createButton">{{ isset($portfolio) ? 'Güncelle' : 'Kaydet' }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>

        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
        };
        var about = CKEDITOR.replace('about', options
        //     {
        //     extraAllowedContent: 'div',
        //     height: 150,

        // }
        );

        // var editor1 = CKEDITOR.replace('ck1');

        // imageslerin type vs alanlarını alıyoruz.
        $('#images').change(function () {
            let images = $(this);

            let imageCheckStatus = imageCheck(images);

        });

        @isset($portfolio)
        let createButton = $('#createButton');
        createButton.click(function () {
            if ($('#title').val().trim() == '') {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Başlık alanı boş bırakılamaz.',
                    confirmButtonText: 'Tamam'
                });
            } else if ($('#tags').val().trim() == '') {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Etiket alanı boş bırakılamaz.',
                    confirmButtonText: 'Tamam'
                });
            } else {
                // else durumunda formu post ediyoruz.
                $('#portfolioForm').submit();
            }

        });
        @else
        function imageCheck(images) {
            //uzunluğu
            let length = images[0].files.length;
            //dosyaların kendisi
            let files = images[0].files;
            //dosya uzantıları kontrolü
            let checkImage = ['png', 'jpg', 'jpeg'];

            for (let i = 0; i < length; i++) {
                let type = files[i].type.split('/').pop();
                // resim size'lerini yani boyutlarını alıyoruz.
                let size = files[i].size;
                // type, checkImage içerisinde var mı diyoruz.
                if ($.inArray(type, checkImage) == '-1') {
                    swal.fire({
                        icon: 'error',
                        title: 'Uyarı !',
                        text: 'Dosya uzantıları .png, .jpg, .jpeg olabilir.',
                        confirmButtonText: 'Tamam'
                    });
                    return false;
                }
                // boyut 2 mb'dan büyükse
                if (size > 2048000) {
                    swal.fire({
                        icon: 'error',
                        title: 'Uyarı !',
                        text: "Dosya boyutu 2MB'dan büyük olamaz",
                        confirmButtonText: 'Tamam'
                    });
                    return false;
                }
            }
            return true;
        }

        let createButton = $('#createButton');
        createButton.click(function () {
            let imageCheckStatus = imageCheck($('#images'));

            if (!imageCheckStatus) {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Seçtiğiniz resimleri kontrol ediniz.',
                    confirmButtonText: 'Tamam'
                });
            } else if ($('#title').val().trim() == '') {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Başlık alanı boş bırakılamaz.',
                    confirmButtonText: 'Tamam'
                });
            } else if ($('#tags').val().trim() == '') {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Etiket alanı boş bırakılamaz.',
                    confirmButtonText: 'Tamam'
                });
            } else {
                // else durumunda formu post ediyoruz.
                $('#portfolioForm').submit();
            }

        });
        @endisset

    </script>



@endsection
