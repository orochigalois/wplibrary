<?php

$overlay        = get_sub_field( 'image' );
$video      = get_sub_field( 'video' );

?>


            <div class="youtube-container-wrap">
                <div class="youtube-container">


                <?php

                // get iframe HTML
                $iframe = $video;


                // use preg_match to find iframe src
                preg_match('/src="(.+?)"/', $iframe, $matches);
                $src = $matches[1];


                // add extra params to iframe src
                $params = array(
                    'enablejsapi'    => 1
                );

                $new_src = add_query_arg($params, $src);

                $iframe = str_replace($src, $new_src, $iframe);


                // add extra attributes to iframe html
                $attributes = 'frameborder="0" id="embed-video"';

                $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);


                // echo $iframe
                echo $iframe;

                ?>
                
                    <div class="youtube-overlay" style="background:url(<?= $overlay ?>) no-repeat center/cover;">
                        <img id="play-button" src="<?php lp_image_dir(); ?>/play.png"  />
                    </div>
                </div>
            </div>
