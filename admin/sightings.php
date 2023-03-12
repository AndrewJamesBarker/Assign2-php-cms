<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM ufo_sightings
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Sighting has been deleted' );
  
  header( 'Location: sightings.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM ufo_sightings
  ORDER BY date DESC';
$result = mysqli_query( $connect, $query );

// $query = 'SELECT title, location, details, date, photo, photo_credit, encounter_description 
//     FROM ufo_sightings 
//     JOIN encounter_type ON ufo_sightings.encounter_id = encounter_type.id 
//     ORDER BY date DESC';
// $result = mysqli_query( $connect, $query );

?>
<h2>Manage UFO Sightings</h2>

<table>
  <tr>
    <th></th>

    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="center">Content</th>
    <th align="center">Date</th>
    <th align="left">Location</th>
   
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=project&id=<?php echo $record['photo']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
        <small><?php echo $record['location']; ?></small>
      </td>
      <td align="center"><?php echo $record['content']; ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['date'] ); ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['location'] ); ?></td>
      <td align="center"><a href="sightings_photo.php?id=<?php echo $record['photo']; ?>"><i class="fa-solid fa-image"></i></a><br><br><a href="sightings_edit.php?id=<?php echo $record['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a><br><br>
        <a href="sightings.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');"><i class="fa-solid fa-trash"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="sightings_add.php"><i class="fas fa-plus-square"></i>Add Sighting</a></p>

<script src="https://kit.fontawesome.com/c54b7d85ab.js" crossorigin="anonymous"></script>
<?php

include( 'includes/footer.php' );

?>