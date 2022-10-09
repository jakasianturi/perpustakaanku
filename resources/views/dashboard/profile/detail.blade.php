@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    </div>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-left-success mb-4" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row gutters-sm">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <form method="post">
                        <figure class="image_area position-relative rounded-circle font-weight-bold overflow-hidden mx-2"
                            style="height: 150px; width: 150px;" data-initial="User">
                            <img src="{{ isset($user->avatar) ? asset('storage/uploads/' . $user->avatar) : asset('img/undraw_male_avatar_323b.svg') }}"
                                id="avatar" class="d-block w-100 h-100" />
                            <div class="overlay d-flex justify-content-center align-items-center">
                                <span class="text-center text-dark m-0 p-2" style="font-size: 0.875rem;" data-toggle="modal"
                                    data-target="#uploadimageModal">Klik untuk mengubah foto profil</span>
                            </div>
                        </figure>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="uploadimageModal" tabindex="-1" role="dialog"
                        aria-labelledby="uploadimageModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto Profil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div id="image_demo"></div>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <button class="btn btn-primary position-relative">
                                                <span>Pilih Gambar</span>
                                                <input type="file" name="upload_image" id="upload_image"
                                                    accept="image/*" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button id="crop" type="button" class="btn btn-primary crop_image">Potong dan
                                        Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $user->name ?? '' }}</h5>
                                <p>{{ ucfirst(trans($user->user_role)) ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow  mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->name ?? '' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->email ?? '' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @isset($user->gender)
                                {{ ucfirst(trans($user->gender)) ?? '' }}
                            @endisset
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">No. Telepon</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->phone ?? '' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->address ?? '' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn btn-primary"
                                href="{{ route('dashboard.profiles.edit', $user->id, '/edit') }}">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customStyle')
    <style>
        #upload_image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        img {
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 180px;
            height: 180px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }

        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 150,
                    height: 150,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                },
                showZoomer: true,
                mouseWheelZoom: 'ctrl'
            });

            $('#upload_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.crop_image').click(function(event) {
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response) {
                    $.ajax({
                        url: "{{ route('dashboard.profiles.updateAvatar') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            "avatar": response,
                            "id": "{{ $user->id }}"
                        },
                        success: function(data) {
                            $('#uploadimageModal').modal('hide');
                            document.getElementById("avatar").src = response;
                            alert("Selamat, foto profil berhasil diperbaharui.");
                        }
                    });
                })
            });
        });
    </script>
@endsection
