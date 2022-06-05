<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign-In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
  <style>
      .form-box{
          width:30%;
          margin:0 auto;
          background:#fff;
          margin-top:50px;
          padding:15px;
        border-radius:8px;
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
            @if(Session::has('msg'))
                   <div class="alert alert-danger mt-2">
                      {{session('msg')}}
                   </div>
                 @endif  
                <h3 class="text-center mt-2">Login</h3>
                <form class=" mt-4" action="{{url('login')}}" method="post">
                  @csrf 
                  <div class="form-group">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Username (email)" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <div class="form-group">
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="pwd" placeholder="Password" name="password">
                    </div>
                    @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    <button type="submit" class="btn text-white">Submit</button>
                    <div class="mt-2" style="display:flex;">
                      <div style="width:50%;">
                          <a  href="{{url('home')}}">Go shop</a>
                      </div>
                      <div class="text-right" style="width:50%;">
                          <a  href="{{'register'}}">Register</a>
                      </div>
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


      