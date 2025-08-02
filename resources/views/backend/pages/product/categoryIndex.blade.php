@extends('backend.layouts.master')
@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-md-8">
            <h1>Category List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Category</li>
                    <div>
                </ol>
            </nav>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <div class="">
                <a class="" href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <i class="ri-add-circle-line"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>
    </div>   
</div>
<!-- End Page Title -->

<section class="section category">
    <table class="table datatable">
        <thead>
            <tr>
              <th>SL.</th>
            <th>
              <b>N</b>ame
            </th>
            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> 
            <th>Created By</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $data)
              <tr>
                <td> {{ $loop->index + 1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->date}}</td> 
                <td>{{$data->creator ?->name}}</td>
                <td class="table_data_style_right">
                  <div class="dropdown">
                       <button class="btn btn-sm btn-light dropdown-toggle {{ $data->id == 1 ? 'disabled' : '' }}" type="button"
                          id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li>
                              <a class="dropdown-item d-flex align-items-center" 
                                data-bs-toggle="modal" data-bs-target="#editModal-{{$data->id}}" href="#">
                                  <i class="bi bi-pencil me-2" style="font-size: 14px;"></i> <small>Edit</small>
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item d-flex align-items-center text-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $data->id }}" href="#">
                                  <i class="bi bi-trash me-2" style="font-size: 14px;"></i> 
                                  <small>Delete</small>
                              </a>
                          </li>
                      </ul>
                  </div>
              </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal fade" id="editModal-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('category.update', $data->id) }}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="modal-header">
                        <h1 class="modal-title fs-5"  id="{{ $data->id }}" >category Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}" id="inputNanme4">
                          </div> 
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

             <div class="modal fade" id="deleteModal-{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $data->id }}" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel-{{ $data->id }}">Confirm Delete</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          Are you sure you want to delete this item?
                      </div>
                      <div class="modal-footer">
                          <form action="{{ route('brand.destroy', $data->id) }}" method="POST">
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
                <td colspan="7">No data found</td>
              </tr>
          @endforelse
          
        </tbody>
    </table>
</section>

{{-----category add-----}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Name *</label>
              <input type="text" class="form-control" name="name" id="inputNanme4">
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection