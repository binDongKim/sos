<?php
get_header();
akaiv_before_content();
akaiv_before_post( false );
akaiv_page_header( 'Match' ); ?>

<script>
  var eplFixtures = JSON.parse('<?php echo $epl_fixtures; ?>');
  var eplTeamList = JSON.parse('<?php echo $epl_team_list; ?>');
</script>
<div id="calendar" class="calendar clearfix"></div>
<div id="match-ontheday" class="match-ontheday">
  <div class="match-header-wrapper">
    <h2>MATCH OF THE DAY</h2>
  </div>
  <div id="match-list" class="match-body-wrapper">
  </div>
</div>

<?php
akaiv_after_post();
akaiv_after_content();
get_footer();
