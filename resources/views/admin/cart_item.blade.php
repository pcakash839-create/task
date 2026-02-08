<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Welcome to Product Dashboard</h1> 
</div>
  
<div class="container">

  @if(!empty($data) && count($data) > 0)
    <h2 class="mt-4">Product Table</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $index => $item)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['price'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>No product data available.</p>
  @endif
</div>

</body>
</html>
