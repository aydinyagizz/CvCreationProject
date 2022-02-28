@extends('layouts.admin')

@section('title')
    Deneyim Bilgileri Listesi
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Deneyim Bilgileri Listesi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deneyim Bilgileri Listesi</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-4">
                        <a href=" {{ route('admin.experience.add') }}" class="btn btn-primary btn-block">Yeni Deneyim
                            Ekle</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Çalışma Tarihi</th>
                                <th>Pozisyon</th>
                                <th>Firma</th>
                                <th>Açıklama</th>
                                <th>Status</th>
                                <th>Active</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                                <th>Düzenle</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $say = 1; ?>
                            @foreach($list as $list)
                                <tr id="{{$list->id}}">
                                    <td> {{ $say}}</td>
                                    <td> {{ $list->date }}</td>
                                    <td> {{ $list->task_name }}</td>
                                    <td> {{ $list->company_name }}</td>
                                    <td> {{ $list->description }}</td>
                                    <td>
                                        @if ($list->status)
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-success changeStatus">Aktif</a>
                                        @else
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-danger changeStatus">Pasif</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($list->active)
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-success activeStatus">Aktif</a>
                                        @else
                                            <a data-id="{{$list->id}}" href="javascript:void(0)"
                                               class="btn btn-danger activeStatus">Pasif</a>
                                        @endif
                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($list->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td> {{ \Carbon\Carbon::parse($list->updated_at)->format('d-m-Y H:i:s') }}</td>
                                    <td><a href="{{ route('admin.experience.add', ['experienceID' => $list->id]) }}"
                                           class="btn btn-primary editExperience"><i class="fa fa-edit"></i></a>
                                        <a data-id="{{$list->id}}" href="javascript:void(0)"
                                           class="btn btn-danger deleteExperience"><i class="fa fa-trash"></i></a>
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
            let experienceID = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.experience.changeStatus') }}",
                // method: "POST"
                type: "POST",
                // async senkronize olmasın diyoruz

                async: false,
                data: {
                    experienceID: experienceID
                },
                success: function (response) {

                    swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        text: response.experienceID + " ID'li kayıt durumu " + response.newStatus + " olarak güncellenmiştir.",
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

        $('.activeStatus').click(function () {
            let experienceID = $(this).data('id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.experience.activeStatus') }}",
                // method: "POST"
                type: "POST",
                // async senkronize olmasın diyoruz
                async: false,
                data: {
                    experienceID: experienceID
                },
                success: function (response) {

                    swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        text: response.experienceID + " ID'li kayıt active durumu " + response.newActive + " olarak güncellenmiştir.",
                        confirmButtonText: 'Tamam'
                    });
                    if (response.active == 1) {
                        self[0].innerText = 'Aktif';
                        self.removeClass('btn-danger');
                        self.addClass('btn-success');
                    } else if (response.active == 0) {
                        self[0].innerText = 'Pasif';
                        self.removeClass('btn-success');
                        self.addClass('btn-danger');
                    }

                },
                error: function () {

                }
            })

        });

        $('.deleteEducation').click(function () {
            let educationID = $(this).data('id');

            Swal.fire({
                title: "Silmek istediğinize emin misiniz? ",
                text: educationID + " ID'li eğitim bilgisini silmek istediğinize emin misniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.education.delete') }}",
                        // method: "POST"
                        type: "POST",
                        // async senkronize olmasın diyoruz
                        async: false,
                        data: {
                            educationID: educationID
                        },
                        success: function (response) {

                            swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: "Silme işlemi başarılı.",
                                confirmButtonText: 'Tamam'
                            });
                            $("tr#" + educationID).remove();
                        },
                        error: function () {

                        }
                    })
                }
            })


        });
    </script>
@endsection
