@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Delete Customer List</h1>  
</div>
<section class="section customer">
    <table class="table datatable">
        <thead>
            <tr>
                <th>SL.</th>
                <th><b>Name</b></th> 
                <th>Address & Phone</th>
                <th>Adnace Amount</th>
                <th>Due Amount</th>
                <th>Deleted At</th>
                <th>Deleted By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($customers as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->phone }}<br>{{ $data->address }}</td>
                <td>{{ $data->advance_balance }}</td>
                <td>{{ $data->due_balance }}</td>
                <td>{{ $data->deleted_at->format('d M Y h:i A') }}</td>
                <td>{{ $data->creator?->name }}</td>
                <td class="table_data_style_right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                            id="dropdownMenuButton-{{ $data->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $data->id }}">
                            <li>
                                <a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#restoreModal-{{ $data->id }}" href="#">
                                    <i class="bi bi-arrow-clockwise"></i> <small>Restore</small>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $data->id }}" href="#">
                                    <i class="bi bi-trash"></i> <small>Delete Permanently</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>

            {{-- Restore Modal --}}
            <div class="modal fade" id="restoreModal-{{ $data->id }}" tabindex="-1" aria-labelledby="restoreModalLabel-{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Restore</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to restore <strong>{{ $data->name }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('recycle.restore', ['type' => 'customer', 'id' => $data->id]) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="deleteModal-{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Permanent Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanently delete <strong>{{ $data->name }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('recycle.delete', ['type' => 'customer', 'id' => $data->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <tr>
                <td colspan="8">No deleted customers found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</section>

@endsection
