<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );


?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>UFO Encounters</title>
  
  <link href="admin/frontend.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>

  <h1>UFO Encounters</h1>
  <p>All Things UFO</p>

  <?php

  $query = 'SELECT *
    FROM ufo_sightings
    ORDER BY date DESC';
  $result = mysqli_query( $connect, $query );

  ?>

  <hr>

  <?php while($record = mysqli_fetch_assoc($result)): ?>

    <div>

      <h2><?php echo $record['title']; ?></h2>
      <span><p>Location: </p><?php echo $record['location']; ?></span>

      <?php if($record['photo']): ?>

      <?php  echo '<div><img class="mainImg" alt="images depicting UFO events" src=admin/images/'. $record['photo'].'></div>'; ?>
      <?php echo $record['photo_credit']; ?>
      <?php else: ?>

        <p>This record does not have an image!</p>

      <?php endif; ?>

    </div>


  <?php endwhile; ?>

  <?php

  $queryRelatedArticles = 'SELECT *
    FROM ufo_related_articles
    ORDER BY title DESC';
  $resultArticles = mysqli_query( $connect, $queryRelatedArticles );

  ?>

  <?php while($recordArticles = mysqli_fetch_assoc($resultArticles)): ?>

<div>

  <h2><?php echo $recordArticles['title']; ?></h2>
  <a href="<?php echo $recordArticles['link']; ?>">here</a>


</div>


<?php endwhile; ?>

    <hr>

</body>
</html>
