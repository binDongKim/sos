<?php
if ( ! $ajax_req ) :
  get_header();
  akaiv_before_content();
  akaiv_before_post( false );
  akaiv_page_header( 'Rank' ); ?>

<div class="loading"></div>

<form method="GET" action="">
  <select class="form-control league-filter-select" data-league-filter>
    <?php foreach ( array( 354, 358 ) as $id ) : ?>
      <option value="<?php echo $id; ?>" <?php echo ( ( $id == $league_id ) ? 'selected' : '' ); ?>><?php echo ( ( 354 === $id ) ? 'Premier League' : 'Primera Division' ) . ' 2014/15'; ?></option>
    <?php endforeach; ?>
  </select>
</form>

<?php endif; ?>

<div class="filtered-content">
  <div role="tabpanel" class="rank-data-wrapper">
    <ul class="nav nav-pills" role="tablist">
      <li class="active"><a href="#team-rank" role="tab" data-toggle="tab">Team</a></li>
      <li><a href="#player-rank" role="tab" data-toggle="tab">Player</a></li>
    </ul>

    <div class="tab-content rank-table-wrapper">
      <div role="tabpanel" class="tab-pane active" id="team-rank">
        <table class="table sos-table">
          <thead>
            <tr>
              <th class="team-rank">Rank</th>
              <th class="team-name thead">Team</th>
              <th>Points</th>
              <th>Goals</th>
              <th>GoalsAgainst</th>
              <th>GoalDifference</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $team_rank['ranking'] as $rank ) : ?>
              <tr>
                <td class="team-rank"><?php echo $rank['rank']; ?></td>
                <?php $emblem_src = ( ! $rank['emblem'] ) ? THEME_URL . '/images/no_image.svg' : ( strpos( $rank['emblem'], 'http' ) !== false ? $rank['emblem'] : 'http://' . $rank['emblem'] ); ?>
                <td class="team-name"><img src="<?php echo $emblem_src; ?>" class="team-emblem"><?php echo $rank['team']; ?></td>
                <td><?php echo $rank['points']; ?></td>
                <td><?php echo $rank['goals']; ?></td>
                <td><?php echo $rank['goalsAgainst']; ?></td>
                <td><?php echo $rank['goalDifference']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div role="tabpanel" class="tab-pane" id="player-rank">Finding API</div>
    </div>
  </div>
</div>

<?php
if ( ! $ajax_req ) {
  akaiv_after_post();
  akaiv_after_content();
  get_footer();
}
