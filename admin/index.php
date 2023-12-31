    <?php
    
require '../includes/app.php';
 estaAutenticado();
use App\Propiedad;
use App\Vendedor;

    // Llamar a la base de datos  
    // Implementar u método para obtner todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    debuguear($propiedades);
    $resultado = $_GET['resultado'] ?? null; // ?? placeholder = buscar este valor y si no existe le agrega null

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id){

            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
            // Eliminar el archivo
           
            
            // Eliminar la propiedad
            
          
        }
        
    }

 
    incluirTemplates('header');
    ?>


    <main class="contenedor seccion">
       
        <h1>Administrador de bienes raices</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Creado Correctamente</p>
            <?php elseif(intval($resultado) === 2): ?>
                <p class="alerta exito">Actualizado Correctamente</p>
                <?php elseif(intval($resultado) === 3): ?>
                <p class="alerta exito">Eliminado Correctamente</p>
            
            <?php endif; ?>
            <a href="../admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

            <table class="propiedades">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody> <!-- Mostrar resultados-->
                    <?php foreach($propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                        <td> $ <?php echo number_format($propiedad->precio); ?></td>
                        <td>
                            <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit"  class="boton-rojo-block " value="Eliminar">
                            </form>
                            
                            <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>"class="boton-amarillo-block" >Actualizar</a>
                        </td>
                    </tr>
                    
                    <?php endforeach; ?>


                </tbody>
                
            </table>
    </main>

    <?php  
   
    // Cerrar la Conexión
    mysqli_close($db);
    incluirTemplates('footer');
    ?>
    