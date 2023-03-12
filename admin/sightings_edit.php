<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['sighting_id'] ) )
{
  
  header( 'Location: sightings.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['location'] )
  {
    
    $query = 'UPDATE ufo_sightings SET
    
       title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
       photo_credit = "'.mysqli_real_escape_string( $connect, $_POST['photo_credit'] ).'",
       content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
       location = "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
       date = "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'",
       encounter_description = "'.mysqli_real_escape_string( $connect, $_POST['encounter_description'] ).'",
       more_info = "'.mysqli_real_escape_string( $connect, $_POST['more_info'] ).'"
       WHERE sighting_id = '.$_GET['sighting_id'].'
       LIMIT 1';

    mysqli_query( $connect, $query );
    
    set_message( 'Sighting has been updated' );
    
  }

  header( 'Location: sightings.php' );
  die();
  
}


if( isset( $_GET['sighting_id'] ) )
{
  
 
$query = 'SELECT title, location, details, date, photo, photo_credit, encounter_description 
    FROM ufo_sightings 
    JOIN encounter_type ON ufo_sightings.encounter_id = encounter_type.encounter_id 
    WHERE id = '.$_GET['id'].'
    LIMIT 1';

  $result = mysqli_query( $connect, $query );

  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: sightings.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Sighting</h2>

<form method="post">
  
  <label for="photo_credit">Photo Credit:</label>
  <input type="text" name="photo_credit" id="photo_credit" value="<?php echo htmlentities( $record['photo_credit'] ); ?>">
    
  <br>

  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>

  <label for="photo_credit">Photo Credit:</label>
  <input type="text" name="photo_credit" id="photo_credit" value="<?php echo htmlentities( $record['photo_credit'] ); ?>">

  <br>

  <label for="title">Content:</label>
  <input type="text" name="content" id="content" value="<?php echo htmlentities( $record['content'] ); ?>">
    
  <br>
  
  <label for="location">Location:</label>
  <textarea type="text" name="location" id="location" rows="1"><?php echo htmlentities( $record['location'] ); ?></textarea>
  
  <script>

  ClassicEditor
    .create( document.querySelector( '#location' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="more_info">More Info URL:</label>
  <input type="text" name="more_info" id="more_info">
    
  <br>
  
  <label for="date">Date:</label>
  <input type="date" name="date" id="date" value="<?php echo htmlentities( $record['date'] ); ?>">

  <br>
      
  <label for="type">Encounter Description:</label>
  <?php
  
  $values = array( 'UFO Sighting', 'UFO Abduction', 'Close Encounter' );
  
  echo '<select name="encounter_description" id="encounter_description">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['type'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Edit Sighting">
  
</form>

<p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Sighting List</a></p>


<?php

include( 'includes/footer.php' );

?>