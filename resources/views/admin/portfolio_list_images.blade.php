@extends('layouts.admin')

@section('title')
    Portfolio Resim Listesi
@endsection

@section('css')
    <style>
        .table th img, .jsgrid .jsgrid-table th img, .table td img, .jsgrid .jsgrid-table td img {
            width: 75px !important;
            height: unset !important;
            border-radius: unset !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Portfolio Resim Listesi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolio Resim Listesi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-4">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"
                           class="btn btn-primary btn-block">Yeni Portfolio
                            Resim
                            Ekle</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Resim</th>
                                <th>Öne Çıkart</th>
                                <th>Status</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                                <th>Sil</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $say = 1; ?>
                            @foreach($images as $list)

                                <tr id="{{$list->id}}">
                                    <td> {{ $say }}</td>
                                    <td>

                                        <img
                                            src="{{ $list->image ? asset('storage/portfolio/'.$list->image) : '-'}}"
                                            alt="">

                                    </td>
                                    <td>
                                        <a data-id="{{$list->id}}" href="javascript:void(0)"
                                           class="btn {{ $list->featured ? 'btn-success featuredImage' : 'btn-warning featureImage'}} "><i
                                                class="fa fa-eye"> </i>{{ $list->featured ? 'Öne Çıkarılmış' : 'Öne Çıkart'}}
                                        </a>
                                    </td>

                                    <td>
                                        @if ($list->status)
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-success changeStatus">Aktif</a>
                                        @else
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-danger changeStatus">Pasif</a>
                                        @endif
                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($list->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td> {{ \Carbon\Carbon::parse($list->updated_at)->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <a data-id="{{$list->id}}" href="javascript:void(0)"
                                           class="btn btn-danger deletePortfolio"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php $say++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Resim Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST" id="newImageForm" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="images[]" id="images" multiple>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" id="saveImage" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#images').change(function () {
            let images = $(this);

            let imageCheckStatus = imageCheck(images);

        });

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

        $('#saveImage').click(function () {
            let imageCheckStatus = imageCheck($('#images'));

            if (!imageCheckStatus) {
                swal.fire({
                    icon: 'error',
                    title: 'Uyarı !',
                    text: 'Seçtiğiniz resimleri kontrol ediniz.',
                    confirmButtonText: 'Tamam'
                });
            } else {
                $('#newImageForm').submit();
            }
        });


        //her projede kullanıyor olacağız.
        $.ajaxSetup({
            headers: {
                //meta'daki değeri 'X-CSRF-TOKEN' a atıyoruz.
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.changeStatus').click(function () {
            let portfolioID = $(this).attr('data-id');
            let self = $(this);
            let route = '{{ route('portfolio.changeStatusImage', ['id' => 'featureImage']) }}';
            let finalRoute = route.replace('featureImage', portfolioID);
            $.ajax({
                url: finalRoute,
                // method: "POST"
                type: "POST",
                // async senkronize olmasın diyoruz
                async: false,
                data: {
                    id: portfolioID
                },
                success: function (response) {

                    swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        text: response.id + " ID'li kayıt durumu " + response.newStatus + " olarak güncellenmiştir.",
                        confirmButtonText: 'Tamam'
                    });
                    if (response.status == 1) {
                        self[0].innerText = 'Aktif';
                        self.removeClass('btn-danger');
                        self.addClass('btn-success');
                    } else if (response.status == 0) {
                        self[0].innerText = 'Pasif';
                        self.removeClass('btn-success');
                        self.addClass('btn-danger');
                    }
                },
                error: function () {

                }
            })

        });


        $('.deletePortfolio').click(function () {
            let portfolioID = $(this).attr('data-id');

            Swal.fire({
                title: "Silmek istediğinize emin misiniz? ",
                text: portfolioID + " ID'li portfolio resmini silmek istediğinize emin misniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {

                    let route = '{{ route('portfolio.deleteImage', ['id' => 'deletePortfolio']) }}';
                    let finalRoute = route.replace('deletePortfolio', portfolioID);
                    $.ajax({
                        url: finalRoute,
                        // method: "POST"
                        type: "POST",
                        // async senkronize olmasın diyoruz
                        async: false,
                        data: {
                            '_method': 'DELETE'
                        },
                        success: function (response) {

                            swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: "Silme işlemi başarılı.",
                                confirmButtonText: 'Tamam'
                            });
                            $("tr#" + portfolioID).remove();
                        },
                        error: function () {

                        }
                    })
                }
            })


        });

        $(document).on('click', '.featureImage', function () {

            let featureImage = $(this).attr('data-id');
            let self = $(this);
            Swal.fire({
                title: "Silmek istediğinize emin misiniz? ",
                text: featureImage + " ID'li portfolio resmini öne çıkarmak istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {

                    let route = '{{ route('portfolio.featureImage', ['id' => 'featureImage']) }}';
                    let finalRoute = route.replace('featureImage', featureImage);
                    $.ajax({
                        url: finalRoute,
                        // method: "POST"
                        type: "POST",
                        // async senkronize olmasın diyoruz
                        async: false,
                        data: {
                            '_method': 'PUT'
                        },
                        success: function (response) {

                            swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: "Öne çıkarma işlemi başarılı.",
                                confirmButtonText: 'Tamam'
                            });
                            $('.featuredImage').removeClass('btn-success');
                            $('.featuredImage').addClass('btn-warning');
                            $('.featuredImage').html('Öne Çıkart');
                            $('.featuredImage').addClass('featureImage');
                            $('.featuredImage').removeClass('featuredImage');

                            self.removeClass('btn-warning');
                            self.addClass('btn-success');
                            self.removeClass('featureImage');
                            self.addClass('featuredImage');
                            self.html('Öne Çıkarılmış');
                        },
                        error: function () {

                        }
                    })
                }
            })


        });

    </script>
@endsection
