@extends('member.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengembalian Buku</h1>
</div>
<!-- ReturnedNonActive List -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataReturnedNonActive" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" style="width: 10%">Nama Peminjam</th>
            <th scope="col" style="width: 15%">Judul Buku</th>
            <th scope="col" style="width: 10%">Tanggal Peminjaman</th>
            <th scope="col" style="width: 10%">Batas Pengembalian</th>
            <th scope="col" style="width: 10%">Tanggal Pengembalian</th>
            <th scope="col" style="width: 10%">Status</th>
            <th scope="col" style="width: 5%">Denda</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection
@section('customStyle')
<script>
// Datatable
$(document).ready(function() {
  $('#dataReturnedNonActive').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('member.returneds.nonactive') }}",
      type: 'GET'
    },
    columns: [{
        data: 'users',
        name: 'users'
      },
      {
        data: 'books',
        name: 'books'
      },
      {
        data: 'borrow_date',
        name: 'borrow_date'
      },
      {
        data: 'return_date',
        name: 'return_date'
      },
      {
        data: 'returned_date',
        name: 'returned_date'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'book_fine',
        name: 'book_fine'
      },
    ],
    order: [
      [0, 'asc']
    ],
    language: {
      url: '{{ asset("vendor/datatables/dataTables.indonesia.json") }}'
    },
    "rowCallback": function(row, data) {
      if (data.status == "Belum Disetujui") {
        $("td:nth-child(6)", row).addClass("text-warning font-weight-bold")
      }
      if (data.status == "Aktif") {
        $("td:nth-child(6)", row).addClass("text-success font-weight-bold")
      }
      if (data.status == "Diperpanjang") {
        $("td:nth-child(6)", row).addClass("text-primary font-weight-bold")
      }
      if (data.status == "Selesai") {
        $("td:nth-child(6)", row).addClass("text-danger font-weight-bold")
      }
    }
  });
});
</script>
@endsection