@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan Situs</h1>
    </div>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-left-success mb-4" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Site Settings -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <ul class="nav nav-pills mb-3 pb-3 border-bottom overflow-auto flex-nowrap" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-generalSetting-tab" data-toggle="pill" href="#pills-generalSetting"
                        role="tab" aria-controls="pills-generalSetting" aria-selected="true">Pengaturan Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-socialMedia-tab" data-toggle="pill" href="#pills-socialMedia"
                        role="tab" aria-controls="pills-socialMedia" aria-selected="false">Media Sosial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contactUs-tab" data-toggle="pill" href="#pills-contactUs" role="tab"
                        aria-controls="pills-contactUs" aria-selected="false">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-aboutUs-tab" data-toggle="pill" href="#pills-aboutUs" role="tab"
                        aria-controls="pills-aboutUs" aria-selected="false">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-meta-tab" data-toggle="pill" href="#pills-meta" role="tab"
                        aria-controls="pills-meta" aria-selected="false">Meta</a>
                </li>
            </ul>
            <form action="{{ route('dashboard.settings.update', $setting->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="tab-content" id="pills-tabContent">
                    <!-- General Setting -->
                    <div class="tab-pane fade show active" id="pills-generalSetting" role="tabpanel"
                        aria-labelledby="pills-generalSetting-tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="site_name">Nama Situs</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                    name="site_name" id="site_name" value="{{ $setting->site_name ?? '' }}"
                                    placeholder="Nama Situs">
                                @error('site_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Nama Situs tidak boleh lebih dari <span class="text-danger"> 100 karakter</span>. Saran
                                    panjang karakter
                                    adalah 50-60 karakter.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-4">
                                <img id="image-previewLogo"
                                    src="{{ isset($setting->logo) ? asset('storage/uploads/' . $setting->logo) : '' }}"
                                    class="d-block img-thumbnail rounded p-0 border-0 my-2" width="150">
                                <div class="custom-file position-relative @error('logo') is-invalid @enderror">
                                    <input type="file" class="custom-file-input fileLogo position-absolute"
                                        name="logo" id="logo" value="{{ old('logo') ?? ($setting->logo ?? '') }}">
                                    <div class="input-group position-absolute" style="z-index: 999;">
                                        <input type="text" class="form-control" disabled placeholder="Unggah File"
                                            id="fileLogo">
                                        <div class="input-group-append">
                                            <button type="button" class="browseLogo btn btn-primary">Pilih</button>
                                        </div>
                                    </div>
                                </div>
                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Ukuran logo tidak boleh lebih dari <span class="text-danger"> 1Mb</span>. Dimensi logo
                                    tidak boleh lebih
                                    dari: <span class="text-danger"> lebar = 400px, tinggi = 120px</span> dan tidak boleh
                                    kurang dari: <span class="text-danger"> lebar = 100px, tinggi = 30px</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Favicon</label>
                            <div class="col-sm-4">
                                <img id="image-previewFavicon"
                                    src="{{ isset($setting->favicon) ? asset('storage/uploads/' . $setting->favicon) : '' }}"
                                    class="d-block img-thumbnail rounded p-0 border-0 my-2" width="70">
                                <div class="custom-file position-relative @error('favicon') is-invalid @enderror">
                                    <input type="file" class="custom-file-input fileFavicon position-absolute"
                                        name="favicon" id="favicon"
                                        value="{{ old('favicon') ?? ($setting->favicon ?? '') }}">
                                    <div class="input-group position-absolute" style="z-index: 999;">
                                        <input type="text" class="form-control" disabled placeholder="Unggah File"
                                            id="fileFavicon">
                                        <div class="input-group-append">
                                            <button type="button" class="browseFavicon btn btn-primary">Pilih</button>
                                        </div>
                                    </div>
                                </div>
                                @error('favicon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Ukuran favicon tidak boleh lebih dari <span class="text-danger"> 512kb</span>. Dimensi
                                    favicon tidak
                                    boleh lebih
                                    dari: <span class="text-danger"> lebar = 512px, tinggi = 512px</span> dan tidak boleh
                                    kurang dari: <span class="text-danger"> lebar = 30px, tinggi = 30px</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="ga_code">Google Analytics Code</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('ga_code') is-invalid @enderror" name="ga_code" id="ga_code" rows="5"
                                    placeholder="Google Analytics Code">{{ $setting->ga_code ?? '' }}</textarea>
                                @error('ga_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Untuk mendapatkan kode Google Analytics dapat membaca dokumentasinya di <a
                                        class="text-decoration-none"
                                        href="https://support.google.com/analytics/answer/1008015?hl=id"
                                        target="_blank">Google Analytics</a>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="site_footer">Footer Teks</label>
                            <div class="col-sm-9">
                                <textarea rows="5" id="site_footer" class="form-control @error('site_footer') is-invalid @enderror"
                                    name="site_footer" placeholder="Footer Teks">{{ old('site_footer') ?? ($setting->site_footer ?? '') }}</textarea>
                                @error('site_footer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Dapat menggunakan tag HTML.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <a href="{{ route('dashboard.settings.index') }}"
                                    class="btn btn-secondary mr-2 mt-2">Batal</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="tab-pane fade" id="pills-socialMedia" role="tabpanel"
                        aria-labelledby="pills-socialMedia-tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="social_facebook">Facebook</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('social_facebook') is-invalid @enderror"
                                    name="social_facebook" id="social_facebook"
                                    value="{{ $setting->social_facebook ?? '' }}">
                                @error('social_facebook')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan link url profil/halaman facebook. Mis: <span class="text-info">
                                        https://facebook.com/username</span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="social_twitter">Twitter</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  @error('social_twitter') is-invalid @enderror"
                                    name="social_twitter" id="social_twitter"
                                    value="{{ $setting->social_twitter ?? '' }}">
                                @error('social_twitter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan link url profil twitter. Mis: <span class="text-info">
                                        https://twitter.com/username</span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="social_instagram">Instagram</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('social_instagram') is-invalid @enderror"
                                    name="social_instagram" id="social_instagram"
                                    value="{{ $setting->social_instagram ?? '' }}">
                                @error('social_instagram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan link url profil instagram. Mis: <span class="text-info">
                                        https://instagram.com/username</span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <a href="{{ route('dashboard.settings.index') }}"
                                    class="btn btn-secondary mr-2 mt-2">Batal</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Us -->
                    <div class="tab-pane fade" id="pills-contactUs" role="tabpanel"
                        aria-labelledby="pills-contactUs-tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="email">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ $setting->email ?? '' }}"
                                    placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan alamat email. Mis: <span class="text-info">
                                        username@gmail.com</span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="phone">No. Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" id="phone" value="{{ $setting->phone ?? '' }}"
                                    placeholder="No. Telepon">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan no Telp diawali dengan <strong>+62</strong> dan tidak ada spasi atau tanda
                                    (-). Mis: <span class="text-info">
                                        +6281234567890</span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="operational_time">Jam Operasional</label>
                            <div class="col-sm-9">
                                <input type="text"
                                    class="form-control @error('operational_time') is-invalid @enderror"
                                    name="operational_time" id="operational_time"
                                    value="{{ $setting->operational_time ?? '' }}" placeholder="Jam Operasional">
                                @error('operational_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="google_map">Google Map</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('google_map') is-invalid @enderror" name="google_map" id="google_map"
                                    rows="5" placeholder="Google Map">{{ $setting->google_map ?? '' }}</textarea>
                                @error('google_map')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Isi dengan script Google Map Iframe. Dokumentasinya ada di <span class="text-info"><a
                                            class="text-decoration-none"
                                            href="https://developers.google.com/maps/documentation/embed/get-started"
                                            target="_blank">Google
                                            Map</a>
                                    </span>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="address">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="5"
                                    placeholder="Alamat">{{ $setting->address ?? '' }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Alamat tidak boleh lebih dari <span class="text-danger"> 250 karakter</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <a href="{{ route('dashboard.settings.index') }}"
                                    class="btn btn-secondary mr-2 mt-2">Batal</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- About Us -->
                    <div class="tab-pane fade" id="pills-aboutUs" role="tabpanel" aria-labelledby="pills-aboutUs-tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="about_title">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('about_title') is-invalid @enderror"
                                    name="about_title" id="about_title" value="{{ $setting->about_title ?? '' }}"
                                    placeholder="Judul">
                                @error('about_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Judul tidak boleh lebih dari <span class="text-danger"> 50 karakter</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Thumbnail</label>
                            <div class="col-sm-4">
                                <img id="image-previewAboutThumbnail"
                                    src="{{ isset($setting->about_thumbnail) ? asset('storage/uploads/' . $setting->about_thumbnail) : '' }}"
                                    class="d-block img-thumbnail rounded p-0 border-0 my-2" width="150">
                                <div class="custom-file position-relative @error('about_thumbnail') is-invalid @enderror">
                                    <input type="file" class="custom-file-input fileAboutThumbnail position-absolute"
                                        name="about_thumbnail" id="about_thumbnail"
                                        value="{{ old('about_thumbnail') ?? ($setting->about_thumbnail ?? '') }}">
                                    <div class="input-group position-absolute" style="z-index: 999;">
                                        <input type="text" class="form-control" disabled placeholder="Unggah File"
                                            id="fileAboutThumbnail">
                                        <div class="input-group-append">
                                            <button type="button"
                                                class="browseAboutThumbnail btn btn-primary">Pilih</button>
                                        </div>
                                    </div>
                                </div>
                                @error('about_thumbnail')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Ukuran thumbnail tidak boleh lebih dari <span class="text-danger"> 2Mb</span>.
                                    Disarankan dimensi
                                    thumbnail:
                                    <span class="text-danger"> lebar = 1200px, tinggi = 480px</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="about_content">Deskripsi Perpustakaan</label>
                            <div class="col-sm-9">
                                <textarea id="about_content" class="form-control @error('about_content') is-invalid @enderror" name="about_content"
                                    placeholder="Deskripsi Perpustakaan">{{ $setting->about_content ?? '' }}</textarea>
                                @error('about_content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <a href="{{ route('dashboard.settings.index') }}"
                                    class="btn btn-secondary mr-2 mt-2">Batal</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- Meta -->
                    <div class="tab-pane fade" id="pills-meta" role="tabpanel" aria-labelledby="pills-meta-tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="meta_description">Meta Description</label>
                            <div class="col-sm-9">
                                <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                                    name="meta_description" placeholder="Meta Description" rows="5">{{ $setting->meta_description ?? '' }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Meta Description tidak boleh lebih dari <span class="text-danger"> 160 karakter</span>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="meta_keyword">Meta Keyword</label>
                            <div class="col-sm-9">
                                <textarea id="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword"
                                    placeholder="Meta Keyword" rows="5">{{ $setting->meta_keyword ?? '' }}</textarea>
                                @error('meta_keyword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Meta Keyword tidak boleh lebih dari <span class="text-danger"> 250 karakter</span> dan
                                    dipisahkan
                                    dengan tanda (,).
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <a href="{{ route('dashboard.settings.index') }}"
                                    class="btn btn-secondary mr-2 mt-2">Batal</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customStyle')
    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
    <script>
        // Browse logo
        $(document).ready(function() {
            document.querySelector(".browseLogo").addEventListener("click", triggerInput);

            function triggerInput() {
                var file = $(this).parents().find(".fileLogo");
                file.trigger("click");
            };
            document.getElementById("logo").addEventListener("change", changeFileName);

            function changeFileName(e) {
                var fileName = e.target.files[0].name;
                $("#fileLogo").val(fileName);
            };
            document.getElementById("logo").addEventListener("change", imagePreviewLogo);

            function imagePreviewLogo() {
                let reader = new FileReader();
                reader.onload = function() {
                    let output = document.getElementById('image-previewLogo');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Browse favicon
        $(document).ready(function() {
            document.querySelector(".browseFavicon").addEventListener("click", triggerInput);

            function triggerInput() {
                var file = $(this).parents().find(".fileFavicon");
                file.trigger("click");
            };
            document.getElementById("favicon").addEventListener("change", changeFileName);

            function changeFileName(e) {
                var fileName = e.target.files[0].name;
                $("#fileFavicon").val(fileName);
            };
            document.getElementById("favicon").addEventListener("change", imagePreviewFavicon);

            function imagePreviewFavicon() {
                let reader = new FileReader();
                reader.onload = function() {
                    let output = document.getElementById('image-previewFavicon');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Browse about thumbnail
        $(document).ready(function() {
            document.querySelector(".browseAboutThumbnail").addEventListener("click", triggerInput);

            function triggerInput() {
                var file = $(this).parents().find(".fileAboutThumbnail");
                file.trigger("click");
            };
            document.getElementById("about_thumbnail").addEventListener("change", changeFileName);

            function changeFileName(e) {
                var fileName = e.target.files[0].name;
                $("#fileAboutThumbnail").val(fileName);
            };
            document.getElementById("about_thumbnail").addEventListener("change", imagePreviewAboutThumbnail);

            function imagePreviewAboutThumbnail() {
                let reader = new FileReader();
                reader.onload = function() {
                    let output = document.getElementById('image-previewAboutThumbnail');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // laravel-filemanager with Summernote
        $(document).ready(function() {
            // Define function to open filemanager window
            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = cb;
            };
            // Define LFM summernote button
            var LFMButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Masukkan Gambar',
                    click: function() {
                        lfm({
                            type: 'image',
                            prefix: '/laravel-filemanager'
                        }, function(lfmItems, path) {
                            lfmItems.forEach(function(lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };
            // Initialize summernote with LFM button in the popover button group
            // Please note that you can add this button to any other button group you'd like
            $('#about_content').summernote({
                height: 400,
                maxHeight: 400,
                lang: 'id-ID',
                buttons: {
                    lfm: LFMButton
                },
                toolbar: [
                    ['popovers', ['lfm']],
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
            })
        });
    </script>
@endsection
