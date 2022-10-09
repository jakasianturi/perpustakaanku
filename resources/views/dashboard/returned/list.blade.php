@extends('dashboard.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengembalian Buku</h1>
</div>
@if (session('message'))
<div class="alert alert-success alert-dismissible fade show mb-4 border-left-success mb-4" role="alert">
  {{ session('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<!-- Returned List -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataReturned" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" style="width: 10%">Nama Peminjam</th>
            <th scope="col" style="width: 15%">Judul Buku</th>
            <th scope="col" style="width: 10%">Tanggal Peminjaman</th>
            <th scope="col" style="width: 10%">Batas Pengembalian</th>
            <th scope="col" style="width: 10%">Tanggal Pengembalian</th>
            <th scope="col" style="width: 10%">Status</th>
            <th scope="col" style="width: 5%">Denda</th>
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
        <p>Apakah Anda yakin ingin menghapus Pengembalian?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button id="deleteData" type="button" class="btn btn-danger">Hapus Pengembalian</button>
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
  $('#dataReturned').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('dashboard.returneds.index') }}",
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
// Delete Data
$(document).on('click', '.delete', function () {
  dataId = $(this).attr('id');
  $('#deleteModal').modal('show');
});

$('#deleteData').click(function () {
  $.ajax({
    url: "returneds/"+dataId,
    type: 'DELETE',
    success: function (data) { 
      setTimeout(function () {
        $('#deleteModal').modal('hide');
        var oTable = $('#dataReturned').dataTable();
        oTable.fnDraw(false);
      });
      iziToast.warning({
        title: 'Pengembalian Berhasil Dihapus',
        message: '{{ Session('
        delete ')}}',
        position: 'bottomRight'
      });
    }
  })
});
</script>
@endsection