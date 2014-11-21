<?php
get_header();
akaiv_before_content();
akaiv_before_post( false );
akaiv_page_header( 'Match' ); ?>

<div id="calendar" class="calendar clearfix"></div>
<div id="match-oftheday" class="match-oftheday">
  <table class="table-match-oftheday">
    <thead>
      <tr>
        <td colspan="6">MATCH OF THE DAY</td>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<?php
akaiv_after_post();
akaiv_after_content();
get_footer();
