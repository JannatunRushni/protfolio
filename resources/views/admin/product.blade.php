<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style type="text/css">

    .title
    {
        color: white;
        padding-top:25px;
        font-size:25px;
    }

    label
    {
        display: inline-block;
        width: 200px;
    }

    </style>

  </head>
  <body>

      <!-- partial -->
      @include('admin.sidebar')

      @include('admin.navbar')

        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

        <div class="container" align="center">

        <h1 class="title">Add Product</h1>

        <form action="">

        <div style="padding: 15px;">
            <label>Product title</label>

            <input type="text" name="title" placeholder="Give a product title" required="">
        </div>

        <div style="padding: 15px;">
            <label>Price</label>

            <input type="number" name="price" placeholder="Give a price" required="">
        </div>

        <div style="padding: 15px;">
            <label>Description</label>

            <input type="text" name="description" placeholder="Give a description" required="">
        </div>

        <div style="padding: 15px;">
            <label>Quantity</label>

            <input type="text" name="quantity" placeholder="product quantity" required="">
        </div>

        <div style="padding: 15px;">

            <input type="file" name="file">
        </div>

        <div style="padding: 15px;">

            <input class="btn btn-success" type="submit">
        </div>

        </form>

        </div>

        </div>

          <!-- partial -->

        @include('admin.script')

  </body>
</html>
