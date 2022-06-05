<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" /> 
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
 
  <style>
       .box{
           box-shadow:0 0 0 1px #ccc;
           border-radius:5px;
           margin-top:20px;
       }
  </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class=box>
                    @if(Session::has('msg'))
                    <div class="alert alert-success">
                       <span>{{session('msg')}}</span>
                    </div>
                     @endif
                    <div class="alert alert-secondary">
                       <span>Add Product</span>
                    </div>
                    <form action="{{url('addProduct')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Product Name :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" name="name" value="{{old('name')}}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description :</label>

                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" id="comment" placeholder="Description" autocomplete="description"  autofocus value="{{old('description')}}"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">Product Image :</label>

                        <div class="col-md-6">
                           <input type=file name="file" class="@error('file') is-invalid @enderror" autocomplete="file" autofocus value="{{old('file')}}">

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Price(/-) :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price($)"  autocomplete="price" autofocus style="width:100px;" value="{{old('price')}}">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>
                     <div class="form-group row mb-0 pb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="padding:5px 20px">
                                    {{ __('Add') }}
                                </button>
                              
                            </div>
                        
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
