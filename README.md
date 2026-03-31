# Sistema de Pedidos

Sistema web para gestionar pedidos de productos con dos niveles de usuario: Administrador y Usuario.

## 🚀 Características

### Para Administradores:

- Dashboard con estadísticas
- Gestión completa de productos (CRUD)
- Gestión de pedidos con estados
- Vista de usuarios registrados
- Productos más vendidos

### Para Usuarios:

- Catálogo de productos con búsqueda
- Carrito de compras
- Realizar pedidos
- Historial de pedidos
- Seguimiento de estado de pedidos

## 🛠️ Tecnologías

- Laravel 11
- PHP 8.2+
- MySQL
- Bootstrap 5
- Vite
- Docker 🐳

## 📋 Requisitos

- Docker
- Docker Compose

---

## 🐳 Ejecución con Docker

Para facilitar la instalación y ejecución del proyecto, se ha configurado Docker.

### 🔧 Levantar el proyecto

```bash
docker-compose up -d --build
```
Este comando:
	•	Construye las imágenes necesarias
	•	Levanta todos los contenedores (Laravel, MySQL, Nginx, Node)
	•	Ejecuta el proyecto en segundo plano

### 🧹 Reiniciar completamente el entorno
```bash
docker-compose down -v
```
Este comando:
	•	Detiene todos los contenedores
	•	Elimina volúmenes (incluyendo la base de datos)
	•	Limpia completamente el entorno

## 🔄 Flujo recomendado
```bash
docker-compose down -v
docker-compose up -d --build
```
Esto asegura un entorno limpio y actualizado cada vez que ejecutes el proyecto.

## 🌐 Acceso
```
http://localhost:8000
```

Este proyecto es de código abierto.