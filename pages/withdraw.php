<?php
get_header();
akaiv_before_content();
akaiv_before_page();
akaiv_page_header( '회원탈퇴' );
?>

<div class="page-content">
  <form method="POST" action>
    <?php wp_nonce_field( 'withdraw-' . get_current_user_id() ); ?>

    <div class="form-group">
      <label for="password">비밀번호</label>
      <input type="password" id="password" name="password" placeholder="비밀번호" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-default">회원탈퇴</button>
  </form>
</div><!-- .page-content -->

<?php
akaiv_after_page();
akaiv_after_content();
get_footer();
