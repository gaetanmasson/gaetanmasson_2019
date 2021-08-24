<div class="entry__navigation-container">
    <div class="entry__navigation-grid">
        <div class="entry__navigation">
            <p>Next case study</p>
            <?php
            $nextPost = get_next_post();
                        
            if( $nextPost ) :
                $nextPostID = $nextPost->ID;
            ?>

                <a class="prev-post" href="<?php echo get_permalink( $nextPostID ); ?>"><?php echo $nextPost->post_title; ?></a>

            <?php
            else :
                $first_post = get_posts( array(
                    'posts_per_page'   => 1,
                    'order' => 'ASC'
                ) );
            ?>

                <a class="prev-post" href="<?php echo get_permalink( $first_post[0]->ID ); ?>"><?php echo get_the_title( $first_post[0]->ID ); ?></a>

            <?php
            endif;
            ?>
        </div>
    </div>
</div>