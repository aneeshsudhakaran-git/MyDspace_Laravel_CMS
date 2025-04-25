<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contents')->insert([
            [
                'id' => 1,
                'title' => 'Home',
                'category' => 3,
                'menu' => 1,
                'short_description' => 'short_description',
                'description' => '<div class="container">
                                    <div class="row gy-4">
                                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up">
                                    <h1>Elegant and creative solutions</h1>
                                    <p>We are team of talented designers making websites with Bootstrap</p>
                                    <div class="d-flex"><a href="#about" class="btn-get-started">Get Started</a> <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a></div>
                                    </div>
                                    <div class="col-lg-6 order-1 order-lg-2 hero-img aos-init aos-animate" data-aos="zoom-out" data-aos-delay="100"><img src="../../../demo/hero-img.png" alt="media-img" class="img-fluid animated" width="100%" height="100%"></div>
                                    </div>
                                    </div>', // Truncated for brevity, paste full HTML here
                'image' => '',
                'download_file_title' => null,
                'download_file' => '',
                'displayorder' => 1,
                'featured' => '0',
                'classname' => 1,
                'content_section' => 1,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'About',
                'category' => 3,
                'menu' => 2,
                'short_description' => null,
                'description' => '<!-- Section Title -->
                                    <div class="container section-title aos-init aos-animate" data-aos="fade-up"><span>About Us<br></span>
                                    <h2>About</h2>
                                    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                                    </div>
                                    <!-- End Section Title -->
                                    <div class="container">
                                    <div class="row gy-4">
                                    <div class="col-lg-6 position-relative align-self-start aos-init" data-aos="fade-up" data-aos-delay="100"><img src="../../../demo/about.png" alt="media-img" class="img-fluid" width="100%" height="100%"><br><a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a></div>
                                    <div class="col-lg-6 content aos-init" data-aos="fade-up" data-aos-delay="200">
                                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                                    <p class="fst-italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                                    </ul>
                                    <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                                    </div>
                                    </div>
                                    </div>', // Add full HTML
                'image' => null,
                'download_file_title' => null,
                'download_file' => null,
                'displayorder' => 2,
                'featured' => '0',
                'classname' => 3,
                'content_section' => 1,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Services',
                'category' => 3,
                'menu' => 3,
                'short_description' => null,
                'description' => '<!-- Section Title -->
                                    <div class="container section-title aos-init aos-animate" data-aos="fade-up"><span>Services</span>
                                    <h2>Services</h2>
                                    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                                    </div>
                                    <!-- End Section Title -->
                                    <div class="container">
                                    <div class="row gy-4">
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="100">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-activity"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Nesciunt Mete</h3>
                                    </a>
                                    <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                                    </div>
                                    </div>
                                    <!-- End Service Item -->
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="200">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-broadcast"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Eosle Commodi</h3>
                                    </a>
                                    <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                                    </div>
                                    </div>
                                    <!-- End Service Item -->
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="300">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-easel"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Ledo Markt</h3>
                                    </a>
                                    <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
                                    </div>
                                    </div>
                                    <!-- End Service Item -->
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="400">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-bounding-box-circles"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Asperiores Commodit</h3>
                                    </a>
                                    <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
                                    <a href="service-details.html" class="stretched-link"></a></div>
                                    </div>
                                    <!-- End Service Item -->
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="500">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Velit Doloremque</h3>
                                    </a>
                                    <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                                    <a href="service-details.html" class="stretched-link"></a></div>
                                    </div>
                                    <!-- End Service Item -->
                                    <div class="col-lg-4 col-md-6 aos-init" data-aos="fade-up" data-aos-delay="600">
                                    <div class="service-item position-relative">
                                    <div class="icon"><i class="bi bi-chat-square-text"></i></div>
                                    <a href="service-details.html" class="stretched-link">
                                    <h3>Dolori Architecto</h3>
                                    </a>
                                    <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                                    <a href="service-details.html" class="stretched-link"></a></div>
                                    </div>
                                    <!-- End Service Item --></div>
                                    </div>', // Add full HTML
                'image' => null,
                'download_file_title' => null,
                'download_file' => null,
                'displayorder' => 2,
                'featured' => '0',
                'classname' => '0',
                'content_section' => 1,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'title' => 'Contact',
                'category' => 3,
                'menu' => 4,
                'short_description' => null,
                'description' => '<section id="contact" class="contact section"><!-- Section Title -->
                                <div class="container section-title aos-init aos-animate" data-aos="fade-up"><span>Contact</span>
                                <h2>Contact</h2>
                                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                                </div>
                                <!-- End Section Title -->
                                <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                <div class="row gy-4">
                                <div class="col-lg-5">
                                <div class="info-wrap">
                                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200"><i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                <h3>Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                                </div>
                                <!-- End Info Item -->
                                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300"><i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                                </div>
                                </div>
                                <!-- End Info Item -->
                                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-envelope flex-shrink-0"></i>
                                    <div>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                    </div>
                                </div>
                                <!-- End Info Item --> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border: 0; width: 100%; height: 270px;" allowfullscreen="allowfullscreen" loading="lazy" referrerpolicy="no-referrer-when-downgrade" sandbox=""></iframe></div>
                                </div>
                                <div class="col-lg-7"><form id="contactForm" method="post" class="email-form aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">
                                <div class="col-md-6"><label for="name-field" class="pb-2">Your Name</label> <input type="text" name="cname" id="name-field" class="form-control" required=""></div>
                                <div class="col-md-6"><label for="email-field" class="pb-2">Your Email</label> <input type="email" class="form-control" name="cemail" id="email-field" required=""></div>
                                <div class="col-md-6"><label for="email-field" class="pb-2">Your Phone</label> <input type="text" class="form-control" name="cphone" id="email-field" required=""></div>
                                <div class="col-md-6"><label for="subject-field" class="pb-2">Subject</label> <input type="text" class="form-control" name="csubject" id="subject-field" required=""></div>
                                <div class="col-md-12"><label for="message-field" class="pb-2">Message</label> <textarea class="form-control" name="cdescription" rows="10" id="message-field" required=""></textarea></div>
                                <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"><br></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                                <button type="submit">Send Message</button></div>
                                </div>
                                </form></div>
                                <!-- End Contact Form --></div>
                                </div>
                                </section>', // Add full HTML
                'image' => null,
                'download_file_title' => null,
                'download_file' => null,
                'displayorder' => 1,
                'featured' => '0',
                'classname' => 10,
                'content_section' => 1,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'title' => 'Footer Nav',
                'category' => 3,
                'menu' => 5,
                'short_description' => null,
                'description' => '<div class="container">
                                    <div class="row gy-4">
                                    <div class="col-lg-4 col-md-6 footer-about"><strong>MyDspace</strong><br>Kerala,<br>India.
                                    <div class="footer-contact pt-3">
                                    <p class="mt-3"><strong>Phone:</strong> <span>+91 9446989994</span></p>

                                    </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 footer-links">
                                    <h4>Useful Links</h4>
                                    <ul>
                                    <li><i class="bi bi-chevron-right"></i><a href="../../../page/privacy">Privacy Policy</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="../../../page/terms">Terms of service</a></li>
                                    </ul>
                                    </div>
                                    <div class="col-lg-2 col-md-3 footer-links">
                                    <h4>Our Services</h4>
                                    <ul>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                                    </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                    <h4>Follow Us</h4>
                                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                                    <div class="social-links d-flex"><a><i class="bi bi-twitter-x"></i></a> <a><i class="bi bi-facebook"></i></a> <a><i class="bi bi-instagram"></i></a> <a><i class="bi bi-linkedin"></i></a></div>
                                    </div>
                                    </div>
                                </div>', // Add full HTML
                'image' => null,
                'download_file_title' => null,
                'download_file' => null,
                'displayorder' => 2,
                'featured' => '0',
                'classname' => 16,
                'content_section' => 2,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'title' => 'Copyright',
                'category' => 3,
                'menu' => 6,
                'short_description' => '',
                'description' => '<p style="text-align: center;">© <span>Copyright</span> <strong class="px-1 sitename">MyDspace</strong> <span>All Rights Reserved</span></p>
                                    <div class="credits" style="text-align: center;"><!-- All the links in the footer should remain intact. --><!-- You can delete the links only if you\'ve purchased the pro version. --><!-- Licensing information: https://bootstrapmade.com/license/ --><!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] --> Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="“https:/themewagon.com">ThemeWagon </a></div>
                                    <p style="text-align: center;"><a href="“https:/themewagon.com"> </a></p>', // Truncated for brevity, paste full HTML here
                'image' => '1745341797.png',
                'download_file_title' => null,
                'download_file' => '1745385113.pdf',
                'displayorder' => 3,
                'featured' => '0',
                'classname' => 14,
                'content_section' => 2,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
