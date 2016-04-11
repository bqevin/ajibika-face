 <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tweets";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
  } 
  if (!empty($_REQUEST['term'])) {
    @$term = mysqli_escape_string($_REQUEST['term'].strtolower());
    $sql = "SELECT * FROM uri WHERE tweet LIKE '%".$term."%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      //echo $_REQUEST['term'];
      while($row = $result->fetch_assoc()) {
        echo $row['name'].'<strong>@'.$row['screen_name'].'</strong>:  ' .$row['tweet']."<br>";
      }
    } else {
      echo "No result found";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
<form action="" method="post">  
Search: <input type="text" name="term" /><br />  
<input type="submit" value="Submit" />  
</form>  
    </body>
</html>