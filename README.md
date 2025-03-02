# Formatrack - API REST

![PHP](https://img.shields.io/badge/PHP-8.0-blue)
![REST API](https://img.shields.io/badge/REST-API-green)

Formatrack es una API REST desarrollada en PHP como parte del proyecto formativo del SENA para el tecnólogo en Análisis y Desarrollo de Software (ADSO), ficha 2900810. Este proyecto tiene como objetivo proporcionar una plataforma eficiente para la administración de inventario dentro de la institución.

## 📌 Integrantes

- **Estefany Daniela Parada Escalante**
- **Luis Miguel Giron Orozco**
- **Yurgen Esneider Perdomo Vargas**

## 🚀 Tecnologías Utilizadas

- PHP 8.0+
- Composer
- MySQL / PostgreSQL
- JSON Web Tokens (JWT) para autenticación
- Postman para pruebas

## 📂 Estructura del Proyecto

```
formatrackAPI/
│── Config/
│   ├── database.php
│── Controllers/
│── Models/
│── .htaccess
│── index.php
```

## 🛠 Instalación y Configuración

### 1️⃣ Clonar el Repositorio
```bash
git clone https://github.com/estefany-123/PHPRestAPI.git
cd PHPRestAPI
```

### 2️⃣ Instalar Dependencias
```bash
composer install
```

### 3️⃣ Iniciar el Servidor
Si estás utilizando Apache, la API estará disponible en el puerto 80.

## 🔒 Autenticación
Para acceder a ciertos endpoints, se requiere autenticación con JWT. 
Para obtener un token, usa el siguiente endpoint:
```http
POST /login
```
Con los datos:
```json
{
  "correo": "usuario@example.com",
  "password": "contraseña"
}
```
El token recibido debe enviarse en las siguientes peticiones dentro del header:
```http
Authorization: Bearer <token>
```

## 📝 Contribuciones
Las contribuciones son bienvenidas. Si deseas colaborar, sigue estos pasos:
1. Realiza un fork del repositorio
2. Crea una nueva rama (`git checkout -b feature/nueva-feature`)
3. Realiza tus cambios y haz commit (`git commit -m 'Añadir nueva feature'`)
4. Sube los cambios (`git push origin feature/nueva-feature`)
5. Crea un Pull Request

## 🏅 Créditos
Desarrollado por los aprendices del SENA Ficha 2900810, en el marco del tecnólogo en Análisis y Desarrollo de Software (ADSO).

---
© 2025 Formatrack. Todos los derechos reservados.
