<?php if ( ! defined( 'ABSPATH' ) ) die();

if( empty( get_option( 'league_teams', array() ) ) ) {
  foreach ( array( 354, 358, 351, 357 ) as $league_id ) {
    setTeams( $league_id );
  }
}
$leagues = get_option( 'league_teams', array() );

if( 'POST' === $_SERVER['REQEUST_METHOD'] ) {
  $my_teams = array();
  update_option( 'my_teams', $my_teams );
}
$my_teams = get_option( 'my_teams', array() );
;?>


<h1>Team Management</h1>
<form method="POST" action="<?php admin_url( 'admin.php?page=teams' ); ?>">
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

      <div class="team-group" data-target="<?php echo $index; ?>-team-list">
      </div>

      <select data-name="teams" class="form-control team-selection">
        <?php foreach ( $league as $team ) : ?>
          <option data-team-name="<?php echo $team['name']; ?>" value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <button type="button" data-action="add-team" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
    </div>
<?php endforeach; ?>
</form>
