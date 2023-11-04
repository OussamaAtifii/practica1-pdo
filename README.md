# CRUD Productos

Sistema de gestión de productos que proporciona operaciones básicas de CRUD (Crear, Leer, Actualizar, Eliminar)

## Instalación

1. **Clonar el Repositorio en la carpeta de tu servidor Web:**

    ```bash
    git clone https://github.com/OussamaAtifii/practica1-pdo.git
    ```

2. **Accede al directorio del proyecto:**

    ```bash
    cd practica1-pdo
    ```

3. **Instala las dependencias con Composer:**

    ```bash
    composer install
    ```

## Configuración

1. Copia el archivo .env.example y renómbralo a .env:

    ```bash
    cp .env.example .env
    ```

2. Abre el archivo .env con tu editor de texto preferido y configura las variables de entorno, incluyendo:

    - **USER**: Nombre de usuario de la base de datos.
    - **PASS**: Contraseña de la base de datos.
    - **DB**: Nombre de la base de datos.
    - **HOST**: Host de la base de datos.

Asegúrate de que estos valores coincidan con la configuración de tu entorno de desarrollo.

## Funcionalidades

- **Crear Producto:** Agregar nuevos productos a la base de datos con información detallada como nombre y precio.
- **Ver Productos:** Visualizar la lista completa de productos almacenados en la base de datos.
- **Actualizar Producto:** Modificar la información de un producto existente, como cambiar su nombre o ajustar el precio.
- **Eliminar Producto:** Eliminar productos seleccionados de la base de datos.