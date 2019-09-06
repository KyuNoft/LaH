<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('AP3/'); ?>assets/images/favicon.png">
    <title>Look at Hijab</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('AP3/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('AP3/'); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('AP3/'); ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/v4-shims.css">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url('AP3/'); ?>css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('AP3/'); ?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?php echo base_url('AP3/'); ?>https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('Beranda'); ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url('AP3/'); ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url('AP3/'); ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url('AP3/'); ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url('AP3/'); ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="<?php echo base_url('AP3/'); ?>javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>-->
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="user-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="user-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="user-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <!--<a href="<?php echo base_url('AP3/'); ?>#">
                                                <div class="user-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="<?php echo base_url('AP3/'); ?>javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <ul style="position: fixed; left: 10%; top: 2%; width: 80%">
                        <marquee width="100%" height="1%" direction="left" behavior="scrolling" scrollamount="10">
                            <p style="font-size: 150%; color: white;  font-style: oblique; font-weight: 500;">Selamat Datang di Bagian <?php echo $this->session->userdata('akses').""?></p>
                        </marquee>
                    </ul>
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <?php if($this->session->userdata('akses') == "Produksi"):?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('AP3/'); ?>assets/images/users/Produksi.jpg" alt="user" class="profile-pic" /></a>
                            <?php else: ?>
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('AP3/'); ?>assets/images/users/Penjualan.jpg" alt="user" class="profile-pic" /></a>
                            <?php endif; ?>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <?php if($this->session->userdata('akses') == "Produksi"):?>
                                            <div class="u-img"><img src="<?php echo base_url('AP3/'); ?>assets/images/users/Produksi.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Produksi</h4>
                                                <p class="text-muted">Produksi@gmail.com</p><!--<a href="<?php echo base_url('AP3/'); ?>pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>--></div>
                                                <?php else: ?>
                                            <div class="u-img"><img src="<?php echo base_url('AP3/'); ?>assets/images/users/Penjualan.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Penjualan</h4>
                                                <p class="text-muted">Penjualan@gmail.com</p><!--<a href="<?php echo base_url('AP3/'); ?>pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>--></div>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <!--<li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('AP3/'); ?>#"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="<?php echo base_url('AP3/'); ?>#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="<?php echo base_url('AP3/'); ?>#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('AP3/'); ?>#"><i class="ti-settings"></i> Account Setting</a></li>-->
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url(''); ?>Login/Logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <?php if($this->session->userdata('akses') == "Produksi"):?>
                        <div class="profile-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/Produksi.jpg" alt="user" />
                        <?php else: ?>
                            <div class="profile-img"> <img src="<?php echo base_url('AP3/'); ?>assets/images/users/Penjualan.jpg" alt="user" />
                            <?php endif; ?>
                        <!-- this is blinking heartbit-->
                        <!--<div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>-->
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>Markarn Doe</h5>
                        <a href="<?php echo base_url('AP3/'); ?>#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="<?php echo base_url('AP3/'); ?>app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                        <a href="<?php echo base_url('AP3/'); ?>pages-login.html" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="<?php echo base_url('AP3/'); ?>#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <!-- text-->
                            <a href="<?php echo base_url('AP3/'); ?>#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <!-- text-->
                            <a href="<?php echo base_url('AP3/'); ?>#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="<?php echo base_url('AP3/'); ?>#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="<?php echo base_url(''); ?>Login/Logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <?php if($this->session->userdata('akses') == "Produksi" OR $this->session->userdata('akses') == "Penjualan"):?>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">PERSONAL</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>#" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Master Data :<span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <?php if($this->session->userdata('akses') == "Penjualan"):?>
                                <li><a href="<?php echo base_url('Akun'); ?>">Akun</a></li>
                                <?php endif; ?>
                                <?php if($this->session->userdata('akses') == "Produksi"):?>
                                <li><a href="<?php echo base_url('BahanBaku'); ?>">Bahan Baku</a></li>
                                <li><a href="<?php echo base_url('Aktivitas'); ?>">Aktivitas</a></li>
                                <li><a href="<?php echo base_url('Mesin'); ?>">Mesin</a></li>
                                <li><a href="<?php echo base_url('Produk'); ?>">Produk</a></li>
                                <?php endif; ?>
                                <?php if($this->session->userdata('akses') == "Penjualan"):?>
                                <li><a href="<?php echo base_url('Pelanggan'); ?>">Pelanggan</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if($this->session->userdata('akses') == "Produksi"):?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Kebutuhan :</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url('BOM'); ?>">Bill of Material</a></li>
                                <li><a href="<?php echo base_url('Routing'); ?>">Routing</a></li>
                                <li><a href="<?php echo base_url('JamMesin'); ?>">Jam Mesin</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($this->session->userdata('akses') == "Penjualan"):?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="far fa-file-alt"></i><span class="hide-menu">Pemesanan :</span></a>
                            <ul aria-expanded="false" class="collapse" style="top: 100%">
                                <li><a href="<?php echo base_url('Pesanan/Tambah'); ?>">Tambah Pesanan</a></li>
                                <li><a href="<?php echo base_url('Pesanan'); ?>">Daftar Pesanan</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($this->session->userdata('akses') == "Produksi"):?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="far fa-calendar-alt"></i><span class="hide-menu">MPS :</span></a>
                            <ul aria-expanded="false" class="collapse" style="top: 100%">
                                <li><a href="<?php echo base_url('MPS'); ?>">Daftar Pesanan</a></li>
                                <li><a href="<?php echo base_url('MPS/Jadwal'); ?>">Jadwal Produksi</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-fax"></i><span class="hide-menu">MRP II :</span></a>
                            <ul aria-expanded="false" class="collapse" style="top: 100%">
                                <li><a href="<?php echo base_url('MRPII'); ?>">Tabel MRP II</a></li>
                                <li><a href="<?php echo base_url('MRPII/DaftarBiaya'); ?>">Daftar Biaya</a></li>
                                <li><a href="<?php echo base_url('MRPII/Hitung'); ?>">Hitung Biaya</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($this->session->userdata('akses') == "Penjualan"):?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('AP3/'); ?>#" aria-expanded="false"><i class="fas fa-book-open"></i><span class="hide-menu">Laporan :<span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse" style="top: 100%">
                                <li><a href="<?php echo base_url('Laporan/Jurnal'); ?>">Jurnal</a></li>
                                <li><a href="<?php echo base_url('Laporan/BukuBesar'); ?>">Buku Besar</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid"> II <p style="float: right;">II</p>

                <?php echo $contents; ?>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2019 Look at Hijab</footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url('AP3/'); ?>js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url('AP3/'); ?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url('AP3/'); ?>js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('AP3/'); ?>js/custom.min.js"></script>
    <script src="<?php echo base_url('AP3/'); ?>js/Mine.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url('AP3/'); ?>js/morris-data.js"></script>
    <!-- Chart JS -->
    <script src="<?php echo base_url('AP3/'); ?>js/dashboard1.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


    <!-- This is data table -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script src="<?php echo base_url('AP3/'); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

</body>
</html>