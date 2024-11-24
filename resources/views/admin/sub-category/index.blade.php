@extends('admin.layouts.master')

@section("content")

<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Admin Dashboard</a></div>
        <div class="breadcrumb-item">Sub-Category</div>
      </div>
    </div>
  
    <div class="section-body">
     
  
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Sub Categories</h4>
              <div class="card-header-action">
                <a href="{{route('admin.sub-category.create')}}" class="btn btn-primary"> + Add New Sub-Category </a>
              </div>
            </div>
            <div class="card-body">
              {{ $dataTable->table()}}
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </section>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush