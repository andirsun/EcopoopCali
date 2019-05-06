<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sigere-Registro</title>
    <!-- Main css -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/registro.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
    <script>var base_url = '<?echo base_url(); ?>'</script>
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form id="formRegistrar" class="signup-form">
                        <h2 class="form-title"> Crear una cuenta</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Tu Nombre" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Tu Correo" requiered/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="pass" id="pass" placeholder="Contraseña" requiered/>
                        </div>
                        <select class="form-control mb-4" id="proyect">
                            <option>--Seleccione Proyecto--</option>
                            
                        </select>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Registrar"/>
                        </div>
                        
                    </form>
                    <p class="loginhere">
                       <a href="<?php echo base_url() ?>admin/nav/proyectos" class="loginhere-link">REGRESAR</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/registro.js"></script>
</body>
</html>