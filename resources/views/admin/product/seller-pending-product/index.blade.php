@extends('admin.layouts.master')

@section("content")

<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Admin Dashboard</a></div>
        <div class="breadcrumb-item">Seller Pending Products</div>
      </div>
    </div>
  
    <div class="section-body">
     
  
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Seller Pending Products</h4>
             
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
<script>
$(document).ready(function() {
  $('body').on('change', '.is_approved', function() {
    let value = $(this).val(); // Get the selected value (0 or 1)
    let id = $(this).data('id');

    $.ajax({
      url : "{{route('admin.change-approve-status')}}",
      method: 'PUT',
      data: {
        value: value,
        id: id
      },
      success: function(data){
        toastr.success(data.message)
        window.location.reload();
      },
      error: function(xhn, status, error){
        console.log(error);
      }
    })
    

  });
});

</script>
@endpush