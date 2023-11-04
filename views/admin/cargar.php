<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php');
    ?>
    
    <?php
        include('../../componentes/headerAdmin.php');
    ?>

    <?php
        include('../../componentes/navBarAdmin.php');
    ?>

            <body>


                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="../../videos/fondo2.mp4" type="video/mp4">

                    </video>
                </div>
                <main>
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12 col-12">
                                <div class="row section-padding-2">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/animal.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarAnimal.php" title="carque el animal deseado">
                                                <h5 class="speakers-title mb-0">Animal</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/usuario.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarUsuario.php" title="cargue un nuevo usuario">
                                                <h5 class="speakers-title mb-0">Usuario</h5>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/noticia.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarNoticia.php" title="ingrese nueva noticia">
                                                <h5 class="speakers-title mb-0">Noticia</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/protectora.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarProtectora.php" title="ingrese una nueva protectora">
                                                <h5 class="speakers-title mb-0">Protectora</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/persona.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarPersona.php" title="ingrese una nueva persona">
                                                <h5 class="speakers-title mb-0">Persona</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/veterinaria.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarVeterinaria.php" title="ingrese una veterinaria">
                                                <h5 class="speakers-title mb-0">Veterinaria</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="speakers-thumb speakers-thumb-small">
                                            <img src="../../images/profesional.jpg" class="img-fluid speakers-image" alt="">

                                            <div class="speakers-info">
                                                <a href="cargarProfesional.php" title="cargar nuevo profesional">
                                                <h5 class="speakers-title mb-0">Profesional</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
               

        <?php
            include('../../componentes/footer.php');
        ?>
        
    </body>
</html>