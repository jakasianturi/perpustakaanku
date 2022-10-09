@extends('dashboard.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Log Files</h1>
</div>
<!-- Log List -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataLog" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="row" style="width: 5%">#</th>
            <th scope="col" style="width: 35%">File Name</th>
            <th scope="col" style="width: 10%">Size</th>
            <th scope="col" style="width: 20%">Time</th>
            <th scope="col" class="text-center" style="width: 30%">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @forelse($logFiles as $key => $logFile)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $logFile->getFilename() }}</td>
            <td>{{ $logFile->getSize() }}</td>
            <td>{{ date('Y-m-d H:i:s', $logFile->getMTime()) }}</td>
            <td>
              <a class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"
                href="{{ route('dashboard.log-files.show', $logFile->getFilename()) }}"
                title="Show file {{ $logFile->getFilename() }}"><i class="fas fa-eye fa-sm"></i> View</a> |
              <a class="d-sm-inline-block btn btn-sm btn-info shadow-sm mx-1"
                href="{{ route('dashboard.log-files.download', $logFile->getFilename()) }}"
                title="Download file {{ $logFile->getFilename() }}"><i class="fas fa-download fa-sm"></i> Download</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3">No Log File Exists</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection