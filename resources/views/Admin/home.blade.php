
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
          
    <div class="col-12 pb-4 pr-0 mr-0">
        <div class="row container pr-0" style="justify-content: right;">	
            <div class="col-6 pr-0">
                <div class="row">	
                    <div class="d-flex no-block pr-5 col-6">
                        <label class="pt-2 pr-2 font-weight-bold">From:</label>
                        <input type="date" class="form-control" name="from_date" id="from_date">
                    </div>
                    <div class="d-flex no-block col-6">
                        <label class="pt-2 pr-2 font-weight-bold">To:</label>
                        <input type="date" class="form-control" name="to_date" id="to_date">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="orderlist" class="p-l-0 p-r-0 table table-bordered">
                    <thead style="background-color:#eae0d1; color:252222a6">
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Reward</th>
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
        let currentDate = new Date();
		let dd = String(currentDate.getDate()).padStart(2, '0');
		let mm = String(currentDate.getMonth() + 1).padStart(2, '0'); //January is 0!
		let yyyy = currentDate.getFullYear();

		currentDate = yyyy + '-' + mm + '-' + dd;
        
		let fromDate = `${currentDate} 00:00:00`;
		let toDate = `${currentDate} 23:59:59`;
        $('#from_date').change(function() {
            $('#orderlist').DataTable().destroy();
            fromDate = `${$('#from_date').val()} 00:00:00`;
            
            if($('#to_date').val()){
                toDate = `${$('#to_date').val()} 23:59:59`;
            }else{
                toDate = '3021-03-14 23:59:59';
            }	
            dataTables(fromDate , toDate );
        });
        
        $('#to_date').change(function() {
            $('#orderlist').DataTable().destroy();
            toDate = `${$('#to_date').val()} 23:59:59`;

            if($('#from_date').val()){
                fromDate = `${$('#from_date').val()} 00:00:00`;
            }else{
                fromDate = '1921-03-14 00:00:00';
            }	
            
            dataTables(fromDate , toDate );
        });

        dataTables(fromDate, toDate);
        var table = $('#orderlist').DataTable;
        function dataTables(fromDate, toDate) {
            // list data
                table = $('#orderlist').DataTable({

                processing: true,
                serverSide: true,
                draw:true,
                ajax: {
                    url: "{{ url('/orders_datatable') }}/" + fromDate +'/'+toDate,
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
                    data: 'reward',
                    name: 'reward'
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