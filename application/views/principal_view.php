<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="contenedor p-4 mt-4 d-flex flex-column align-items-center">
      <div class="d-flex justify-content-end w-50">
        <a href="<?php echo site_url('auth/salir')?>" class="text-white btn btn-close" type="button"></a>
      </div>
      <div class="tabla p-3 mt-4 w-50 d-flex flex-column align-items-center">
        <h1>Tabla de Productos</h1>
        <?php $errores = $this->session->flashdata('errors'); ?>
        <?php if(isset($errores)){ ?>
          <?php foreach($errores as $error){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $error;?>
            </div>
          <?php  }?>
        <?php } ?>
        <table class="table">
          <thead  class="table-success">
            <tr>
              <th scope="col">Producto</th>
              <th scope="col">Precio</th>
              <th scope="col">Cantidad en Stock</th>
              <th scope="col">Accion</th>
              <a href="" type="button"></a>
            </tr>
          </thead>
          <tbody  class="table-dark" >
            <?php if(!empty($productos)){ ?>
              <?php foreach($productos as $producto){ ?>
                <tr>
                  <td><?php echo $producto['nombre_producto'];?></td>
                  <td><?php echo $producto['precio'];?></td>
                  <td>
                    <?php echo $producto['cantidad'];?>
                    <a class="text-white text-decoration-none p-3" href="<?php echo site_url('principal/agregar_cantidad/'.$producto['id_producto'])?>">+</a>|
                    <a class="text-white text-decoration-none p-3" href="<?php echo site_url('principal/quitar_cantidad/'.$producto['id_producto'])?>">-</a>
                  </td>
                  <td>
                    <a href="<?php echo site_url('principal/eliminar/'.$producto['id_producto'])?>" class="text-white">Eliminar </a>|
                    <a href="<?php echo site_url('principal/botonagregar')?>" class="text-white"> Agregar </a>|
                    <a href="<?php echo site_url('principal/botoneditar/'.$producto['id_producto'])?>" class="text-white"> Editar </a>
                  </td>
                </tr>
              <?php }?>
            <?php } ?>
          </tbody>
        </table>
        <?php $mensaje=$this->session->flashdata('mensaje'); ?>
        <?php if(!empty($mensaje)) {?>
          <div class="alert alert-success" role="alert">
            <?php echo $mensaje;?>
          </div>
        <?php }?>
      </div>
        <?php $activo = $this->session->flashdata('activo'); ?>
        <?php if(!empty($activo)){?>
          <div class=" p-3 mt-4 w-50 d-flex flex-column align-items-center text-center">
            <h3>Ingrese un Nuevo Producto</h3>
            <form action="<?php echo site_url('principal/agregar_nuevo')?>" method="post">
              <div class="mb-3  ">
                <label for="nombre" class="form-label"> Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
              </div>
              <div class="mb-3  ">
                <label for="precio" class="form-label"> Precio</label>
                <input type="text" class="form-control" id="precio" name="precio">
              </div>
              <div class="mb-3  ">
                <label for="cantidad" class="form-label"> Cantidad</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad">
              </div>
              <button type="submit" class="btn btn-primary">Cargar</button>
            </form>
          </div>
        <?php } ?>
        <?php 
          $activoE = $this->session->flashdata('activoEditar');
          $id = $this->session->userdata('id_producto'); 
          $producto = $this->session->userdata('nombre_producto');
          $precio = $this->session->userdata('precio');
          $cantidad = $this->session->userdata('cantidad');
        ?>
        <?php if(!empty($activoE)){?>
          <div class=" p-3 mt-4 w-50 d-flex flex-column align-items-center text-center">
            <h3>Modifique el Producto</h3>
            <form action="<?php echo site_url('principal/modificar/'.$id)?>" method="post">
              <div class="mb-3  ">
                <label for="nombre" class="form-label"> Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto; ?>">
              </div>
              <div class="mb-3  ">
                <label for="precio" class="form-label"> Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>">
              </div>
              <div class="mb-3  ">
                <label for="cantidad" class="form-label"> Cantidad</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
          </div>
      <?php } ?>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>