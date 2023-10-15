<!DOCTYPE html>
<html>
<head>
  <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> 
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
</head>
<body>

  <div class="jumbotron text-center">
  <h1>Add new Product</h1>
  <div class="float-right mr-5">
    <a href="" class='btn btn-success'  data-toggle="modal" data-target="#myModal">Add Course</a>
  </div> 
</div>
  
<div class="container-fluid"> 

<div class="row">
  
    <div class="col-10">
    
<table class="table" id='myTable'>
    <thead>
        <tr>
            <td>id</td>
            <td>Name</td>
            <td>Image</td>
            <td>Price</td>
            <td>Status</td> 
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    
<tbody>
        @foreach($products as $c )
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->Name}}</td>
            <td> <img src="{{asset('uploaded_img')}}/{{{$c->img}}}" alt="" height='150' width='150'></td> 

            <td>{{$c->Price}} </td>
            <td>{{$c->Status}} </td> 
            <td><a href="javascript:void(0)" class='btn btn-warning showEditModal'>Edit</a></td>

                        <td>
            
            <form action="product/{{$c->id}}" method='POST'>
            @method('DELETE')
            @csrf
            <input type="submit"  value='Delete' class='btn btn-danger'>
            </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tbody>
        <tr>
           
            
            <form action="" method='POST'>
            <input type="submit"  value='Delete' class='btn btn-danger'>

            </form>
            </td>
        </tr>
    </tbody>

</table>
    </div>
</div>



</div>







<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Add product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action="product" method='POST' id='form' enctype='multipart/form-data'>
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class='form-control' name='Name' id='Name'>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class='form-control' name='img' id='img'>
        </div>
 

        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class='form-control' name='Price' id='Price'>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <input type="text" class='form-control' name='Status' id='Status'>
        </div>
        

        <div class="form-group">
            
            <input type="submit" class='form-control btn btn-success'  id='submit' value='Add Course'>
            
        </div> 
        </form>  
      </div> 
    </div>
  </div>
</div>
<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );


    $('.showEditModal').click(function(e){

        Status = e.target.parentElement.previousElementSibling.innerText
        Price = e.target.parentElement.previousElementSibling.previousElementSibling.innerText
        Name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
        id = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText


$('#Name').val(Name);
$('#Price').val(Price);
$('#Status').val(Status);
$('#submit').val("Edit Product");
$('.modal-title').text('Edit Product')
$('form').attr('action','product/'+id)
$('form').append('<input type="hidden" name="_method" value="PUT">')
        $('#myModal').modal('show');
    })
</script>


</body>
</html>