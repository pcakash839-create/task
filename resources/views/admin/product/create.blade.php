<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Form for Add Product Data</h1> 
</div>

<div class="container">
  <div class="col-md-6 col-md-offset-3">
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="name">Enter Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="price">Enter Price</label>
    <input type="text" name="price" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="image">Upload Image</label>
    <input type="file" name="image" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-success">Submit</button>
</form>
  </div>
</div>

</body>
</html>
