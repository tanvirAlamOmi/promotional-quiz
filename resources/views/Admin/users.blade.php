
@extends('Admin.includes.layout')
@section('pageTitle', 'General settings')
@push('styles')
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0px;
    }
    .page-item.active .page-link {
    color: #000;
    background-color: transparent;
    border: 1px solid #eae0d1;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: transparent;
    border: 1px solid #eae0d1;
    }
</style>
@endpush

@section('content')
    <!-- Container Fluid-->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="userlist" class="p-l-0 p-r-0 table table-bordered">
                        <thead style="background-color:#eae0d1; color:252222a6">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>            
@endsection

@push('scripts')
    <script>
        dataTables();
        var table = $('#userlist').DataTable;
        function dataTables() {
            // list data
                table = $('#userlist').DataTable({

                processing: true,
                serverSide: true,
                draw:true,
                ajax: {
                    url: "{{ url('/users_datatable') }}",
                    type: 'GET',
                },
                "order": [
                [0, 'desc']
                ],
                columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }


                ],
                dom: 'Brlftip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        },
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        },
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        },
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        },
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        },
                        title: 'Orders history',
                        customize: function(win) {
                        // $(win.document.body)
                        // .css( 'font-size', '10pt' )
                        // .prepend(
                        // 	'<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        // 	);

                        $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                        }
                    },

                ]
            });
        }
    </script>
@endpush