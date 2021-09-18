<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('img\main-logo.webp')}}" rel="icon">
    <title>Dashboard</title>
    <link href="{{asset('Admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Admin/css/ruang-admin.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('Admin/css/datatables.min.css')}}" rel="stylesheet"> --}}
    
    @stack('styles')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('Admin.includes.sidebar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include('Admin.includes.navbar')

                <!-- Topbar -->

                <!-- Container Fluid-->
                
                <div class="container-fluid" id="container-wrapper">
                    @yield('content')
                    
                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    {{-- <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a> --}}
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout</a>
                                        <form id='logout-form' action="{{url('/logout')}}" method="POST" style="display: none;">{{csrf_field()}}</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Logout -->
                </div>

                <!---Container Fluid-->
            </div>
            <!-- Footer -->
                @include('Admin.includes.footer')
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('Admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admin/js/ruang-admin.min.js')}}"></script>

	<script src="{{asset('Admin/vendor/table-button/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/buttons.flash.min.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/jszip.min.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/pdfmake.min.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/vfs_fonts.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/buttons.html5.min.js')}}"></script>
	<script src="{{asset('Admin/vendor/table-button/buttons.print.min.js')}}"></script>

    @stack('scripts')

</body>

</html>