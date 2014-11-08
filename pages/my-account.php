<?php
get_header();
akaiv_before_content();
akaiv_before_page();
akaiv_page_header( '회원정보 변경' );
?>

<div class="page-content">
  <form method="POST" action enctype="multipart/form-data">
    <?php wp_nonce_field( 'my-account-' . get_current_user_id() ); ?>

    <div class="form-group">
      <label for="user_login">아이디</label>
      <input type="text" id="user_login" name="user_login" value="<?php echo $user->username; ?>" placeholder="아이디" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_pass">비밀번호 (바꿀 때만)</label>
      <input type="password" id="user_pass" name="user_pass" value="" placeholder="비밀번호" class="form-control">
    </div>

    <div class="form-group">
      <label for="user_pass2">비밀번호 확인 (바꿀 때만)</label>
      <input type="password" id="user_pass2" name="user_pass2" value="" placeholder="비밀번호 확인" class="form-control">
    </div>

    <div class="form-group">
      <label for="display_name">이름</label>
      <input type="text" id="display_name" name="display_name" value="<?php echo $user->display_name; ?>" placeholder="이름" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="nickname">닉네임</label>
      <input type="text" id="nickname" name="nickname" value="<?php echo $user->nickname; ?>" placeholder="닉네임" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_email">이메일</label>
      <input type="email" id="user_email" name="user_email" value="<?php echo $user->email; ?>" placeholder="이메일" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="user_url">홈페이지</label>
      <input type="url" id="user_url" name="user_url" value="<?php echo $user->user_url; ?>" placeholder="홈페이지" class="form-control">
    </div>

    <div class="form-group">
      <label for="profile">프로필 사진</label>
      <?php if ( ! empty( $user->profile['file'] ) ) : ?>
        <img src="<?php echo $user->profile['file']['url']; ?>">
        <label><input type="checkbox" name="remove_profile"> 프로필 사진 삭제</label>
      <?php endif; ?>
      <input type="file" id="profile" name="profile">
    </div>

    <button type="submit" class="btn btn-default">회원정보 변경</button>
    <a href="<?php echo home_url( '/withdraw' ); ?>">회원탈퇴</a>
  </form>
</div><!-- .page-content -->

<?php
akaiv_after_page();
akaiv_after_content();
get_footer();
