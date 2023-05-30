<!doctype html>

@include('layouts.partials.navbar')
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .required {
  color: red;
}
    </style>
  </head>
  <body>
    {{-- <h1>Add Role</h1> --}}
    <br>
   <div class="container">
    <div class="card">
        <h5 class="card-header">Edit Product</h5>
        <div class="card-body">
          {{-- <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
        </div>
          <form action="{{route('products.update',$products->id)}}" method="POST">
            
            @csrf
            @method('PUT')
            <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control"  name="name" id="floatingInput" placeholder="Enter product name" value="{{$products->name}}" required>
                <label for="floatingInput">Enter Product Name<span class="required">*</span></label> 
              </div>
            </div>
            <div class="col-md-4">
            <div class="form-floating mb-3">
                <textarea id="myTextarea" rows="4" cols="50" name="detail" placeholder="Enter details" required > {{$products->detail}}</textarea><br>
              {{-- <input type="text" class="form-control"  name="detail" id="floatingInput" placeholder="Enter role"> --}}


            </div>
          </div>
        

            {{-- <div class="col-md-4">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        
          </form>
        </div>

      </div>
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>