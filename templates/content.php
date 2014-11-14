<?php akaiv_before_page(); ?>

<?php if ( is_single() ) : /* 글 */ ?>

  <header class="entry-header">
    <h1 class="entry-title">
      <?php akaiv_the_title(); ?>
    </h1>
    <div class="entry-meta">
      <?php akaiv_post_meta( 'category' ); ?>
      <?php akaiv_post_meta( 'date' ); ?>
      <?php akaiv_post_meta( 'author' ); ?>
      <?php akaiv_edit_post_link(); ?>
    </div>
  </header>
  <?php akaiv_post_thumbnail(); ?>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <div class="entry-meta">
    <span class="tag-links"><?php the_tags('', ' ', ''); ?></span>
  </div>

<?php else : /* 목록 */ ?>

  <?php if ( 'knowledge' === get_post_type() ) : ?>
    <div class="type-link-wrapper">
      <a class="type-link" href><?php echo wp_get_post_terms(get_the_ID(),'knowledge_type')[0]->name; ?></a>
    </div>
  <?php else : /* 'news' === get_post_type() */ ?>
    <div class="thumbnail-wrapper">
      <?php akaiv_post_thumbnail(); ?>
    </div>
  <?php endif; ?>
  <div class="entry-wrapper">
    <h1 class="entry-title" data-toggle="collapse" data-target="#<?php echo get_the_ID(); ?>">
      <?php akaiv_the_title(); ?>
    </h1>
    <div id="<?php echo get_the_ID(); ?>" class="entry-content collapse">
      <?php the_content(); ?>
    </div>
  </div>
<?php endif; ?>

<?php akaiv_after_page(); ?>
