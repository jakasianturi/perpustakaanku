@extends('dashboard.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Peminjaman Buku</h1>
  <a href="{{ route('dashboard.borrows.create') }}"
    class="d-sm-inline-block mt-mw-sm-2 btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-plus fa-sm text-white-50 mr-1"></i>
    Tambah Peminjaman</a>
</div>
@if (session('message'))
<div class="alert alert-success alert-dismissible fade show mb-4 border-left-success mb-4" role="alert">
  {{ session('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<!-- Borrow List -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataBorrow" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" style="width: 20%">Nama Peminjam</th>
            <th scope="col" style="width: 20%">Judul Buku</th>
            <th scope="col" style="width: 10%">Tanggal Peminjaman</th>
            <th scope="col" style="width: 10%">Batas Pengembalian</th>
            <th scope="col" style="width: 10%">Status</th>
            <th scope="col" class="text-center" style="width: 30%">&nbsp;</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus Peminjaman?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button id="deleteData" type="button" class="btn btn-danger">Hapus Peminjaman</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('customStyle')
<script>
// CSRF
$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});

// Datatable
$(document).ready(function() {
  $('#dataBorrow').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('dashboard.borrows.index') }}",
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
        data: 'status',
        name: 'status'
      },
      {
        data: 'action',
        name: 'action'
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
        $("td:nth-child(5)", row).addClass("text-warning font-weight-bold")
      }
      if (data.status == "Aktif") {
        $("td:nth-child(5)", row).addClass("text-success font-weight-bold")
      }
      if (data.status == "Diperpanjang") {
        $("td:nth-child(5)", row).addClass("text-primary font-weight-bold")
      }
      if (data.status == "Selesai") {
        $("td:nth-child(5)", row).addClass("text-danger font-weight-bold")
      }
    }
  });
});

// Delete Data
$(document).on('click', '.delete', function () {
  dataId = $(this).attr('id');
  $('#deleteModal').modal('show');
});

$('#deleteData').click(function () {
  $.ajax({
    url: "borrows/"+dataId,
    type: 'DELETE',
    success: function (data) { 
      setTimeout(function () {
        $('#deleteModal').modal('hide');
        var oTable = $('#dataBorrow').dataTable();
        oTable.fnDraw(false);
      });
      iziToast.warning({
        title: 'Peminjaman Berhasil Dihapus',
        message: '{{ Session('
        delete ')}}',
        position: 'bottomRight'
      });
    }
  })
});
</script>
@endsection