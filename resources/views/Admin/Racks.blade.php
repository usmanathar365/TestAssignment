@extends('themelayout.app')
@section('content')
  <!-- sa-app -->
  <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
      @include('themelayout.sidebar')
       <!-- sa-app__content -->
       <div class="sa-app__content">
       @include('themelayout.header')
           <!-- sa-app__body -->
                <div id="top" class="sa-app__body">
                    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                        <div class="container">
                            <div class="py-5">
                                <div class="row g-4 align-items-center">
                                    <div class="col">
                                        <nav class="mb-2" aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-sa-simple">
                                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Racks</li>
                                            </ol>
                                        </nav>
                                        <h1 class="h3 m-0">Racks</h1>
                                    </div>
                                    @if(Auth::user()->role ==1)
                                    <div class="col-auto d-flex"><a href="{{route('add.Rack')}}" class="btn btn-primary">Add Rack</a></div>
                                    @else
                                    @endif
                                </div>
                            </div>
                            <div class="card">
                                @if(Session::has('message'))
                                    <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                    </div>
                                @endif
                                <div class="p-4">
                                    <input type="text" placeholder="Start typing to search for Racks"
                                        class="form-control form-control--search mx-auto" id="table-search"/>
                                </div>
                                <div class="sa-divider"></div>
                                <table class="sa-datatables-init" data-order='[[ 1, "desc" ]]' data-sa-search-input="#table-search">
                                    <thead>
                                        <tr>
                                            <th class="w-min" data-orderable="false">
                                                <input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block" aria-label="..." />
                                            </th>
                                            <th class="min-w-15x">Rack Name</th>
                                            
                                            <th class="w-min" data-orderable="false"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($Racks) && count($Racks) > 0)
                                        @foreach($Racks as $Rack)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block" aria-label="..." /></td>
                                            <td><a href="#" class="text-reset">{{$Rack->name}}</a></td>
                                              
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-sa-muted btn-sm"
                                                        type="button"
                                                        id="Rack-context-menu-0"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        aria-label="More"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13" fill="currentColor">
                                                            <path
                                                                d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="category-context-menu-0">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" onclick="confirmEdit({{$Rack->id}})" >Edit</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;">Duplicate</a></li>  
                                                        <li><hr class="dropdown-divider" /></li>
                                                        <li><a class="dropdown-item text-danger" style="cursor: pointer;" onclick="confirmDelete({{$Rack->id}})" >Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                         @endif
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{route('edit.Rack')}}" method="post" id="editform">
                    @csrf
                    <input type="hidden" class="editid" name="editid" value="">
                </form>
                
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script>

          function confirmEdit($id){
            $('.editid').val($id);
            $('#editform').submit();
            }

            function confirmDelete($id) {
                
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this Rack!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: "DeleteRack/",
                            type: "get",
                            data: {
                                id: $id
                            }, 
                            success: function () { 
                                swal({
                                title: "Done!",
                                type: "success",
                                text: "Rack deleted!",
                                confirmButtonText: "ok",
                                allowOutsideClick: "true"
                            }, function () { location.reload();})
                                 
                                
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal("Error deleting!", "Please try again", "error");
                            }
                        });
                    });
                }
        
                   </script>
                <!-- sa-app__body / end --> 
       
        @include('themelayout.footer')
                </div>
            <!-- sa-app__content / end -->

            <!-- sa-app__toasts -->
            <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
            <!-- sa-app__toasts / end -->

        </div>
        <!-- sa-app / end -->
@endsection