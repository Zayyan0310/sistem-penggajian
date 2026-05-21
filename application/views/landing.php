<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>PT. MUTIARA JAWA - Penggajian</title>
      <!-- StyleSheets -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/bootstrap/bootstrap.min.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/fontawesome/css/all.min.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/style.css" />
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/perusahaan.png'); ?>">
   </head>
   <style>
            *,
      *:after,
      *:before {
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }

      html,
      body {
         font-family: "Poppins", sans-serif;
         overflow-x: hidden;
         scroll-behavior: smooth;
      }

      /* Common Styles */
      .Loader {
         position: fixed;
         z-index: 999999;
         top: 0;
         bottom: 0;
         left: 0;
         right: 0;
         background: #fff;
      }

      .Loader .LoaderWrapper {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
      }

      .Loader .LoaderWrapper .circleBall {
         display: inline-block;
         width: 1.5rem;
         height: 1.5rem;
         border-radius: 50%;
         background: #30a1f1;
         animation: Loadergrow 1.6s infinite ease-in both;
      }

      .Loader .LoaderWrapper .circleBall:nth-child(1) {
         animation-delay: 0s;
      }
      .Loader .LoaderWrapper .circleBall:nth-child(2) {
         animation-delay: 0.2s;
      }
      .Loader .LoaderWrapper .circleBall:nth-child(3) {
         animation-delay: 0.4s;
      }

      .collapse_menu i.fa-bars,
      .collapse_menu i.fa-times {
         font-size: 27px;
         cursor: pointer;
         color: #fff;
         display: none;
      }

      .Gototop {
         visibility: hidden;
         display: flex;
         justify-content: center;
         align-items: center;
         position: fixed;
         bottom: 30px;
         right: 30px;
         width: 50px;
         height: 50px;
         background: #00bfd8;
         color: white;
         border-radius: 50%;
         cursor: pointer;
         z-index: 1000;
         animation: bounce 1.5s infinite;
      }

      .Gototop:hover {
         background: #30a1f1;
         animation: none;
      }

      .Section {
         width: 100%;
         height: 100%;
         padding: 100px 50px 10px;
      }

      .Section .Heading h2 {
         font-size: 35px;
         background: linear-gradient(45deg, #00bfd8, #84ff3d);
         background-clip: text;
         color: transparent;
         font-weight: bolder;
         margin-bottom: 30px;
         position: relative;
      }

      .Section .Heading.Big h2 {
         font-size: 9vmin;
      }
      .Section .Heading.Center {
         text-align: center;
      }

      .Section .Heading.Center h2:after,
      .Section .Heading.Center h2:before {
         content: "";
         display: inline-block;
      }

      .Section .Heading.Center h2:after {
         width: 80%;
         height: 2px;
         background: linear-gradient(45deg, #00bfd8, #84ff3d);
         transform: translateY(-10px);
      }

      .Section .Heading.Center h2:before {
         position: absolute;
         top: 100%;
         left: 50%;
         transform: translate(-50%, -20px);
         width: 40%;
         height: 6px;
         background: linear-gradient(45deg, #00bfd8, #84ff3d);
      }

      .line {
         height: 1px;
         width: 80%;
         margin: 10px auto;
         background: #aaaaaa;
      }

      .MainBtn {
         padding: 10px;
         display: flex;
      }

      .banner .MainBtn .Btn,
      .MainBtn .Btn {
         padding: 5px 20px;
         margin: 5px;
         border: 2px solid #00bfd8;
         border-radius: 30px;
         cursor: pointer;
         transition: all 0.6s;
         white-space: pre;
      }

      .MainBtn .Btn.Bg {
         background: #00bfd8;
         color: #fff;
      }

      .MainBtn .Btn:hover {
         background: #30a1f1;
         color: #fff;
      }

      .social {
         background: #00bfd8;
         width: 35px;
         height: 35px;
         display: inline-flex;
         justify-content: center;
         align-items: center;
         margin-right: 5px;
         border-radius: 50%;
         transition: all 0.6s;
      }

      .social a {
         color: #fff;
      }

      .social:hover {
         background: #30a1f1;
      }

      /* Navbar */
      .navbar {
         transition: all 0.5s;
         padding: 20px;
      }

      .navbar.shrink {
         line-height: 1;
         padding: 10px;
         background: #fff;
         box-shadow: 0 0 6px #000;
      }

      .navbar .navbar-brand {
         font-family: "Bahnschrift", Verdana, Geneva, Tahoma, sans-serif;
         font-weight: bold;
         font-size: 30px;
         color: #fff;
      }

      .navbar .nav-item .nav-link {
         color: white;
      }
      .navbar.shrink .nav-item .nav-link {
         color: #00bfd8;
      }
      .navbar.shrink .nav-item.social .nav-link {
         color: white;
      }

      /* Banner */
      .banner {
         width: 100%;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         background-image: radial-gradient(
               circle at 17% 77%,
               rgba(17, 17, 17, 0.04) 0%,
               rgba(17, 17, 17, 0.04) 50%,
               rgba(197, 197, 197, 0.04) 50%,
               rgba(197, 197, 197, 0.04) 100%
            ),
            radial-gradient(
               circle at 26% 17%,
               rgba(64, 64, 64, 0.04) 0%,
               rgba(64, 64, 64, 0.04) 50%,
               rgba(244, 244, 244, 0.04) 50%,
               rgba(244, 244, 244, 0.04) 100%
            ),
            radial-gradient(
               circle at 44% 60%,
               rgba(177, 177, 177, 0.04) 0%,
               rgba(177, 177, 177, 0.04) 50%,
               rgba(187, 187, 187, 0.04) 50%,
               rgba(187, 187, 187, 0.04) 100%
            ),
            linear-gradient(19deg, rgb(28, 117, 250), rgb(34, 2, 159));
         background-size: cover;
         background-position: center center;
      }

      .banner .layer {
         background: #a2d5f24b;
         width: 100%;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .banner .layer .row .col:nth-child(1),
      .banner .layer .row .col-12 {
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .banner .layer .row .headerImg {
         background: url("../img/header-teamwork.svg");
         background-size: contain;
         background-repeat: no-repeat;
         background-position: center center;
      }

      .banner .layer .row .col-12 {
         width: 100%;
         position: absolute;
         top: 100%;
         transform: translateY(-200%);
      }

      .banner .layer .row .col-12 .Discover {
         width: 40px;
         height: 40px;
         background: #30a1f1;
         border-radius: 50%;
         display: flex;
         justify-content: center;
         align-items: center;
         color: white;
         transform: translateY(50%);
         animation: bounce 1s infinite;
         cursor: pointer;
      }

      .banner .layer .row .col-12 .Discover:hover {
         animation: none;
      }

      /* Footer */
      .Footer {
         border-top: 1px solid #7e7e7e;
         padding-top: 20px;
      }

      .Footer .row .FooterHeading {
         font-size: 25px;
         font-weight: 900;
         margin-bottom: 15px;
      }

      .Footer .row .Explain .FooterLink {
         margin: 5px 0;
      }

      .Footer .row .Explain .FooterLink i {
         color: #30a1f1;
         font-size: 10px;
         transform: translate(-50%, -25%);
      }

      .Footer .row .Explain .FooterLink a {
         color: #000;
         font-size: 18px;
      }

      /* Animations */
      @keyframes bounce {
         0%,
         100% {
            transform: translateY(0%);
         }
         40%,
         60% {
            transform: translateY(50%);
         }
      }

      @keyframes Loadergrow {
         0%,
         100% {
            transform: scale(0);
            opacity: 0.3;
         }
         50% {
            transform: scale(1);
            opacity: 1;
         }
      }

      /* Responsive Design */
      @media (max-width: 1000px) {
         nav.navbar .nav-item.social {
            display: none !important;
         }
      }

      @media (max-width: 800px) {
         .collapse_menu.deactive .fa-bars {
            display: block;
         }
         .collapse_menu.active .fa-bars {
            display: none;
         }
         .collapse_menu.deactive .fa-times {
            display: none;
         }
         .collapse_menu.active .fa-times {
            display: block;
         }

         .collapse_menu.deactive ul.nav {
            background-color: #fff !important;
         }

         .collapse_menu.deactive ul.nav li a {
            color: #000 !important;
         }

         .collapse_menu.deactive .fa-bars {
            color: #fff !important;
         }

         .navbar .collapse_menu.deactive ul.nav {
            position: fixed;
            top: 60px;
            left: -55vw;
            width: 55vw;
            height: 100%;
            background: #ffff;
            border-right: 5px black;
            transition: all 1s;
         }

         .navbar .collapse_menu.active ul.nav {
            left: 0;
         }

         .navbar ul.nav li a {
            transition: all 0.5s;
            color: #000 !important;
         }
         .navbar ul.nav li {
            width: 100%;
            padding: 10px 20px;
            transition: all 0.5s;
         }

         .navbar ul.nav li:hover {
            background: #30a1f1;
         }

         .navbar ul.nav li:hover a {
            margin-left: 20px;
         }
         .navbar ul.nav .nav-item {
            display: block;
         }
      }

      @media (max-width: 600px) {
         .navbar {
            padding: 0 !important;
            height: 60px;
         }
         .content {
            padding: 0 !important;
         }
         .headerImg,
         .Dicover_Parent {
            display: none !important;
         }
      }

   </style>
   <body>
      <!-- Pre Loader -->
      <div class="Loader" id="Loader">
         <div class="LoaderWrapper">
            <div class="circleBall"></div>
            <div class="circleBall"></div>
            <div class="circleBall"></div>
         </div>
      </div>
      <!-- Go to top Button -->
      <a href="#Home">
         <div class="Gototop">
            <i class="fa fa-angle-double-up text-white" aria-hidden="true"></i>
         </div>
      </a>
      <!-- Header Section -->
      <div class="Header" id="Home">
         <nav class="navbar fixed-top">
            <div class="container d-flex align-items-center justify-content-between">
               <a class="navbar-brand d-flex align-items-center" href="#">
                  <img src="<?php echo base_url(); ?>assets/img/perusahaan.png" alt="Logo" style="height: 40px; margin-right: 10px;">
               </a>
               <div class="collapse_menu deactive">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                  <i class="fa fa-times" aria-hidden="true"></i>
                  <ul class="nav">
                     <li class="nav-item">
                        <a class="nav-link bold-link" href="<?php echo base_url('LoginController');?>">Login</a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <div class="banner text-white">
            <div class="layer">
               <div class="row Section">
                  <div class="col">
                     <div class="box">
                        <div>
                           <h2><strong>PT. MUTIARA JAWA<br> Penggajian Karyawan</h2></strong>
                        </div>
                        <p>Aplikasi ini dibuat untuk membantu perusahaan dalam proses penggajian karyawan</p>
                     </div>
                  </div>
                  <div class="col headerImg" style="background-image: url('<?php echo base_url()?>assets/landing/img/aset2.png');"></div>
               </div>
            </div>
         </div>
      </div>

      <!-- [Section lainnya tetap sama] -->

      <!-- Footer Section -->
      <div class="Footer" id="Footer">
         <div class="container">
            <div class="row">
               <div class="col-12 text-center my-3">
                  Copyright &copy; <strong>PT. MUTIARA JAWA</strong> | Aplikasi Penggajian 2025 - All Rights Reserved
               </div>
            </div>
         </div>
      </div>

      <!-- Javascripts -->
      <script src="<?php echo base_url(); ?>assets/landing/js/jquery.js"></script>
      <script src="<?php echo base_url(); ?>assets/landing/js/bootstrap.js"></script>
      <script src="<?php echo base_url(); ?>assets/landing/js/script.js"></script>
   </body>
</html>
