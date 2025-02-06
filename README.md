# Guía para poner en marcha el proyecto

Sigue los pasos a continuación para clonar el repositorio, levantar los contenedores, y configurar el almacenamiento de logs:

---

### 1. Clonamos el repositorio
```bash
git clone git@github.com:10josemari/pruebaEvolmind.git
```

### 2. Levantamos contenedores (_desde la raíz del proyecto_)
```bash
docker-compose up -d
```

### 3. Crear y dar permisos a la carpeta de logs (_desde la raíz del proyecto_)
```bash
mkdir -p storage/log && chmod 777 -R storage/
```

### 4. Acceder vía web a la aplicación
```bash
http://localhost:8080/
```