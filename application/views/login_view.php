<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="contenedor d-flex flex-column p-4 align-items-center">
        <div class="form text-center p-3 bg-secondary w-25 d-flex flex-column text-white align-items-center">
            <h1>Login!</h1>
            <?php $errores = $this->session->flashdata('errors'); ?>
            <?php if(isset($errores)){ ?>
              <?php foreach($errores as $error){ ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $error;?>
                </div>
              <?php  }?>
            <?php } ?>
            <form action="<?php echo site_url('auth/login');?>" method="post">
                <div class="mb-3  ">
                    <label for="usuario" class="form-label"> Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave">
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>