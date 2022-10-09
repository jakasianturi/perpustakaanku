@extends('member.layouts.app')

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
                    <label class="col-sm-3 col-form-label" for="book_id">Nama Buku</label>
                    <div class="col-sm-9">
                        <select id="book_id" name="book_id" class="form-control @error('book_id') is-invalid @enderror"
                            style="width: 100%;">
                            @if (old('book_id') || isset($borrow->book_id) || isset($_GET['id_book']))
                                @foreach ($books as $book)
                                    <option @if ((old('book_id') ?? ($borrow->book_id ?? '') ?? ($_GET['id_book'] ?? '')) == $book->id) selected @endif value="{{ $book->id }}">
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
                    <label class="col-sm-3 col-form-label" for="total">Jumlah Buku</label>
                    <div class="col-sm-9">
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
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($borrow))
                            <a href="{{ route('member.borrows.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customStyle')
    <script>
        // Book Search
        $('#book_id').select2({
            placeholder: 'Cari buku...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('member.borrows.getDataBook') }}",
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
