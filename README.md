<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🧪 Product API - Laravel 10

API RESTful para la gestión de productos y usuarios, con autenticación, roles (`admin`, `user`) y autorización basada en permisos. Desarrollado en Laravel 10.
## 🚀 Url de despliegue: https://inventario-api.fly.dev
---

## 🚀 Tecnologías utilizadas

- Laravel 10
- PHP 8.2
- Sqlite
- Laravel Sanctum (autenticación)
- Docker + Fly.io (para despliegue)

---

## 📦 Requisitos

Antes de empezar, asegúrate de tener instalado:

- PHP >= 8.2
- Composer

---

## ⚙️ Instalación del proyecto
```bash
# Clonar el repositorio
git clone https://github.com/RyuKanth22/product_api.git
cd product_api

# Instalar dependencias PHP
composer install

# Copiar el archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Levantar servidor local
php artisan serve
```

## 🔐 Autenticación y Roles
Este proyecto utiliza Laravel Sanctum para autenticación por token y define dos roles:

admin: puede crear, actualizar, eliminar productos y categorias, ademas de registrar usuarios.

user: solo puede registrarse, iniciar/cerrar sesión y ver productos.


## 📁 Arquitectura del proyecto
```bash
app/
├── Http/       <- Capa de presentación  (Controllers, Requests)
├── Models/     <- Capa de dominio (Modelos de datos)
├── Services/   <- Capa de lógica de negocio
```


## 📚 Endpoints principales
 🔑 Autenticación
```bash
Método      Ruta                Descripción	                
POST        /api/register       Registrar nuevo usuario	    
POST        /api/login          Iniciar sesión	            
POST        /api/logout         Cerrar sesión	            
```
## 📦 Productos
```bash
Método	     Ruta                   Descripción                         Rol
GET         /api/products           Listar productos                    Público
GET         /api/products/{id}      Ver detalle de un producto          Público
POST        /api/products           Crear nuevo producto                Admin
PUT         /api/products/{id}      Actualizar producto existente       Admin
DELETE      /api/products/{id}      Eliminar producto                   Admin
```

## 🛠 Migraciones y seeders incluidos
```bash
Users: 2 usuarios
admin@admin.com
user@user.com
ambos con contraseña: password

Categorias: 10 categorias de ejemplo

Products: 10 productos de ejemplo
```

## 🧠 Decisiones de diseño
# Elección de enum vs tabla de roles

Se optó por una tabla de roles utilizando el paquete Spatie Laravel-Permission. Esta decisión permite una mayor flexibilidad, escalabilidad y control granular de permisos. A diferencia de los enum, una tabla facilita:

🔸 Relacionar dinámicamente roles con usuarios.

🔸 Agregar o editar roles sin modificar código fuente.

🔸 Consultas más potentes y mantenibles desde la base de datos.


## 🧠 Middleware o paquete de autorización
Se usó el middleware que proporciona Spatie, específicamente las directivas role. Esta opción permite aplicar restricciones de acceso tanto a nivel de rutas como de controladores de forma clara y expresiva.


## 🧠 Cambios al esquema de base de datos
Se realizaron modificaciones al esquema de base de datos para integrar el sistema de roles basado en el paquete Spatie Laravel-Permission:

Se eliminó la columna role del tipo ENUM previamente presente en la tabla users.

En su lugar, se utilizó la relación proporcionada por Spatie, lo que permite asignar uno o varios roles a los usuarios de forma dinámica y escalable.

Adicionalmente, Spatie añadió automáticamente las siguientes tablas necesarias para gestionar roles y permisos:

roles

permissions

model_has_roles

model_has_permissions

role_has_permissions

Estas tablas permiten desacoplar la lógica de roles del modelo User, mejorar la mantenibilidad y facilitar futuras ampliaciones (como permisos específicos por productos).

## 🧠 Importación y uso de API (Postman)
Para hacer uso de la API en Postman se debe importar el archivo API_Collection.json ubicado en la carpeta raíz del proyecto. Este archivo contiene todas las peticiones organizadas por carpetas para facilitar su ejecución.

## ⚙️ Configuración del Environment en Postman
Antes de ejecutar las peticiones, es necesario crear un Environment en Postman con las siguientes variables:

🔸 tenant: Define la URL base de la API.
Valor: inventario-api.fly.dev

🔸 token: Contiene el token de autenticación necesario para acceder a los endpoints protegidos.
Valor: (se llena automáticamente después del login)

## 🔐 Autenticación
Antes de poder consumir los endpoints protegidos, es necesario autenticarse. Las rutas de autenticación disponibles son:

Iniciar sesión
Permite autenticarse con credenciales válidas y obtener un token.

Cerrar sesión
Invalida el token de sesión actual.

Registrar nuevo usuario
Permite crear una nueva cuenta de usuario (debe haber iniciado sesión)

## 📦 Uso de la API
La API está organizada en los siguientes grupos de recursos:

## 📁 Categorías
CRUD para la administración de categorías de productos:

🔸 GET /api/categories
Lista todas las categorías disponibles.

🔸 GET /api/categories/{id}
Muestra los detalles de una categoría específica.

🔸 POST /api/categories
Crea una nueva categoría.
Payload:

bash
{
  "name": "category_1",
  "description": "Description_1"
}


🔸 PUT /api/categories/{id}
Actualiza una categoría existente.
Payload:
bash
{
  "name": "category_2",
  "description": "Description_2"
}


🔸 DELETE /api/categories/{id}
Elimina una categoría por su ID.

## 📦 Productos
CRUD para la administración de productos:

🔸 GET /api/products
Lista todos los productos disponibles.

🔸 GET /api/products/{id}
Muestra los detalles de un producto específico.

🔸 POST /api/products
Crea un nuevo producto.
Payload:

bash
{
  "name": "Test_1",
  "description": "Description test_1",
  "price": 399,
  "stock": 20
  "category_id": 1 (debe existir el registro)
}


🔸 PUT /api/products/{id}
Actualiza un producto existente.
Payload:
bash
{
  "name": "Test_2",
  "description": "Description test_2",
  "price": 30,
  "stock": 1
  "category_id": 1 (debe existir el registro)
}


🔸 DELETE /api/products/{id}
Elimina un producto por su ID.