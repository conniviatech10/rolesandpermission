<!doctype html>
<html lang="en">
  @include('layouts.partials.navbar')
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <title>Product</title>
  </head>
  <body>
    <br>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Products List
        </div>
        <div class="card-body">
          {{-- <h5 class="card-title">Role List</h5> --}}
          <p class="card-text"> </p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @can('product-create')
            <a href="{{route('products.create')}}" class="btn btn-primary">Add Product</a>
            @endcan
          </div>
          {{-- <a href="{{route('roles.create')}}" class="btn btn-primary">Add Role</a> --}}
        </div>

        <table class="datatables table table-borderless hover-table" id="table">
            <thead>
              <tr>
                <th scope="col">#Sr.No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Detail</th>
                <th scope="col">Created_At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              {{-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr> --}}
             
            </tbody>
          </table>

      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" integrity="sha512-CryKbMe7sjSCDPl18jtJI5DR5jtkUWxPXWaLCst6QjH8wxDexfRJic2WRmRXmstr2Y8SxDDWuBO6CQC6IE4KTA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
     $(document).ready(function() {
            $('#table').DataTable({
                "language": {
                    search: ' ',
                    searchPlaceholder: "Search...",
                    paginate: {
                        next: 'Next <i class="fas fa-chevron-right ms-2"></i>',
                        previous: '<i class="fas fa-chevron-left me-2"></i> Previous'
                    }
                },
                "bFilter": true,
                "bInfo": false,
                "bLengthChange": false,
                "bAutoWidth": false,
                "ajax": {
                    "url": "{{ url()->current() }}",
                    "type": "GET",
                    "data": function(data) {
                        data._token = "{!! csrf_token() !!}";
                    },
                },
                "columns": [
                    {"data": 'id',"name": 'id','orderable': false,'searchable': false,'width':'5%' },
                  
                    {"data": "name","name": "name" },
                    {"data": "detail","name": "detail" },
                    {"data": "created_at","name": "created_at" },
                    {"data": "action",orderable: false, searchable: false,visible: true},
                ],
                "columnDefs": [{
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                        "targets": 0,
                    },
                     

                    {
                        render: function(data, type, row, meta) {
                            return moment(data).format('L'); 
                        },
                        "targets": 3,
                    },

                    // {
                    //     render: function(data, type, row, meta) {
                    //         return (data == 1) ? '<span class="badge badge-success">Enable</span>' :
                    //             '<span class="badge badge-danger">Disable</span>';
                    //     },
                    //     "targets": 3,
                    // }
                    // {render: function (data, type, row, meta) {
                    //         return meta.row+1;
                    //     },
                    //     "targets":,
                    // },
                    // {render: function (data, type, row, meta) {
                    //         return (data==1)?'<span class="badge badge-success">Enable</span>':'<span class="badge badge-danger">Disable</span>';
                    //     },
                    //     "targets":4,
                    // },
                ],
                "aaSorting": [],
                // "order": [
                //     [0, 'desc']
                // ],
                initComplete: (settings, json) => {
                    $('.dataTables_paginate').appendTo('#tablepagination');
                    $('.dataTables_filter').appendTo('#tableSearch');
                },
            });
        });
</script>
  </body>
</html>