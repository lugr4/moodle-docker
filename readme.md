# 🚀 Moodle en Docker - Estructura del Proyecto
Este repositorio contiene la configuración necesaria para ejecutar **Moodle en Docker** con **Apache, PHP y MySQL**. 

## 📂 **Estructura del Proyecto**
La estructura del proyecto está organizada de la siguiente manera:

moodle-docker/ 
    │── apache/ # Configuración de Apache 
    │   │ 
    │   ├── conf/ # Archivos de configuración (httpd.conf) 
    │ 
    │── application/ # Carpeta principal de Moodle y sus datos 
    │   │ 
    │   ├── moodle/ # Código fuente de Moodle │ 
    │   ├── moodledata/ # Archivos generados por Moodle (NO se sube a Git) 
    │   ├── ssl/ # Certificados SSL (si se usa HTTPS) 
    │   ├── mysql_data/ # Datos de la base de datos MySQL (NO se sube a Git) 
    │
    │── logs/ # Logs generados por los contenedores (NO se sube a Git) 
    │── docker-compose.yml # Archivo principal para configurar y ejecutar los contenedores 
    │── Dockerfile.php # Dockerfile personalizado para el servicio PHP 
    │── entrypoint.sh # Script de inicialización del contenedor PHP 
    │── php.ini # Configuración de PHP 
    │── .gitignore # Archivos y carpetas excluidos del repositorio │── README.md # Documentación del proyecto.


---
## 🛠 **Descripción de cada Carpeta y Archivo**
### 🔹 **1. `apache/`**
Contiene la configuración de Apache.  
- **`conf/httpd.conf`** → Archivo de configuración principal de Apache.  
- **`ssl/`** → Carpeta donde se almacenan los certificados SSL si se usa HTTPS.  

### 🔹 **2. `application/`**
Es el directorio donde se almacenan Moodle, su caché y la base de datos.  
- **`moodle/`** → Código fuente de Moodle.  
- **`moodledata/`** → Carpeta donde Moodle almacena archivos subidos por usuarios.  
- **`mysql_data/`** → Archivos internos de la base de datos MySQL.  

⚠️ **IMPORTANTE:** `moodledata/` y `mysql_data/` **NO deben subirse a Git**.

### 🔹 **3. `logs/`**
Aquí se almacenan los registros generados por los contenedores **Apache, PHP y MySQL**.

### 🔹 **4. `docker-compose.yml`**
Archivo clave que define **cómo se deben ejecutar los contenedores**.  
Contiene la configuración para los servicios de:
- `apache` (servidor web).
- `php` (interprete de PHP con Moodle).
- `mysql` (base de datos MySQL para Moodle).
- `phpmyadmin` (opcional, para administrar la base de datos gráficamente).

### 🔹 **5. `Dockerfile.php`**
Define la imagen personalizada para el servicio PHP, agregando **extensiones necesarias para Moodle**.

### 🔹 **6. `entrypoint.sh`**
Este script **se ejecuta cuando inicia el contenedor PHP** y se encarga de:
- Configurar Moodle.
- Ajustar permisos.
- Ejecutar tareas necesarias antes de iniciar PHP-FPM.

### 🔹 **7. `php.ini`**
Archivo de configuración de PHP con ajustes específicos para Moodle.

### 🔹 **8. `.gitignore`**
Lista de archivos y carpetas que **NO deben subirse a Git**, como:
- `moodledata/`
- `mysql_data/`
- `logs/`
- `certificados SSL`
- Archivos del sistema (`.DS_Store`, `Thumbs.db`)

---

## 🚀 **Cómo Usar Este Proyecto**
### 🔹 **1. Clonar el Repositorio**
```sh
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio

🔹 2. Construir y Ejecutar los Contenedores
    docker-compose up -d
    
🔹 3. Acceder a Moodle
    Abre en tu navegador:
🌐 Moodle: http://localhost
🔧 phpMyAdmin (opcional): http://localhost:8080

🔹 4. Detener los Contenedores
    docker-compose down


🎯 Notas Finales
    Este entorno está diseñado para desarrollo, no producción.
    Puedes personalizar php.ini y httpd.conf según sea necesario.
    Si necesitas reiniciar la base de datos, elimina mysql_data/ antes de levantar los contenedores nuevamente.