<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'INSERT INTO ufo_sightings (
        title,
        photo_credit,
        content,
        location,
        date,
        encounter_id,
        more_info
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['photo_credit'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['encounter_description'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['more_info'] ).'"
      )';

    mysqli_query( $connect, $query );
    
    set_message( 'Sighting has been added' );
    
  }
  
  header( 'Location: sightings.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Sighting</h2>

<form method="post">
  


  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>

  <label for="photo_credit">Photo Credit:</label>
  <input type="text" name="photo_credit" id="photo_credit" value="<?php echo htmlentities( $record['photo_credit'] ); ?>">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>
      
  <script>

  // ClassicEditor
  //   .create( document.querySelector( '#content' ) )
  //   .then( editor => {
  //       console.log( editor );
  //   } )
  //   .catch( error => {
  //       console.error( error );
  //   } );
    
  </script>
  
  <br>
  
  <label for="location">Location:</label>
  <input type="text" name="location" id="location">

  <br>
  
  <label for="more_info">More Info URL:</label>
  <input type="text" name="more_info" id="more_info">
  
  <br>
  
  <label for="date">Date:</label>
  <input type="date" name="date" id="date">
  
  <br>
    
  <label for="type">Encounter Description:</label>
  <?php
  
  $values = array( 'UFO Sighting', 'UFO Abduction', 'Close Encounter' );
  
  echo '<select name="encounter_description" id="encounter_description">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['encounter_description'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';

  ?>
  
  <br>
  
  <input type="submit" value="Add Sighting">
  
</form>

<p><a href="sightings.php"><i class="fas fa-arrow-circle-left"></i>Return to UFO Sighting List</a></p>


<?php

include( 'includes/footer.php' );

?>