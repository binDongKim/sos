<?php
get_header();
akaiv_before_content();
akaiv_before_post( false );
akaiv_page_header( '회원가입' ); ?>

<div class="page-content">
  <form method="POST" action enctype="multipart/form-data">
    <?php wp_nonce_field( 'signup' ); ?>

    <div class="form-group">
      <label for="user_login">아이디</label>
      <input type="text" id="user_login" name="user_login" value="<?php echo $_POST['user_login']; ?>" placeholder="아이디" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_pass">비밀번호</label>
      <input type="password" id="user_pass" name="user_pass" value="" placeholder="비밀번호" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_pass2">비밀번호 확인</label>
      <input type="password" id="user_pass2" name="user_pass2" value="" placeholder="비밀번호 확인" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="display_name">이름</label>
      <input type="text" id="display_name" name="display_name" value="<?php echo $_POST['display_name']; ?>" placeholder="이름" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="nickname">닉네임</label>
      <input type="text" id="nickname" name="nickname" value="<?php echo $_POST['nickname']; ?>" placeholder="닉네임" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_email">이메일</label>
      <input type="email" id="user_email" name="user_email" value="<?php echo $_POST['user_email']; ?>" placeholder="이메일" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_url">홈페이지</label>
      <input type="url" id="user_url" name="user_url" value="<?php echo $_POST['user_url']; ?>" placeholder="홈페이지" class="form-control">
    </div>

    <div class="form-group">
      <label for="profile">프로필 사진</label>
      <input type="file" id="profile" name="profile">
    </div>

    <button type="reset" class="btn btn-default">초기화</button>
    <button type="submit" class="btn btn-default">회원가입</button>
  </form>
</div><!-- .page-content -->

<?php
akaiv_after_post();
akaiv_after_content();
get_footer();
