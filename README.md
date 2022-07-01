# lunches-project
Proyecto de almuerzos para prueba técnica Allegra

## Pasos para la configuración del proyecto

1. Configurar los contenedores
```
docker-compose up -d
```
2. Instalar dependencias del backend
```
cd lunches-api
composer install --ignore-platform-reqs
```
3. Generar llave de la aplicación
```
cd lunches-api
php artisan key:generate
```
4. Realizar la migración de la base de datos
```
php artisan migrate:fresh
```
5. Ingresar los datos de prueba (seeders)
```
php artisan db:seed
```

## Funcionamiento del frontend

Ya teniendo configurado el proyecto y sus contenedores, procedemos a ingresar al frontend para ejecutar las operaciones indicadas en la prueba. El link configurado es:
```
http://localhost:9000/
```
Ahí podrá ver la pantalla dividida en los siguientes apartados:

1. **_Menú_**. Aquí podrá ver el listado de los platos del menú y haciendo click en el botón ver en la columna **Ingredientes**, podrá ver el listado de los ingredientes de ese plato y sus respectivas cantidades. En este apartado tiene el botón **Solicitar plato** con el que pedirá a la cocina la preparación del dicho plato y dependiendo de las cantidades en inventario se preparará o no.

2. **_Órdenes a cocina_**. Es el listado de los platos pedidos a la cocina. Se podrá observar el ID del pedido, el nombre del plato y el estado de dicha solicitud. Si la solicitud está en estado **pending** quiere decir que hacen falta ingredientes de preparación. Tiene el botón de **Reprocesar órdenes** que sirve para volver a mandar la solicitud a la cocina y tratar de preparar el plato buscando nuevas existencias de ingredientes.

3. **_Órdenes de compra_**. Contiene el listado de las órdenes que se han solicitado para la compra de ingredientes en el mercado. Los campos que aquí se ven son: Id, Ingrediente, Cantidad solicitada para la compra y el estado de la compra. El botón que tiene es para comprar en el mercado, descontando del inventario del mercado y sumándolo al inventario del restaurante.

4. **_Inventario bodega_**. Es el listado de los ingredientes y sus cantidades que están en la bodega del restaurante. Aquí, con el botón **Solicitar ingredientes** se elabora una orden de compra en requerimiento para que luego sea procesada con el botón de este apartado para hacer la respectiva compra. En dicho listado podemos ver el ingrediente y la cantidad que hay en existencias.

5. **_Inventario mercado_**. Son los ingredientes y sus cantidades en la bodega del mercado. Aquí se pueden actualizar estas cantidades, utilizando el botón **Renovar inventario**, este le sumará 10 artículos a cada ingrediente para tener existencias para vender.

### ¿Cómo funciona y cuál es la dinámica del frontend?

Inicialmente se hace la solicitud del plato, si hay existencias se toman del inventario descontando cantidades, sino se genera un listado de ingredientes pendientes para compra. Si queremos solicitar ingredientes vamos al apartado de **Inventario bodega** y hacer click en el botón **Solicitar ingredientes**, este botón generará una orden de compra en estado **_requested_** para que luego, con el botón de **Comprar en mercado** se restará del inventario del mercado y se agregará al de la bodega del restaurante. Ya teniendo nuevamente existencias en bodega, se puede hacer un click en el botón **Reprocesar órdenes** para que se preparen los platos que estaban pendientes por ingredientes y dejar esta solicitud en estado **_completed_**

