# ENLDWESLoginLogoffTema5

## Descripción del Proyecto

Sistema completo de autenticación y control de acceso para aplicaciones web desarrollado en PHP. Este proyecto implementa un ciclo básico pero robusto de login/logoff con gestión de sesiones, autenticación contra base de datos y control de acceso a páginas protegidas.

El sistema proporciona una base sólida para cualquier aplicación web que requiera autenticación de usuarios, implementando las mejores prácticas de seguridad con PDO, prepared statements y gestión segura de sesiones PHP. Incluye control de acceso mediante verificación de sesión activa y registro automático de actividad de usuarios.

**Tecnologías principales:** PHP 8.3, MySQL/MariaDB, PDO, Apache, Sessions

## Requisitos Técnicos

- **Servidor Web:** Apache 2.4+
- **PHP:** 8.3 o superior
- **Base de Datos:** MySQL 8.0+ / MariaDB 10.5+
- **Motor de BD:** InnoDB
- **Entorno:** LAMP (Linux, Apache, MySQL, PHP)
- **Extensiones PHP requeridas:**
  - PDO
  - session (habilitada por defecto)
  - DateTime

## Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/EnriqueNieto90/ENLDWESLoginLogoffTema5.git
```

### 2. Configurar en servidor local
Copiar el proyecto al directorio de publicación de Apache:
```bash
cp -r ENLDWESLoginLogoffTema5 /var/www/html/httpdocs/
```

### 3. Configurar la base de datos
Ejecutar los scripts SQL en el siguiente orden:

**a) Crear base de datos y usuario:**
```bash
mysql -u adminsql -p < scriptDB/CreaDBENLDWESLoginLogoffTema5.sql
```

**b) Carga inicial de datos:**
```bash
mysql -u UserENLDWESLoginLogoffTema5 -p DBENLDWESLoginLogoffTema5 < scriptDB/CargaInicialDBENLDWESLoginLogoffTema5.sql
```

### 4. Configurar credenciales
Editar el archivo de configuración de base de datos:
```php
// config/confDB.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'DBENLDWESLoginLogoffTema5');
define('DB_USER', 'UserENLDWESLoginLogoffTema5');
define('DB_PASS', 'paso');
```

### 5. Configurar permisos
```bash
chmod -R 755 /var/www/html/httpdocs/ENLDWESLoginLogoffTema5
chmod -R 777 /var/www/html/httpdocs/ENLDWESLoginLogoffTema5/tmp
```

### 6. Acceder a la aplicación
Abrir navegador web y acceder a:
```
http://localhost/httpdocs/ENLDWESLoginLogoffTema5/index.php
```

## Estructura del Proyecto
```
ENLDWESLoginLogoffTema5/
├── index.php                   # Punto de entrada (redirige a login)
├── login.php                   # Formulario de autenticación
├── programa.php                # Página principal protegida
├── logoff.php                  # Cierre de sesión
├── .htaccess                   # Configuración Apache
├── /config/                    # Configuración de la aplicación
│   └── confDB.php              # Credenciales base de datos
├── /core/                      # Librerías y funciones
│   └── verificaSesion.php      # Verificación de sesión activa
├── /doc/                       # Documentación técnica
├── /error/                     # Páginas de error personalizadas
├── /webroot/                   # Recursos estáticos
│   └── /css/                   # Hojas de estilo
│       └── estilos.css         # Estilos de la aplicación
├── /scriptDB/                  # Scripts SQL
│   ├── CreaDBENLDWESLoginLogoffTema5.sql
│   ├── CargaInicialDBENLDWESLoginLogoffTema5.sql
│   └── BorraDBENLDWESLoginLogoffTema5.sql
└── /tmp/                       # Archivos temporales
```

## Modelo de Datos

### Tabla: T01_Usuario

| Campo | Tipo | Descripción |
|-------|------|-------------|
| **T01_CodUsuario** (PK) | VARCHAR(8) | Código de usuario (4-8 caracteres) |
| T01_Password | VARCHAR(255) | Contraseña (hash recomendado) |
| T01_DescUsuario | VARCHAR(255) | Nombre completo del usuario |
| T01_NumConexiones | INT | Contador de accesos al sistema |
| T01_FechaHoraUltimaConexion | DATETIME | Última conexión (automática) |
| T01_Perfil | VARCHAR(20) | Perfil del usuario ("usuario") |

### Credenciales de Base de Datos

- **Base de datos:** DBENLDWESLoginLogoffTema5
- **Usuario aplicación:** userENLDWESLoginLogoffTema5
- **Contraseña:** paso
- **Usuario administrador:** adminsql / paso

## Flujo de la Aplicación

### 1. Punto de Entrada (index.php)
- Redirige automáticamente a login.php
- Punto único de acceso a la aplicación

### 2. Página de Login (login.php)
**Funcionalidades:**
- Formulario de autenticación con campos usuario/password
- Validación de campos obligatorios
- Verificación de credenciales contra base de datos
- Uso de prepared statements para seguridad
- Creación de sesión PHP al autenticar correctamente
- Almacenamiento de datos de usuario en `$_SESSION`:

### 3. Página Principal (programa.php)
**Funcionalidades:**
- Verificación de sesión activa al cargar la página
- Redirección automática a login.php si no hay sesión
- Bienvenida personalizada con nombre del usuario
- Botón "Salir" que redirige a logoff.php
- Contenido protegido accesible solo para usuarios autenticados

### 4. Cierre de Sesión (logoff.php)
**Funcionalidades:**
- Destrucción completa de la sesión con `session_destroy()`
- Limpieza del array `$_SESSION`
- Eliminación de la cookie de sesión del navegador

## URLs de Acceso

### Aplicación en Producción
```
https://enriquenielor.ieslossauces.es/ENLDWESLoginLogoffTema5/
```

### Páginas principales
```
https://enriquenielor.ieslossauces.es/ENLDWESLoginLogoffTema5/index.php
```

## Características Destacadas

- **Ciclo completo de autenticación:** Implementación profesional del flujo login → programa → logoff
- **Gestión robusta de sesiones:** Control total del ciclo de vida de sesiones PHP
- **Seguridad SQL Injection:** Todas las consultas usan prepared statements con PDO
- **Control de acceso:** Verificación de sesión activa en páginas protegidas

## Autor

**Enrique Nieto Lorenzo**

Estudiante de DAW2 (Desarrollo de Aplicaciones Web)  
IES Los Sauces - Curso 2025/2026  
Módulo: DWES (Desarrollo Web en Entorno Servidor)

GitHub: EnriqueNieto90  
Repositorio: ENLDWESLoginLogoffTema5
```
