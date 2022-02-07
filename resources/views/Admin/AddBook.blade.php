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
                                                <li class="breadcrumb-item"><a href="{{route('Book')}}">Books</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">@if(isset($Book)) Edit @else Add @endif Book</li>
                                            </ol>
                                        </nav>
                                        <h1 class="h3 m-0">@if(isset($Book)) Edit @else Add @endif Book</h1>
                                    </div>
                                    
                                    <div class="col-auto d-flex">
                                       
                                        <a class="btn btn-primary" onclick="changeHtmlContent();">
                                         @if(isset($Book)) {{_('Update')}} @else {{_('Save')}} @endif</a>
                                    </div>
                                </div>
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
                            <form action="@if(isset($Book)) {{route('update.Book')}} @else {{route('save.Book')}} @endif" method="post" id="Book-form" enctype="multipart/form-data"> 
                                @csrf
                            <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--Book--md","1100":"sa-entity-layout--Book--lg"}'>
                                <div class="sa-entity-layout__body">
                                    <div class="sa-entity-layout__main">
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Basic information</h2></div>
                                                @if(isset($Book)) <input type="hidden" value="{{$Book->id}}" name="Book_id"> @else  @endif
                                                <div class="mb-4">
                                                <label for="form-Book/brand" class="form-label">Rack</label> 
                                               
                                                    <select class="sa-select2 form-select" id="form-Book/brand" name="rack"> 
                                                        <option selected disabled >Select Rack </option>
                                                        @foreach($Racks as $rack)
                                                            <option value="{{$rack->id}}" @if(isset($Book) && $rack->id == $Book->rack_id))) selected @else @endif>{{$rack->name}}</option>
                                                        @endforeach    
                                                            
                                                    </select>
                                                 </div>
                                                <div class="mb-4">
                                                    <label for="form-Book/Booktype" class="form-label">Book Title</label>
                                                    <input type="text" class="form-control Book_type" id="form-Book/Booktype" name="title" value="@if(isset($Book)){{$Book->title}}@else{{ old('title') }}@endif">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="form-Book/value" class="form-label">Author</label>
                                                    <input type="text" class="form-control Book_value" id="form-Book/value" name="author" value="@if(isset($Book)){{$Book->author}}@else{{old('author')}}@endif">
                                                </div>
                                                 
                                                <div class="mb-4">
                                                    <label for="form-Book/publish" class="form-label">Publish Year</label>
                                                    <input type="text"  class="form-control publush_date datepicker-here" id="form-Book/publish" data-min-view="years" data-view="years" data-date-format="yyyy" data-auto-close="true" data-language="en"  aria-label="Datepicker"
                                                       name="publish_year" value="@if(isset($Book)){{$Book->published_year}}@else{{old('published_year')}}@endif">
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
  
                    document.getElementById('Book-form').submit();
                    
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