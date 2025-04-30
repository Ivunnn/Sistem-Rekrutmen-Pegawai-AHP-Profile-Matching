@extends('adminlte::page')

@section('title', 'AHP Management')

@section('content_header')
<div class="row mb-2">
  <div class="col-md-6 col-12">
    <h1>AHP Calculations</h1>
  </div>
  <div class="col-md-6 col-12 text-md-right text-left mt-2 mt-md-0">
    <a class="btn btn-primary" href="{{ route('ahp.create') }}">Add New Calculation</a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  @include('partials.alert')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">List of AHP Calculations</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="ahp-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Created By</th>
              <th>Consistency Ratio</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($calculations as $index => $calculation)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $calculation->nama }}</td>
              <td>{{ $calculation->user->name }}</td>
              <td>{{ number_format($calculation->consistency_ratio, 4) }}</td>
              <td>
                @if ($calculation->consistency_ratio < 0.1)
                <span class="badge badge-success">Consistent</span>
                @else
                <span class="badge badge-danger">Inconsistent</span>
                @endif
              </td>
              <td>{{ $calculation->created_at->format('d M Y H:i') }}</td>
              <td>
                <a class="btn btn-info btn-sm" href="{{ route('ahp.show', $calculation->id) }}">
                  <i class="fas fa-eye"></i> View
                </a>
                <form action="{{ route('ahp.destroy', $calculation->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this calculation?')">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
$(document).ready(function() {
  $('#ahp-table').DataTable({
    responsive: true,
    autoWidth: false,
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true
  });
});
</script>
@stop
