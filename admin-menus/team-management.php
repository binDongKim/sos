<?php if ( ! defined( 'ABSPATH' ) ) die();
$leagues = array();
foreach ( array( 354, 358, 351, 357 ) as $league_id ) {
  $leagues[$league_id] = getTeamsbyId( $league_id );
} ;?>

<h1>Team Management</h1>
<form method="POST">
  <div class="team-reg-button-wrapper"><button type="submit" class="btn btn-primary">저장</button></div>
  <hr>
  <?php
  foreach ( $leagues as $index => $league ) : ?>
    <div class="league-classification-wrapper" data-league-id="<?php echo $index; ?>">
      <h2 class="league-name">
      <?php
        switch ( $index ) {
          case 354:
            echo 'EPL';
            break;
          case 358:
            echo 'Liga';
            break;
          case 351:
            echo 'Bundes';
            break;
          case 357:
            echo 'Seria A';
            break;
        }
      ?>
      </h2>

      <ul class="team-group" data-target="<?php echo $index; ?>-team-list">
      </ul>

      <select data-name="teams" class="form-control team-selection">
        <?php foreach ( $league as $team ) : ?>
          <option data-team-name="<?php echo $team['name']; ?>" value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <button type="button" data-action="add-team" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
    </div>
<?php endforeach; ?>
</form>
