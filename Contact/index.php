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
    <link rel="apple-touch-icon" sizes="180x180" href="../Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="../Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="../Favicon/icons8-synchronize-310.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../Assets/favicons/browserconfig.xml">
    <meta name="theme-color" content="#a789d4">

    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="../Assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../Assets/css/styles.css">

    <title> Absensi Mahasiswa </title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
        <a href="/" class="nav__logo bx change-theme change-theme-button">
                            <img src="../Assets/logo_absensi_1.gif" alt="Absensi Mahasiswa">
        </a>

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
        <!--=============== WORK ===============-->
        <section class="work section" id="Contact-PJ">
            <span class="section__subtitle">Contact</span>
            <h2 class="section__title">Contact Penanggung Jawab</h2>

            <div class="work__container container grid">
                <div class="work__card">
                <center><img src="../Profile/328796444_1876222216104764_637998142530760089_nss.jpg" alt="" class="work__img"></center>

                    <h3 class="work__title">Kewarganegaraan - Angger Budianto</h3>

                    <a href="https://wa.me/6289665122203" class="work__button">
                    WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                    <center><img src="../Profile/328796444_1876222216104764_637998142530760089_nss.jpg" alt="" class="work__img"></center>

                    <h3 class="work__title">Komputer & Masyarakat - Angger Budianto</h3>

                    <a href="https://wa.me/6289665122203" class="work__button">
                        WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/4236.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Algoritma 2 - Nurma Wulandari</h3>

                    <a href="https://wa.me/6281290836265" class="work__button">
                    WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/52.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Sistem Digital ## - Afi Aulia</h3>

                    <a href="https://wa.me/6281911150211" class="work__button">
                    WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/63.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Bahasa Inggris Informatika - Kenny Josiah</h3>

                    <a href="https://wa.me/6289523268793" class="work__button">
                        WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/52.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Logika Matematika - Irham Fathkhrohman</h3>

                    <a href="https://wa.me/6287831561048" class="work__button">
                        WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/623.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Kalkulus Lanjut - M.Akbar Hernanda</h3>

                    <a href="https://wa.me/6285156306684" class="work__button">
                        WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>

                <div class="work__card">
                <center><img src="../Profile/623.png" alt="" class="work__img"></center>

                    <h3 class="work__title">Pemrograman 2 - M.Akbar Hernanda</h3>

                    <a href="https://wa.me/6287831561048" class="work__button">
                        WhatsApp <i class='bx bx-right-arrow work__icon'></i>
                    </a>
                </div>


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

        </section>
    </main>

<!--=============== FOOTER ===============-->
<footer class="footer">
        <div class="footer__container container">
            <h1 class="footer__title">Absensi Mahasiswa</h1>

            <ul class="footer__list">

                <li class="footer__item">
                    <a href="/" class="footer__link">Home</a>
                </li>
                <li class="footer__item">
                    <a href="#contact" class="footer__link">Get in touch</a>
                </li>
                <?php echo isset($sign_out_link) ? $sign_out_link : ''; ?>
                <li class="footer__item">
                    <a href="#Contact-PJ" class="footer__link">Contact</a>
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
    <script src="../Assets/js/swiper-bundle.min.js"></script>

    <!--=============== MIXITUP FILTER ===============-->
    <script src="../Assets/js/mixitup.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="../Assets/js/main.js"></script>
</body>

</html>