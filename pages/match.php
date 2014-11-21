<?php
get_header();
akaiv_before_content();
akaiv_before_post( false );
akaiv_page_header( 'Match' ); ?>

<div id="calendar" class="calendar clearfix"></div>
<?php include_once THEME_PATH . '/templates/match-oftheday.php'; ?>

<?php
akaiv_after_post();
akaiv_after_content();
get_footer();
