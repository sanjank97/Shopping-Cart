<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign-In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" /> 
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
  <style>
      .form-box{
          width:35%;
          margin:0 auto;
          background:#fff;
          margin-top:50px;
          padding:15px;
        border-radius:5px;
        //box-shadow:0px 10px 6px -6px #777;
      }
      .form-group{
          margin-bottom:20px;
      }
     .form-control{
            padding: 21px;
            border-radius: 23px;}
      button[type="submit"]{
            padding:7px 30px;
            width:100%;
            border-radius: 23px;
           background:#117a8b;

      }      
  </style>
</head>
<body style="background:#117a8b;
">
   <div class="container">
       <div class="main">
            <div class="form-box">
                <h3 class="text-center mt-2">Registration!</h3>
                <form class="mb-1 mt-4" action="{{url('register')}}" method="post">
                 @csrf
                   <div class="form-group">
                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{old('name')}}">   
                    </div>
                    @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <div class="form-group">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Username (email)" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <div class="form-group">
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="pwd" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="re-pwd" placeholder="Re-password" name="password_confirmation">
                    </div>
                    @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <div class="form-group">
                        <input type="text" class="form-control  @error('mobileno') is-invalid @enderror" id="mob" placeholder="Mobile no" name="mobileno" value="{{old('mobileno')}}">
                    </div>
                    @error('mobileno')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <button type="submit" class="btn text-white mb-2">Submit</button>
                    <div class="text-center">
                    <a  href="{{url('home')}}">Go shop</a>
                    <span>Already registered ?</span>
                    <a  href="{{'login'}}">Login</a>
                    </div>
                </form>
            </div>
      </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</body>
</html>
