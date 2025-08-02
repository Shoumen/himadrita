@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Activity Logs</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Activity Logs</li>
        </ol>
    </nav>
</div>


        {{-- Filter Dropdown --}}
        <form method="GET" action="{{ route('activity.logs') }}" class="row mb-3">
            <div class="col-md-4">
                <select name="log_name" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Filter by Module --</option>
                    <option value="customer" {{ request('log_name') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="supplier" {{ request('log_name') == 'supplier' ? 'selected' : '' }}>Supplier</option>
                    <option value="product" {{ request('log_name') == 'product' ? 'selected' : '' }}>Product</option>
                </select>
            </div>
        </form>
<section class="section customer">
    <div class="table-responsive">
            <table class="table datatable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Who</th>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Changes</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}</td>
                            <td>{{ $log->causer?->name ?? 'System' }}</td>
                            <td><span class="badge bg-info text-dark">{{ ucfirst($log->log_name) }}</span></td>
                            <td><span class="badge bg-secondary">{{ ucfirst($log->description) }}</span></td>
                            <td>
                                @if($log->properties->has('attributes'))
                                    <ul class="mb-0">
                                        @foreach($log->properties['attributes'] as $key => $value)
                                            <li>
                                                <strong>{{ $key }}</strong>:
                                                @if($log->properties->has('old') && isset($log->properties['old'][$key]))
                                                    <span class="text-danger">{{ $log->properties['old'][$key] }}</span>
                                                    →
                                                    <span class="text-success">{{ $value }}</span>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <form action="{{ route('activity.logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this history entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No activity log found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</section>

@endsection
