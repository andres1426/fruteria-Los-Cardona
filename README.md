#  Frutería Los Cardona 

> **Sistema web desarrollado en PHP y MySQL para la gestión eficiente de productos, tipos de productos e inventario básico de una frutería.**

---

##  Tabla de Contenido

* [Descripción del Proyecto](#-descripción-del-proyecto)
* [Características Principales](#-características-principales)
* [Estructura del Proyecto](#-estructura-del-proyecto)
* [Tecnologías Utilizadas](#-tecnologías-utilizadas)
* [Autor](#-autor)
* [Licencia](#-licencia)

---

##  Descripción del Proyecto

**Frutería Los Cardona** es un sistema web diseñado para la administración interna de una frutería. Permite a los usuarios gestionar de manera sencilla el catálogo de productos, categorizarlos por tipo y llevar un **inventario básico**. El proyecto está desarrollado utilizando **PHP nativo** y **MySQL** como base de datos.

El sistema permite administrar las siguientes entidades:
* **Productos** (con relación a su tipo).
* **Tipos de Productos** (categorías).
* **Sesiones de Usuario** (autenticación y permisos).

---

##  Características Principales

###  Autenticación
* Inicio de sesión.
* Cierre de sesión.
* Validación de sesión mediante el archivo `session.php`.

###  Gestión de Productos (CRUD)
* Listar todos los productos.
* Agregar nuevos productos.
* Editar la información de productos existentes.
* Eliminar productos.
* Relación obligatoria con un **Tipo de Producto**.

###  Gestión de Tipos de Productos
Permite clasificar los productos según categorías estandarizadas en la frutería, incluyendo:
* Ácidas
* Semiácidas
* Dulces
* Neutras
* Secas

###  Interfaz
* Estructura modular con `header.php` y `footer.php`.
* Estilos centralizados en `assets/css/styles.css`.

---

##  Estructura del Proyecto

El proyecto sigue una arquitectura que separa la **lógica** de las **vistas**, promoviendo un código más limpio y modular:

### 1. Módulos de Acceso y Vistas (\`public/\`)
Contiene los archivos principales a los que el usuario accede para ver la interfaz y el contenido.
* `/public/login.php`: Formulario de inicio de sesión.
* `/public/dashboard.php`: Panel de administración principal.
* `/public/productos.php`: Vista de listado y gestión de productos (READ).
* `/public/tipo_prod.php`: Vista de listado y gestión de tipos de productos.
* `/public/index.php`: Redirección a `/public/login.php`.
* `/assets/css/styles.css`: Archivos de estilos.

### 2. Módulos de Autenticación y Gestión (\`actions/\`)
Contiene la lógica de negocio, procesamiento de formularios y operaciones CRUD, con enfoque en la seguridad (ej. Tokens CSRF).
* `/actions/auth.php`: Procesa el login y crea la sesión.
* `/actions/logout.php`: Cierra la sesión de forma segura.
* `/actions/session.php`: Verifica la validez de la sesión en cada página.
* `/actions/save_product.php`: Lógica de **CREATE** (insertar nuevo producto).
* `/actions/edit_product.php`: Lógica de **UPDATE** (actualizar producto existente).
* `/actions/delete_product.php`: Lógica de **DELETE** (eliminar producto).
* `/actions/tipos.php`: Lógica CRUD para la tabla auxiliar de tipos de productos.

### 3. Archivos de Configuración (\`includes/\`)
Contiene archivos de configuración vitales para la aplicación y elementos reutilizables de la interfaz.
* `/includes/db.php`: Conexión segura a MySQL utilizando **PDO**.
* `/includes/config.php`: (Recomendado) Para constantes globales y variables de configuración.
* `/includes/header.php`: Encabezado y navegación de la aplicación.
* `/includes/footer.php`: Pie de página.

##  Tecnologías Utilizadas

* **Backend:** **PHP 8+**
* **Base de Datos:** **MySQL**
* **Frontend:** HTML5, CSS3
* **Servidor Local:** **Apache** (Recomendado XAMPP)
* **Control de Versiones:** **GitHub**

---


## 👤 Autor

* **Andrés Felipe Cardona Torres**
* **Ficha: 3197814**
---

## ⚖️ Licencia

Este proyecto está disponible para **uso académico y educativo**.
