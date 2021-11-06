<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

    <title>Login</title>
</head>
<body dir="rtl">
   <div class="container">
       <div class="row">
           <div class="col-md-4"></div>
           <div class="col-md-4">
               <h1 style="text-align: center">Login</h1>
               <form action="{{ route('login.post') }}" method="POST">
                   <div class="form-group mt-5">
                       <input type="text" class="form-control" placeholder="Username" required name="username">
                   </div>

                   @csrf

                   <div class="form-group mt-2">
                       <input type="password" class="form-control" placeholder="Password" required min="8" name="password">
                   </div>

                   <button type="submit" class="btn btn-success form-control mt-2">Login</button>
               </form>
           </div>
           <div class="col-md-4"></div>
       </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
