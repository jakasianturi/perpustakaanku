@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peminjaman Buku</h1>
    </div>
    <!-- Add Borrow -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $borrow->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($borrow))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="user_id">Nama Peminjam</label>
                    <div class="col-sm-9">
                        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                            style="width: 100%;">
                            @if (old('user_id') || isset($borrow->user_id))
                                @foreach ($users as $user)
                                    <option @if ((old('user_id') ?? ($borrow->user_id ?? '')) == $user->id) selected @endif value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="book_id">Nama Buku</label>
                    <div class="col-sm-9">
                        <select id="book_id" name="book_id" class="form-control @error('book_id') is-invalid @enderror"
                            style="width: 100%;">
                            @if (old('book_id') || isset($borrow->book_id))
                                @foreach ($books as $book)
                                    <option @if ((old('book_id') ?? ($borrow->book_id ?? '')) == $book->id) selected @endif value="{{ $book->id }}">
                                        {{ $book->title }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="borrow_date">Tanggal Peminjaman</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('borrow_date') is-invalid @enderror"
                            name="borrow_date" id="borrow_date"
                            value="{{ old('borrow_date') ?? ($borrow->borrow_date ?? '') }}">
                        @error('borrow_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="return_date">Batas Pengembalian</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                            name="return_date" id="return_date"
                            value="{{ old('return_date') ?? ($borrow->return_date ?? '') }}">
                        @error('return_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="total">Jumlah Buku</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control @error('total') is-invalid @enderror" name="total"
                            min="0" id="total" value="{{ old('total') ?? ($borrow->total ?? '') }}"
                            placeholder="Jumlah Buku">
                        @error('total')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline @error('status') is-invalid @enderror">
                                <input name="status" class="form-check-input" type="radio" id="belumdisetujui"
                                    value="Belum Disetujui" @if ((old('status') ?? ($borrow->status ?? '')) == 'Belum Disetujui') checked @endif>
                                <label class="form-check-label" for="belumdisetujui">Belum Disetujui</label>
                            </div>
                            <div class="form-check form-check-inline @error('status') is-invalid @enderror">
                                <input name="status" class="form-check-input" type="radio" id="aktif" value="Aktif"
                                    @if ((old('status') ?? ($borrow->status ?? '')) == 'Aktif') checked @endif>
                                <label class="form-check-label" for="aktif">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline @error('status') is-invalid @enderror">
                                <input name="status" class="form-check-input" type="radio" id="diperpanjang"
                                    value="Diperpanjang" @if ((old('status') ?? ($borrow->status ?? '')) == 'Diperpanjang') checked @endif>
                                <label class="form-check-label" for="diperpanjang">Diperpanjang</label>
                            </div>
                            <div class="form-check form-check-inline @error('status') is-invalid @enderror">
                                <input name="status" class="form-check-input" type="radio" id="selesai" value="Selesai"
                                    @if ((old('status') ?? ($borrow->status ?? '')) == 'Selesai') checked @endif>
                                <label class="form-check-label" for="selesai">Selesai</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($borrow))
                            <a href="{{ route('dashboard.borrows.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">{{ $button }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customStyle')
    <script>
        // Member Search
        $('#user_id').select2({
            placeholder: 'Cari anggota...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('dashboard.borrows.getDataMember') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // Book Search
        $('#book_id').select2({
            placeholder: 'Cari buku...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('dashboard.borrows.getDataBook') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
