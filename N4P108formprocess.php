<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
die ('Unable to connect. Check your connection parameters.'); 
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));


if ($_POST['submit'] == 'Add') {
    if ($_POST['type'] == 'movie' && $_POST['movie_type'] == '') {
        header('Location: N4P107form.html');
    }        
}
?>
<html>
 <head>
  <title>Multipurpose Form</title>
  <style type="text/css">
  <!--
td {vertical-align: top;}
  -->
  </style>
 </head>
 <body>
<?php
// Show a form to collect more information if the user is adding something
if ($_POST['submit'] == 'Add') {
    echo '<h1>Add ' . ucfirst($_POST['type']) . '</h1>';
?>
  <form action="N4P109formprocess.php" method="post">
   <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>"/>
   <table>
    <tr>
     <td>Name</td>
     <td>
      <?php echo $_POST['name']; ?>
      <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>"/>
     </td>
    </tr>
<?php
    if ($_POST['type'] == 'movie') {
?>
    <tr>
     <td>Movie Type</td>
     <td>
      <?php echo $_POST['movie_type']; ?>
      <input type="hidden" name="movie_type"
       value="<?php echo $_POST['movie_type']; ?>"/>
     </td>
    </tr><tr>
     <td>Year</td>
     <td><input type="text" name="year" /></td>
    </tr><tr>
     <td>Movie Description</td>
<?php
    } else {
        echo '<tr><td>Biography</td>';
    }
?>
     <td><textarea name="extra" rows="5" cols="60"></textarea></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if (isset($_POST['debug'])) {
    echo '<input type="hidden" name="debug" value="on" />';
}
?>
      <input type="submit" name="submit" value="Add" />
     </td>
    </tr>
   </table>
  </form>
<?php
// The user is just searching for something
} else if ($_POST['submit'] == 'Search') {
    echo '<h1>Search for ' . ucfirst($_POST['type']) . '</h1>';
    echo '<p>Searching for ' . $_POST['name'] . '...</p>';
}

if (isset($_POST['debug'])) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    
}
    $namefilm= $_POST['name'];
    $query = 'SELECT movie_id FROM movie WHERE movie_name="'.$namefilm.'"';
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
        $idfinal=$value;
    }
    echo '</tr>' . $idfinal ;
}
    
    echo '<a href="N4P110form.php?send='.$idfinal.'">Add comment...</a>'
?>
 </body>
</html>
