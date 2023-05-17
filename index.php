<?php
// Memeriksa apakah pengguna sudah login atau belum
session_start();
if (isset($_SESSION['username'])) {
  // Jika pengguna sudah login, tampilkan tombol "Sign Out" dan "Dashboard"
  $sign_out_link = '<li class="footer__item">
  <a href="logout.php" class="footer__link">Sign Out</a>
</li>';
  $dashboard_link = '<a href="Dashboard/" class="button button--ghost">Dashboard</a></li>';
} else {
  // Jika pengguna belum login, tampilkan tombol "Sign In"
  $sign_in_link = '<a href="Sign-In/" class="button button--ghost">
  Sign In
</a>';
}

// Output HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="apple-touch-icon" sizes="180x180" href="Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="Favicon/icons8-synchronize-310.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="Assets/favicons/browserconfig.xml">
    <meta name="theme-color" content="#a789d4">

    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="Assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="Assets/css/styles.css">

    <title> Absensi Mahasiswa </title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
        <a href="/" class="nav__logo bx change-theme change-theme-button">
                            <img src="./Assets/logo_absensi_1.gif" alt="Absensi Mahasiswa">
        </a>

<SCRipt>window.onload = function() {
  var logoImg = document.getElementById('logo-img');
  logoImg.classList.add('fade-in');
};
</SCRipt>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item ">
                        <a href="#home" class="nav__link">
                            <i class='bx bx-home'></i>
                        </a>
                    </li>

                    <li class="nav__item ">
                        <a href="#about" class="nav__link">
                            <i class='bx bx-user'></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#contact" class="nav__link">
                            <i class='bx bx-message-square-dots'></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!--=============== theme change button ===============-->
            <i class='bx bx-moon change-theme change-theme-button' id="theme-button"></i>

        </nav>
    </header>

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== HOME ===============-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__greeting">Selamat Datang Di Web</span>
                    <h1 class="home__name">Absensi Mahasiswa</h1>
                    <h3 class="home__education">~ Absen Lebih Mudah Melalui Absensi Mahasiswa ~</h3>

                    <div class="home__button">
                    <?php echo isset($sign_in_link) ? $sign_in_link : ''; ?>

                    <?php echo isset($dashboard_link) ? $dashboard_link : ''; ?>
                        <a href="#about" class="button">Feature</a>
                    </div>
                </div>

                <div class="home__handle">
                    <img src="Assets/img/44886-O4SG74@4x.png" alt="" class="home__img">
                </div>

                <div class="home__social">
                    <a href="https://wa.me/6287831561048" target="_blank" class="home__social-link">
                        <i class='bx bxl-whatsapp'></i>
                    </a>
                    <a href="https://www.instagram.com/unindra.id/" target="_blank" class="home__social-link">
                        <i class='bx bxl-instagram'></i>
                    </a>
                    <a href="https://unindra.ac.id/" target="_blank" class="home__social-link">
                        <i class='bx bxl-dribbble'></i>
                    </a>
                </div>

                <a href="#about" class="home__scroll">
                    <i class='bx bx-mouse home__scroll-icon'></i>
                    <span class="home__scroll-name">Scroll Down</span>
                </a>
            </div>
        </section>

        <!--=============== ABOUT ===============-->
        <section class="about section" id="about">
            <span class="section__subtitle">List Feature</span>
            <h2 class="section__title">Feature</h2>

            <div class="about__container container grid">
            <img src="assets/44886-O4SG74.png" alt="" class="about__img">

                <div class="about__data">
                    <div class="about__info">
                        <div class="about__box">
                            <i class='bx bx-award about__icon'></i>
                            <h3 class="about__title">Input Absensi Mahasiswa</h3>
                            <span class="about__subtitle">Input absensi mahasiswa dengan mudah dan cepat menggunakan fitur ini.</span>
                        </div>
                        <div class="about__box">
                            <i class='bx bx-briefcase-alt about__icon'></i>
                            <h3 class="about__title">Tampilkan Data Absensi</h3>
                            <span class="about__subtitle">Lihat data absensi mahasiswa dalam bentuk tabel dan grafik.</span>
                        </div>
                        <div class="about__box">
                            <i class='bx bx-support about__icon'></i>
                            <h3 class="about__title">Tampilkan Data Mahasiswa</h3>
                            <span class="about__subtitle">Tampilkan informasi lengkap tentang mahasiswa dalam kelas.</span>
                        </div>
                    </div>

                    <p class="about__description">
                    Kami hadir untuk memudahkan Anda dalam memantau absensi kuliah dan memastikan Anda tidak kehilangan informasi penting mengenai jadwal dan materi kuliah.
                    </p>

                    <a href="#contact" class="button about__button-contact">Report For Error</a>
                </div>
            </div>
        </section>
        

        <!--=============== WORK ===============-->
            

            <div class="work__container container grid">
                

            </div>

        <!--=============== TESTIMONIALS ===============-->
        <section class="testimonial section">
            <span class="section__subtitle">Testimonials From This Web</span>
            <h2 class="section__title">Testimonials</h2>

            <div class="testimonial__container container swiper">
                <div class="swiper-wrapper">
                    <div class="testimonial__card swiper-slide">
                        <img src="assets/img/testimonial1.png" alt="" class="testimonial__img">

                        <h3 class="testimonial__name">Jhon Doe</h3>
                        <p class="testimonial__description">
                            A really good job, all aspects of the project were done well.
                            Very creative and thoughtful. I was very impressed and would recommend this to anyone.
                        </p>
                    </div>

                    <div class="testimonial__card swiper-slide">
                        <img src="assets/img/testimonial2.png" alt="" class="testimonial__img">

                        <h3 class="testimonial__name">Ada Hill</h3>
                        <p class="testimonial__description">
                            A really good job, all aspects of the project were done well.
                            Very creative and thoughtful. I was very impressed and would recommend this to anyone.
                        </p>
                    </div>

                    <div class="testimonial__card swiper-slide">
                        <img src="assets/img/testimonial3.png" alt="" class="testimonial__img">

                        <h3 class="testimonial__name">Jessica Park</h3>
                        <p class="testimonial__description">
                            A really good job, all aspects of the project were done well.
                            Very creative and thoughtful. I was very impressed and would recommend this to anyone.
                        </p>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </section>

        <!--=============== CONTACT ===============-->
        <section class="contact section" id="contact">
            <sapn class="section__subtitle">Get in touch</sapn>
            <h3 class="section__title">Contact Me</h3>

            <div class="contact__container container grid">
                <div class="contact__content">
                    <h3 class="contact__title contact__title-info">Talk to me</h3>

                    <div class="contact__info">
                        <div class="contact__card">
                            <i class='bx bx-mail-send contact__card-icon'></i>
                            <h3 class="contact__card-title">Email</h3>
                            <span class="contact__card-data">absen-mahasiswa@my.id</span>

                            <a href="mailto:absen-mahasiswa@my.id" target="_blank" class="contact__button">
                                Write Me <i class='bx bx-right-arrow contact__button-icon'></i>
                            </a>
                        </div>

                        <div class="contact__card">
                            <i class='bx bxl-whatsapp contact__card-icon'></i>
                            <h3 class="contact__card-title">Whatsapp</h3>
                            <span class="contact__card-data">+6287831561048</span>

                            <a href="https://api.whatsapp.com/send?phone=+6287831561048&text=Hallo Kak!" target="_blank"
                                class="contact__button">
                                Write Me <i class='bx bx-right-arrow contact__button-icon'></i>
                            </a>
                        </div>

                        <div class="contact__card">
                            <i class='bx bxl-instagram contact__card-icon'></i>
                            <h3 class="contact__card-title">Instagram</h3>
                            <span class="contact__card-data">@unindra.info</span>

                            <a href="https://www.instagram.com/unindra.info/" target="_blank" class="contact__button">
                                Visit <i class='bx bx-right-arrow contact__button-icon'></i>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="contact__content">
                    <h3 class="contact__title contact__title-form">Write Me your Message</h3>

                    <form action="#" class="contact__form">
                        <div class="contact__form-div">
                        <label for="" class="contact__form-tag">Name</label>
                        <input type="text" placeholder="Enter name" class="contact__form-input" id="name">
                        </div>

                        <div class="contact__form-div">
                        <label for="" class="contact__form-tag">Mail</label>
                        <input type="text" placeholder="Enter email" class="contact__form-input" id="email">
                        </div>

                        <div class="contact__form-div contact__form-area">
                        <label for="" class="contact__form-tag">Message</label>
                        <textarea cols="30" rows="10" placeholder="Write your Message" class="contact__form-input " id="message"></textarea>
                        </div>

                        <button class="button" onclick="sendEmail()">
                        Send Message
                        </button>
                    </form>

                    <script>
                        function sendEmail() {
                        const name = document.getElementById('name').value;
                        const email = document.getElementById('email').value;
                        const message = document.getElementById('message').value;
                        const subject = "New message from " + name;

                        const body = "From: " + name + " (" + email + ")%0D%0A%0D%0A" + message;
                        const mailToLink = "mailto:absen-mahasiswa@my.id?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);

                        window.location.href = mailToLink;
                        }
                    </script>
                </div>


                </div>

        </section>
    </main>

    <!--=============== FOOTER ===============-->
    <footer class="footer">
        <div class="footer__container container">
            <h1 class="footer__title">Absensi Mahasiswa</h1>

            <ul class="footer__list">

                <li class="footer__item">
                    <a href="#" class="footer__link">Home</a>
                </li>
                <li class="footer__item">
                    <a href="#about" class="footer__link">Feature</a>
                </li>
                <?php echo isset($sign_out_link) ? $sign_out_link : ''; ?>
                <li class="footer__item">
                    <a href="Contact/" class="footer__link">Contact</a>
                </li>
            </ul>

            <ul class="footer__social">
                <li class="footer__social-item">
                    <a href="https://wa.me/6287831561048" target="_blank" class="footer__social-link">
                        <i class='bx bxl-whatsapp footer__social-icon'></i>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="https://www.instagram.com/unindra.info/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-instagram footer__social-icon'></i>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="https://discord.gg/6KSmKDBH" target="_blank" class="footer__social-link">
                        <i class='bx bxl-discord footer__social-icon'></i>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="https://unindra.ac.id" target="_blank" class="footer__social-link">
                        <i class='bx bxl-dribbble footer__social-icon'></i>
                    </a>
                </li>
            </ul>

            <span class="footer__copy">
            Copyright &copy; 
				<script>document.write(new Date().getFullYear());</script> 
				| All rights reserved
            </span>
        </div>
    </footer>

    <!--=============== SCROLLREVEAL ===============-->

    <!-- <script src="assets/js/scrollreveal.min.js"></script> -->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="Assets/js/swiper-bundle.min.js"></script>

    <!--=============== MIXITUP FILTER ===============-->
    <script src="Assets/js/mixitup.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="Assets/js/main.js"></script>
</body>

</html>