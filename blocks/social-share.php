<?php if (is_singular()) : ?>
    <?php
        $url = urlencode(get_permalink());
        $title = urlencode(get_the_title());
        $img = '';
        if (has_post_thumbnail()) {
            list($img) = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $img = urlencode($img);
        }
        $short_url = urlencode(get_the_guid());
    ?>
    <div class="social-share">
        <a class="facebook" href="https://www.facebook.com/share.php?u=<?php echo $url; ?>&t=<?php echo $title; ?>">
            <i class="fa fa-facebook"></i>
        </a>
        <a class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>">
            <i class="fa fa-twitter"></i>
        </a>
        <a class="email" href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>">
            <i class="fa fa-envelope"></i>
        </a>
        <a class="sms" href="sms:&body=<?php echo $title; ?>: <?php echo $short_url; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 511.6 511.6" class="sms-svg"><path class="sms-svg__icon" d="M477.4 127.4c-22.8-28.1-53.9-50.2-93.1-66.5 -39.2-16.3-82-24.4-128.5-24.4 -34.6 0-67.8 4.8-99.4 14.4 -31.6 9.6-58.8 22.6-81.7 39 -22.8 16.4-41 35.8-54.5 58.4C6.8 170.8 0 194.5 0 219.2c0 28.5 8.6 55.3 25.8 80.2 17.2 24.9 40.8 45.9 70.7 62.8 -2.1 7.6-4.6 14.8-7.4 21.7 -2.9 6.9-5.4 12.5-7.7 16.9 -2.3 4.4-5.4 9.2-9.3 14.6 -3.9 5.3-6.8 9.1-8.8 11.3 -2 2.2-5.3 5.8-9.9 10.8 -4.6 5-7.5 8.3-8.8 9.9 -0.2 0.1-1 1-2.3 2.6 -1.3 1.6-2 2.4-2 2.4l-1.7 2.6c-1 1.4-1.4 2.3-1.3 2.7 0.1 0.4-0.1 1.3-0.6 2.9 -0.5 1.5-0.4 2.7 0.1 3.4v0.3c0.8 3.4 2.4 6.2 5 8.3 2.6 2.1 5.5 3 8.7 2.6 12.4-1.5 23.2-3.6 32.5-6.3 49.9-12.8 93.6-35.8 131.3-69.1 14.3 1.5 28.1 2.3 41.4 2.3 46.4 0 89.3-8.1 128.5-24.4 39.2-16.3 70.2-38.4 93.1-66.5 22.8-28.1 34.3-58.7 34.3-91.8C511.6 186.1 500.2 155.5 477.4 127.4zM144.5 270.2c-11.8 0-22.2-3.5-30.9-11.6l14.4-15.9c4.2 5.5 10.9 8.7 17.7 8.7 6.6 0 14-3.1 14-9.6 0-16.9-43.2-7.8-43.2-38.5 0-19.6 17-29.9 35.1-29.9 10.4 0 20.4 2.7 28.2 9.6l-13.9 15.2c-3.2-4.2-9.7-6.1-14.7-6.1 -5.7 0-13.6 2.6-13.6 9.5 0 16.8 42.4 6 42.4 38.2C180 260.4 163.5 270.2 144.5 270.2zM309.4 267.8h-20.3v-70.6H288.9l-24.2 70.6h-15.5l-23.3-70.6h-0.3v70.6h-20.3V175.8h30.7l21.2 60.1h0.3l21.3-60.1h30.6V267.8zM362.6 270.2c-11.8 0-22.2-3.5-30.9-11.6l14.4-15.9c4.2 5.5 10.9 8.7 17.7 8.7 6.6 0 14-3.1 14-9.6 0-16.9-43.2-7.8-43.2-38.5 0-19.6 17-29.9 35.1-29.9 10.4 0 20.4 2.7 28.2 9.6l-13.9 15.2c-3.2-4.2-9.8-6.1-14.7-6.1 -5.7 0-13.7 2.6-13.7 9.5 0 16.8 42.4 6 42.4 38.2C398.1 260.4 381.6 270.2 362.6 270.2z"></path></svg>
        </a>
        <a href="#" class="btn-chat"><span class="fa fa-comments"></span></a>
    </div>
<?php endif; ?>