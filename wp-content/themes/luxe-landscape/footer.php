<?php
/**
 * Theme Footer
 *
 * Premium footer with newsletter, collections, support, social links.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- Premium Footer -->
<footer class="site-footer" id="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Brand + Newsletter -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="material-symbols-outlined" aria-hidden="true">filter_vintage</span>
                    <span class="footer-logo-text">LUXE LANDSCAPE</span>
                </div>
                <p class="footer-tagline">Crafting the future of biophilic luxury with factory-direct ethics and sustainable engineering.</p>
                <div class="footer-newsletter">
                    <h4>Subscribe to our Design Journal</h4>
                    <form class="footer-newsletter-form" action="#" method="post">
                        <input type="email" name="newsletter_email" placeholder="email@address.com" required>
                        <button type="submit">Join</button>
                    </form>
                </div>
            </div>

            <!-- Collections Column -->
            <div class="footer-col">
                <h4>Collections</h4>
                <?php
                if ( has_nav_menu( 'footer-collections' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer-collections',
                        'container'      => false,
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <ul>
                        <li><a href="#">Outdoor Sculptures</a></li>
                        <li><a href="#">Vertical Gardens</a></li>
                        <li><a href="#">Water Features</a></li>
                        <li><a href="#">Premium Soil</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>

            <!-- Support Column -->
            <div class="footer-col">
                <h4>Support</h4>
                <?php
                if ( has_nav_menu( 'footer-support' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer-support',
                        'container'      => false,
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <ul>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Wholesale Portal</a></li>
                        <li><a href="#">Warranty Policy</a></li>
                        <li><a href="#">Contact Expert</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>

            <!-- Social Column -->
            <div class="footer-col">
                <h4>Social</h4>
                <div class="footer-social-links">
                    <a href="#" class="footer-social-link" aria-label="Instagram">
                        <span class="material-symbols-outlined" aria-hidden="true">photo_camera</span>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Pinterest">
                        <span class="material-symbols-outlined" aria-hidden="true">push_pin</span>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="LinkedIn">
                        <span class="material-symbols-outlined" aria-hidden="true">work</span>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="YouTube">
                        <span class="material-symbols-outlined" aria-hidden="true">play_circle</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Luxe Landscape Factory Group. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
