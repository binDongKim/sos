<?php if ( ! defined( 'ABSPATH' ) ) die();

if( empty( get_league_teams() ) ) {
  foreach ( array( 354, 358, 351, 357 ) as $league_id ) {
    set_teams_by_league_id( $league_id );
  }
}
$leagues = get_league_teams();

if( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
  set_myteams();
  set_fixtures_by_myteams();
}

$my_teams = get_myteams();
?>

<h2>Team Management</h2>
  <form method="POST" action="<?php echo admin_url( 'admin.php?page=teams' ); ?>">
    <div class="team-reg-button-wrapper"><button type="submit" class="button button-primary">저장</button></div>
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
          <?php foreach ( $my_teams[$index] as $my_team ) : ?>
            <article>
              <input type="hidden" name="my-teams[league-id][]" value="<?php echo $index; ?>">
              <input type="text" name="my-teams[name][]" value="<?php echo $my_team['name']; ?>" class="form-control input-team-name" readonly="readonly">
              <input type="hidden" name="my-teams[team-id][]" value="<?php echo $my_team['team-id']; ?>">
              <button type="button" data-action="remove-team" class="remove-team button button-default button-xs pull-right">Del</button>
            </article>
          <?php endforeach; ?>
        </div>

        <select data-name="teams" class="form-control team-selection">
          <?php foreach ( $league as $team ) : ?>
            <option data-team-name="<?php echo $team['name']; ?>" value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="button" data-action="add-team" class="button button-primary button-xs">Add</button>
      </div>
    <?php endforeach; ?>
  </form>
