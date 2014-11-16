<?php
get_header();
akaiv_before_content();
akaiv_before_post( false );
akaiv_page_header( '비밀번호 분실' ); ?>

<div class="page-content">
  <form method="POST" action="<?php echo wp_lostpassword_url( home_url( '/signin' ) ); ?>">
    <div class="form-group">
      <label for="user_login">아이디 혹은 이메일</label>
      <input type="text" id="user_login" name="user_login" placeholder="아이디 혹은 이메일" class="form-control" required>
    </div>

    <p class="help-block">이메일로 비밀번호 재설정 정보가 발송됩니다. 로그인 화면으로 이동합니다.</p>
    <button type="submit" class="btn btn-default">이메일로 확인</button>
  </form>
</div><!-- .page-content -->

<?php
akaiv_after_post();
akaiv_after_content();
get_footer();
