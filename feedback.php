<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="xsssite.html">ACompany</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="xsssite.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="feedback.php">Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
    
  </div>
</nav>
<div style="margin-top: 50px; margin-left: 250px;margin-right: 100px;">
<?php
          if(!isset($_SESSION["login_user"]))
          {
            echo '<h1>Invalid credentials</h1>';
          }
          else
          {
            echo '<h1>Hello ' .$_SESSION["login_user"] . '</h1><br><h2> Give your feedback!</h2>';
          }
          
?>
       
</div>
<form style="padding: 50px;margin-left: 200px;margin-right: 200px;" method="POST">
    
    <div class="form-group">
      <label >Name</label>
      <input name="uname" type="text" class="form-control" id="inputEmail4">
    </div>
    
 
  <div class="form-group">
    <label >Comments</label>
    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

  </div>
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>

<?php   

function noHTML($input, $encoding = 'UTF-8')
{
    return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
     //Prevents XSS
     //$uname = noHTML($_POST['uname']);
     //$comment = noHTML($_POST['comment']);
 
     //Vulnerable to XSS
     $uname = $_POST['uname'];
     $comment = $_POST['comment'];
     
     
    // sql connectivity

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "ics_xss";
    
    $conn = new mysqli($servername, $username, $password, $db);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

      $sql = "INSERT INTO feedback (username,comment) VALUES ('$uname', '$comment')";
      $result = mysqli_query($conn,$sql);
      
  $conn->close();
}
?>
