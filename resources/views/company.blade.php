@extends('applayout')
@section('title')
    Company
@endsection

@section('form')
<a class="btn btn-success" href="javascript:void(0)" id="createNewCompany"> Create New Company</a>
@endsection
@section('table')
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable" id="datatable-crud">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Logo</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="companyForm" name="companyForm" class="form-horizontal"action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   <input type="hidden" name="company_id" id="company_id">
                     <div class="card-body">
                    <div class="form-group">
                    <label for="first_name">Name:</label>
                    <input type="text" id="name" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" id="website" class="form-control" name="website" required>
                    </div>
                    <!-- Other employee details: Company, Email, Phone -->
                    <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                <label for="logo">logo:</label>
                <input type="file" id="logo" class="form-control" name="logo" required>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
 @section('js1')
    <script type="text/javascript">
                $ (function(){

        $('#createNewCompany').click(function () {
        $('#saveBtn').val("create-company");
        $('#company_id').val('');
        $('#companyForm').trigger("reset");
        $('#modelHeading').html("Create New Company");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editProduct', function () {
      var company_id = $(this).data('id');
      $.get("{{ route('companies.index') }}" +'/' + company_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Company");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#company_id').val(data.id);
          $('#name').val(data.name);
          $('#website').val(data.website);
          $('#email').val(data.email);
          $('#logo').val(data.logo);
      })
    });

    $('#saveBtn').click(function (e) {
    e.preventDefault();

    // Check if the required fields are not empty
    if ($('#name').val() === '' || $('#email').val() === '' || $('#website').val() === '' || $('#logo').val() === '') {
        alert('Please fill in all required fields.');  // You can customize this error handling
        return;
    }

    $(this).html('Sending..');

    var formData = new FormData($('#companyForm')[0]);

    $.ajax({
    data: formData,
    url: "{{ route('companies.store') }}",
    type: "POST",
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function (data) {
        alert(data.res);
        $('#companyForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
        // Display the success message
        // Optionally, you can perform additional actions here
    },
    error: function (data) {
        console.log('Error:', data);
        // Handle error if needed
    },
    complete: function () {
        $('#saveBtn').html('Save Changes');
    }
});
});

    $('body').on('click', '.deleteProduct', function () {
        var table;
     var company_id = $(this).data("id");
     confirm("Are You sure want to delete !");

     $.ajax({
         type: "DELETE",
         url: "{{ route('companies.store') }}"+'/'+company_id,
         success: function (data) {
             table.draw();
         },
         error: function (data) {
             console.log('Error:', data);
         }
     });
 });

        });
    </script>
@endsection
@section('js2')
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(function(){
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('companies.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'website', name: 'website'},
                //{data: 'logo', name: 'logo'},
                {
                data: 'logo',
                name: 'logo',
                render: function(data, type, full, meta) {
                    return '<img src="'+data+'" alt="Logo" height="50" width="50">';
                }
            },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
</script>
@endsection

