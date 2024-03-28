<?php
include "admin/koneksi.php";
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_admin where username = '$username' && password = '$password'");
    $sql_num = mysqli_num_rows($sql);

    if ($sql_num >= 1) {
        session_start();
        $_SESSION['status'] = "Valid";
        $_SESSION['level'] = "Admin";
        $_SESSION['username'] = $username;
        header("location: admin/index.php");
    }

    $sql_fetch = mysqli_fetch_array($sql);
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta name="author" content="Coderthemes" />

    <!-- Site Title -->
    <title>Aplikasi Formulir Surat Menyurat </title>
    <!-- Site favicon -->
    <link rel="shortcut icon" href="images/logo-puskesmas.png" />

    <!-- Swiper js -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css" type="text/css" />

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60">
    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom navbar-light sticky-dark" id="navbar-sticky">
        <div class="container">
            <!-- LOGO -->
            <a class="logo text-uppercase" href="index.php">
                <img src="images/logo-puskesmas.png" style="width: 50px" class="logo-dark" />
                <img src="images/logo-puskesmas.png" style="width: 50px" alt="" class="logo-light" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                    <!-- <li class="nav-item">
                        <a href="#home" class="nav-link">Home</a>
                    </li> -->

                </ul>
                <ul class="navbar-nav navbar-center">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="btn btn-sm nav-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- home-agency start -->
    <section class="hero-1" id="home">
        <div class="bg-overlay-img"></div>
        <div class="container">
            <div class="row align-items-center hero-content">
                <div class="col-lg-6">
                    <h1 class="hero-title fw-bold mb-4 pb-3 text-white">Aplikasi Formulir Surat Menyurat</h1>
                    <p class="text-white opacity-75 mb-4 pb-3 fs-17">Puskesmas Wiradesa.</p>
                    <div class="subscribe-form me-lg-5 mb-5 mb-lg-0">
                        <form action="cek_nip.php" method="POST">
                            <i class="mdi mdi-import form-icon"></i>
                            <input type="text" required name="nip" class="form-control" id="">
                            <input type="submit" name="cek_nip" value="Cek NIP" class="btn btn-success form-btn">
                        </form>

                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <img src="images/logo-puskesmas.png" alt="" style="width: 300px;" class="img-fluid" />
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="hero-bottom-shape">
                        <img src="images/heros/hero-1-bottom-shape.png" alt="" class="w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home-agency end -->

    <!-- faqs start -->
    <section id="app">
        <div class="container">
            <ul class="list-inline text-center mt-3">
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="https://pcarejkn.bpjs-kesehatan.go.id/eclaim/Login" target="_blank" role="button"><i class="fab fa-eclaim me-2"></i>E-CLAIM</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="https://pcarejkn.bpjs-kesehatan.go.id/eclaim/Login" target="_blank" role="button"><i class="fab fa-evaksin me-2"></i>E-VAKSIN</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" target="_blank" role="button"><i class="fab fa-ekinerja me-2"></i>E-KINERJA</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" target="_blank" role="button"><i class="fab fa-simpus me-2"></i>SIMPUS</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" target="_blank" role="button"><i class="fab fa-sidmk me-2"></i>SIDMK</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" target="_blank" role="button"><i class="fab fa-siarka me-2"></i>SIARKA</a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" target="_blank" role="button"><i class="fab fa-simple me-2"></i>SIMPLE</a>
                        </li>

            </ul>
        </div>
    </section>
    <!-- faqs end -->

    <!-- contact start -->
    <section class="section bg-light" id="contact">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6 text-center">
                    <h6 class="subtitle">Our <span class="fw-bold">Contact Us</span></h6>
                    <h2 class="title">Get in Touch</h2>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-5">
                        <div class="flex-shrink-0">
                            <img src="images/hello-icon.png" alt="..." height="80" class="" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h2 class="mb-0">Say Hello!</h2>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-soft-primary text-primary">
                                    <i class="mdi mdi-email"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0 fs-18">Email</h5>
                            </div>
                        </div>
                        <p class="mb-1"><i class="mdi mdi-arrow-right-thin text-muted me-1"></i><a href="javascript:void(0);" class="text-secondary">puskesmas.wiradesa@gmail.com</a></p>

                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-soft-primary text-primary">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0 fs-18">Phone</h5>
                            </div>
                        </div>
                        <p class="mb-1"><i class="mdi mdi-arrow-right-thin text-muted me-1"></i><a href="javascript:void(0);" class="text-secondary"> WhatsApp 082250500535</a></p>

                    </div>
                    <div class="">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-soft-primary text-primary">
                                    <i class="mdi mdi-google-maps"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0 fs-18">Address</h5>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-2 text-secondary"><i class="mdi mdi-arrow-right-thin text-muted me-1"></i> Surabaya </h5>
                        <p class="text-muted lh-base">Jl. Raya Pantura, Mayangan, Kec. Wiradesa, Pekalongan, Jawa Tengah 51152, Pekalongan Puskesmas Wiradesa</p>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="card contact-form rounded-lg mt-4 mt-lg-0">
                        <div class="card-body p-5">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formFirstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="formFirstName" placeholder="Your first name..." required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formLastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="formLastName" placeholder="Last first name..." required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formEmail" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="formEmail" placeholder="Your email..." required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formPhone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="formPhone" placeholder="Type phone number..." required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="formSubject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="formSubject" placeholder="Type subject..." required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="formMessages" class="form-label">Messages</label>
                                            <textarea class="form-control" id="formMessages" rows="4" placeholder="Type messages..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient-danger">Send Messages <i class="mdi mdi-send ms-1"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact end -->

    <!-- footer & cta start -->
    <section class="footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center text-lg-start">
                    <div class="footer-logo mb-4">
                        <a href="#">
                            <img src="images/logo-puskesmas.png" style="width: 100px;" alt="" /></a>
                    </div>
                    <a href="#" class="text-white">puskesmas.wiradesa@gmail.com</a>
                    <p class="text-white">Telepon 02854417121</p>

                    <h5 class="fs-18 mb-3 text-white">Follow Us</h5>
                    <ul class="list-inline mt-5">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/puskesmas.wiradesa/" target="_blank" class="footer-social-icon"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/PWiradesa" target="_blank" class="footer-social-icon"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/puskesmas_wiradesa/" target="_blank" class="footer-social-icon"><i class="mdi mdi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.youtube.com/channel/UCuzFo9_QIaIwOrRPM86GGdw" target="_blank" class="footer-social-icon"><i class="mdi mdi-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">About Us</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="#home" class="footer-link">Home</a></li>
                                <li><a href="#app" class="footer-link">Web Lain</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Ijin</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Lupa Absen</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Perintah Tugas</a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </section>
    
    </div>
    <!-- footer & cta end -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" class="back-to-top-btn btn btn-gradient-primary" id="back-to-top"><i class="mdi mdi-chevron-up"></i></a>




    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Login Admin</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan Username dan Password</p>
                    </div>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Username</label>
                            <input type="text" class="form-control" id="emailAddress" name="username" placeholder="Username" />
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                        </div>

                        <input type="submit" value="Login" name="login" class="btn btn-gradient-primary w-100">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- counter -->
    <script src="js/counter.init.js"></script>
    <!-- swiper -->
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/app.js"></script>
</body>

</html>