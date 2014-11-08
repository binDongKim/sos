<?php
get_header();
akaiv_before_content();
akaiv_before_page();
akaiv_page_header( '로그인' );
?>

<div class="page-content">
  <form method="POST" action>
    <?php wp_nonce_field( 'signin' ); ?>

    <input type="hidden" name="redirect_to" value="<?php echo empty( $_REQUEST['redirect_to'] ) ? '' : $_REQUEST['redirect_to']; ?>">

    <div class="form-group">
      <label for="log">아이디</label>
      <input type="text" id="log" name="log" placeholder="아이디" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="pwd">비밀번호</label>
      <input type="password" id="pwd" name="pwd" placeholder="비밀번호" class="form-control" required>
    </div>

    <div class="checkbox">
      <label><input type="checkbox" id="rememberme" name="rememberme"> 로그인 유지</label>
    </div>

    <button type="submit" class="btn btn-default">로그인</button>
    <a href="<?php echo home_url( '/signin/lost-password' ); ?>">비밀번호를 잃어버린 경우</a>
  </form>

</div><!-- .page-content -->

<?php
akaiv_after_page();
akaiv_after_content();
get_footer();
