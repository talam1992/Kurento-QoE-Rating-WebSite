<!DOCTYPE html>
<html>
 <head>
  <title>Kurento Group Call Rating System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container" style="width:800px;">
   <h2 align="center">Kurento Group Call Rating</h2>
   <br />
   <span id="groupcall_list"></span>
   <br />
   <br />
  </div>
  <div class="container" style="width:800px;" align="center">
  <table>
  <form id="form" action="insert_rating.php" method="post">
    <label>Username:</label> <input type:"text" name="username" />
    <br />
    <br />
    <label>Room:</label> <input type:"text" name="room" />
    <br />
    <br />
    <button id="submit">Submit</button>
    </form>
    <span id="results"></span>
    </div>
 </body>
</html>

<script>

$(document).ready(function(){
 
 load_groupcall_data();
 
 function load_groupcall_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#groupcall_list').html(data);
   }
  });
 }
 
 $(document).on('mouseenter', '.rating', function(){
  var index = $(this).data("index");
  var kurento_id = $(this).data('kurento_id');
  remove_background(kurento_id);
  for(var count = 1; count<=index; count++)
  {
   $('#'+kurento_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 function remove_background(kurento_id)
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+ kurento_id+'-'+count).css('color', '#ccc');
  }
 }
 
 $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data("index");
  var kurento_id = $(this).data('kurento_id');
  var rating = $(this).data("rating");
  remove_background(kurento_id);
  //alert(rating);
  for(var count = 1; count<=rating; count++)
  {
   $('#' + kurento_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 $(document).on('click', '.rating', function(){
  var index = $(this).data("index");
  var kurento_id = $(this).data('kurento_id');
  $.ajax({
   url:"insert_rating.php",
   method:"POST",
   data:{index:index, kurento_id:kurento_id},
   success:function(data)
   {
    if(data == 'done')
    {
     load_groupcall_data();
     alert("You have rate "+ index + " out of 5");
    }
    else
    {
     alert("There is some problem in System");
    }
   }
  });
  
 });

});
</script>