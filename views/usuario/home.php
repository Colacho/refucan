<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerUsuario.php');
            include('../../componentes/navbarUsuario.php');
        ?>
        <main>
            <!-- HOME  -->
            <section class="hero" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12 m-auto">
                            <div class="hero-text">

                                <h1 class="text-white mb-4">Bienvenid/a <u class="text-info"><medium><?php echo $saludo; ?></medium></u></h1>


                                <a href="#section_1" class="custom-link bi-arrow-down arrow-icon"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="../../videos/fondoUsuario.mp4" type="video/mp4">

                    </video>
                </div>
            </section> 


            <section class="highlight">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="../../images/highlight/alexandre-pellaes-6vAjp0pscX0-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2021 Highlights</h3>

                                    <a href="https://www.youtube.com/shorts/lTZqOxEYXrA" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="../../images/highlight/miguel-henriques--8atMWER8bI-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2022 Highlights</h3>

                                    <a href="https://www.youtube.com/shorts/lTZqOxEYXrA" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="../../images/highlight/jakob-dalbjorn-cuKJre3nyYc-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2023 Highlights</h3>

                                    <a href="https://www.youtube.com/shorts/lTZqOxEYXrA" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- No tendra un id ya que novedades te mandara a buscarNoticia.php-->

            <section class="schedule section-padding" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-5 text-center">Nuevas <u class="text-info">Noticias</u></h2>

                            <?php
                                $consultaNoticias = "SELECT * FROM noticias ORDER BY created_at DESC LIMIT 3";
                                $resultadoNoticias = mysqli_query($Sconexion, $consultaNoticias);

                                while($row = mysqli_fetch_assoc($resultadoNoticias)) {
                                    echo '
                                    <div class="tab-content mt-5" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel" aria-labelledby="nav-DayOne-tab">
                                        <div class="row border-bottom pb-5 mb-5">
                                            <div class="col-lg-4 col-12">
                                                <img src="../../fotos/noticias/'.$row['foto'].'" class="schedule-image img-fluid" alt="">
                                            </div>
    
                                            <div class="col-lg-8 col-12 mt-3 mt-lg-0">
                                                
                                                <h4 class="mb-2">'.$row['titulo'].'</h4>
    
                                                <p>'.$row['cuerpo'].'</p>
                    
                                                <span class="mx-3 mx-lg-5">
                                                    <i class="bi-clock me-2"></i>
                                                    '.$row['created_at'].'                                         
                                                </span>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                            
                        </div>

                    </div>
                </div>
            </section>


            <!-- Nosotros -->
            <section class="call-to-action section-padding" id="section_2">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-7 col-12">
                            <h2 class="text-white mb-4">Sobre <u class="text-info">Nosotros?</u></h2>

                            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut dolore</p>
                        </div>

                        <div class="col-lg-3 col-12 ms-lg-auto mt-4 mt-lg-0">
                            <a href="#section_3" class="custom-btn btn">Donate</a>
                        </div>

                    </div>
                </div>
            </section>

            <section class="venue section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-5">Donde nos <u class="text-info">Ubicamos</u></h2>
                        </div>

                        <div class="col-lg-6 col-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d756.4777505259603!2d-60.178356098062615!3d-33.37891830387036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b75e77b6312587%3A0x832238dce218af32!2sInstituto%20Superior%20de%20Formaci%C3%B3n%20T%C3%A9cnica%20N%C2%B038!5e0!3m2!1ses!2sar!4v1695244781532!5m2!1ses!2sar" width="550" height="410" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="venue-thumb bg-white shadow-lg">
                                
                                <div class="venue-info-title">
                                    <h2 class="text-white mb-0">San Nicolas de los Arroyos</h2>
                                </div>

                                <div class="venue-info-body">
                                    <h4 class="d-flex">
                                        <i class="bi-geo-alt me-2"></i> 
                                        <span>Av. Central Malvinas Argentinas 1825, B2900, ARG</span>
                                    </h4>

                                    <h5 class="mt-4 mb-3">
                                        <a href="mailto:hello@yourgmail.com">
                                            <i class="bi-envelope me-2"></i>
                                            info@example.com
                                        </a>
                                    </h5>

                                    <h5 class="mb-0">
                                        <a href="tel: 305-240-9671">
                                            <i class="bi-telephone me-2"></i>
                                            010-020-0340
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="contact section-padding" id="section_3">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <form class="custom-form contact-form bg-white shadow-lg" action="#" method="post" role="form">
                                <h2>Contactanos</h2>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required="">
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">         
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email" required="">
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Sujeto">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="Mensaje"></textarea>

                                        <button type="submit" class="form-control">Enviar</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>


        <!-- JAVASCRIPT FILES -->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.sticky.js"></script>
        <script src="../../js/click-scroll.js"></script>
        <script src="../../js/custom.js"></script>

       

        <?php
            include('../../componentes/footer.php');
        ?>
        
    </body>
</html>