@extends('layouts.app')

@section('title', 'Safety Inspection List')
@section('page-title', 'Safety Inspection List')

@section('content')

<div class="container-fluid mt-4 col-md-9">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Inspections</h3>
            <div class="card-tools">
                <a href="{{ route('safetycheck.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Job Number</th>
                        <th>Customer</th>
                        <th>Contact No</th>
                        <th>Property Address</th>
                        <th>Previous Inspection</th>
                        <th>Inspection Date</th>
                        <th>Next Due</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checks as $check)
                    <tr>
                        <td>{{ $check->job_number ?? '-' }}</td>
                        <td>{{ $check->customer ?? '-' }}</td>
                        <td>{{ $check->contact ?? '-' }}</td>
                        <td>{{ $check->property_address ?? '-' }}</td>
                        <td>{{ $check->previous_inspection ?? '-' }}</td>
                        <td>{{ $check->inspection_date ?? '-' }}</td>
                        <td>{{ $check->next_inspection_due ?? '-' }}</td>
                        <td>{{ $check->created_at->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('safetycheck.exportpdf', $check->id) }}" target="_blank"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection