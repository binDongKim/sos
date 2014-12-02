<?php if ( ! defined( 'ABSPATH' ) ) die();

if( empty( get_option( 'league_teams', array() ) ) ) {
  foreach ( array( 354, 358, 351, 357 ) as $league_id ) {
    setTeams( $league_id );
  }
}
$leagues = get_option( 'league_teams', array() );

if( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
  $my_teams = array();
  if ( ! empty( $_POST['my-teams'] ) )
    foreach ( $_POST['my-teams']['league-id'] as $index => $league_id )
      $my_teams[$league_id][] = array(
        'name'      => $_POST['my-teams']['name'][$index],
        'team-id'   => $_POST['my-teams']['team-id'][$index]
      );
  update_option( 'my_teams', $my_teams );

  $my_teams_fixtures = array();
  foreach ( $my_teams as $league_id ) {
    foreach ( $league_id as $team ) {
      $my_teams_fixtures = array_values( array_unique( array_merge( $my_teams_fixtures, getFixturesbyTeamId( $team['team-id'] ) ), SORT_REGULAR ) );
    }
  }
  update_option( 'my_teams_fixtures', $my_teams_fixtures );
}
$my_teams = get_option( 'my_teams', array() );
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
              <button type="button" data-action="remove-team" class="remove-team button button-default button-xs pull-right"><i class="fa fa-minus"></i></button>
            </article>
          <?php endforeach; ?>
        </div>

        <select data-name="teams" class="form-control team-selection">
          <?php foreach ( $league as $team ) : ?>
            <option data-team-name="<?php echo $team['name']; ?>" value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="button" data-action="add-team" class="button button-primary button-xs"><i class="fa fa-plus"></i></button>
      </div>
    <?php endforeach; ?>
  </form>
