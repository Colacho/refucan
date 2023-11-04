<nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="../views/admin/home.php" class="navbar-brand mx-auto mx-lg-0">
                    <img class="logo" src="../../images/logo.jpg"/>
                    <span>Refucan</span>
                </a>


                <form action="../../src/logout.php" method="POST">
                
                    <button type="submit" name="logout" class="nav-link custom-btn btn d-lg-none">Log Out</button>
                </form>
                


                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="home.php#volver">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="cargar.php">Cargar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="buscar.php">Buscar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="home.php#section_1">Novedades</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="home.php#section_2">Nosotros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="home.php#section_3">Contacto</a>
                        </li>


                        <li class="nav-item">

                            <form action="../../src/logout.php" method="POST">
                                <button type="submit" name="logout" class="nav-link custom-btn btn d-none d-lg-block">Log Out</button>
                            </form>
                            
                        </li>
                    </ul>
                <div>
                        
            </div>
        </nav>