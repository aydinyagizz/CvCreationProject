@extends('layouts.admin')

@section('title')
    Portfolio Listesi
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
        <h3 class="page-title"> Portfolio Listesi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolio Listesi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-4">
                        <a href=" {{ route('portfolio.create') }}" class="btn btn-primary btn-block">Yeni Portfolio
                            Ekle</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Öne Çıkarılan Resim</th>
                                <th>Başlığı</th>
                                <th>Etiketler</th>
                                <th>Hakkında</th>
                                <th>Status</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                                <th>Düzenle</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $say = 1; ?>
                            @foreach($list as $list)

                                <tr id="{{$list->id}}">
                                    <td> {{ $say }}</td>
                                    <td>
                                        <a href="{{ route('portfolio.showImages', ['id' => $list->id]) }}">
                                            <img
                                                src="{{ $list->featuredImage ? asset('storage/portfolio/'.$list->featuredImage->image) : '-'}}"
                                                alt="">
                                        </a>
                                    </td>
                                    <td> {{ $list->title }}</td>
                                    <td> {{ $list->tags }}</td>
                                    <td title="{!! strip_tags($list->about) !!}"> {!! strip_tags(substr($list->about, 0, 50)) !!}</td>
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
                                    <td><a href="{{ route('portfolio.edit', ['portfolio' => $list->id]) }}"
                                           class="btn btn-primary editEducation"><i class="fa fa-edit"></i></a>
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

@endsection

@section('js')
    <script>
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
            $.ajax({
                url: "{{ route('portfolio.changeStatus') }}",
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
                        text: response.portfolioID + " ID'li kayıt durumu " + response.newStatus + " olarak güncellenmiştir.",
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
                text: portfolioID + " ID'li portfolio bilgisini silmek istediğinize emin misniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {

                    let route = '{{ route('portfolio.destroy', ['portfolio' => 'deletePortfolio']) }}';
                    let finalRoute = route.replace('deletePortfolio', portfolioID);
                    $.ajax({
                        url: finalRoute,
                        // method: "POST"
                        type: "POST",
                        // async senkronize olmasın diyoruz
                        async: false,
                        data: {
                            portfolio: portfolioID,
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
    </script>
@endsection
