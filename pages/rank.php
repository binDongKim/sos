<?php
get_header();
akaiv_before_content();
akaiv_before_page();
akaiv_page_header( 'Rank' ); ?>

<form method="GET" action="">
  <select class="form-control" data-league-filter>
    <?php foreach ( array( 354, 358 ) as $id ) : ?>
      <option value="<?php echo $id; ?>"><?php echo ( ( 354 === $id ) ? 'Premier League' : 'Primera Division' ) . ' 2014/15'; ?></option>
    <?php endforeach; ?>
  </select>
</form>

<div role="tabpanel">
  <ul class="nav nav-pills" role="tablist">
    <li class="active"><a href="#team-rank" role="tab" data-toggle="tab">Team</a></li>
    <li><a href="#player-rank" role="tab" data-toggle="tab">Player</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="team-rank">
      <table class="table sos-table">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Team</th>
            <th>Points</th>
            <th>Goals</th>
            <th>GoalsAgainst</th>
            <th>GoalDifference</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $rank_arr['ranking'][0] as $rank ) : ?>
            <tr>
              <td><?php echo $rank['rank']; ?></td>
              <?php $emblem_src = ( ! $rank['crestURI'] ) ? THEME_URL . '/images/no_image.svg' : $rank['crestURI']; ?>
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

<?php
akaiv_after_page();
akaiv_after_content();
get_footer();
