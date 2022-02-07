@extends('themelayout.app')
@section('content')
  <!-- sa-app -->
  <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
      @include('themelayout.sidebar')
       <!-- sa-app__content -->
       <div class="sa-app__content">
       @include('themelayout.header')
        <style>
            .filehover:hover{
                text-decoration: underline;
            }
            </style>
            <!-- sa-app__body -->
            <div id="top" class="sa-app__body">
                    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                        <div class="container container--max--xl">
                            <div class="py-5">
                                <div class="row g-4 align-items-center">
                                    <div class="col">
                                        <nav class="mb-2" aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-sa-simple">
                                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="{{route('Rack')}}">Racks</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">@if(isset($Rack)) Edit @else Add @endif Rack</li>
                                            </ol>
                                        </nav>
                                        <h1 class="h3 m-0">@if(isset($Rack)) Edit @else Add @endif Rack</h1>
                                    </div>
                                    
                                    <div class="col-auto d-flex">
                                      
                                        <a class="btn btn-primary" onclick="changeHtmlContent();">
                                         @if(isset($Rack)) {{_('Update')}} @else {{_('Save')}} @endif</a>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger errors d-none">
                                <p class="errorRacktype d-none">Rack Name required.</p>         
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                                @endif
                                @if(Session::has('message'))
                                <div class="alert alert-success">
                                {{ Session::get('message') }}
                                </div>
                                @endif
                            <form action="@if(isset($Rack)) {{route('update.Rack')}} @else {{route('save.Rack')}} @endif" method="post" id="Rack-form" enctype="multipart/form-data"> 
                                @csrf
                            <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--Rack--md","1100":"sa-entity-layout--Rack--lg"}'>
                                <div class="sa-entity-layout__body">
                                    <div class="sa-entity-layout__main">
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Basic information</h2></div>
                                                @if(isset($Rack)) <input type="hidden" value="{{$Rack->id}}" name="Rack_id"> @else  @endif
                                                 
                                                <div class="mb-4">
                                                    <label for="form-Rack/Racktype" class="form-label">Rack Name</label>
                                                    <input type="text" class="form-control Rack_type" id="form-Rack/Racktype" name="name" value="@if(isset($Rack)){{$Rack->name}}@else{{ old('name') }}@endif">
                                                </div>
                                                 
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- sa-app__body / end -->
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                 
                <script>
               
                function changeHtmlContent(ctrl) {

                  var Racktype = $(".Rack_type").val();
                    if(Racktype == ''){
                        $(".errors").removeClass("d-none"); 
                        $(".errorRacktype").removeClass("d-none");                     
                    }
                    else{
                        $(".errorRacktype").addClass("d-none"); 
                    } 
                  
                 if(Racktype != ''){
                        $(".errors").addClass("d-none"); 
                     
                    document.getElementById('Rack-form').submit();
                     }
                }
                </script>

        @include('themelayout.footer')
                </div>
            <!-- sa-app__content / end -->

            <!-- sa-app__toasts -->
            <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
            <!-- sa-app__toasts / end -->

        </div>
        <!-- sa-app / end -->
@endsection