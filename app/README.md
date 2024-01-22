<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Base de Datos

El sistema cuenta con las siguientes entidades:

### Roles
Definen los roles en el sistema.

### Empresas
Entidad que representa a las empresas.

### Usuarios
Representan a los usuarios del sistema.

### Empleados
Asociados a un usuario y vinculados a un horario.

### Horarios
Asociados a una empresa.

### Asistencias
Siempre asociadas a un empleado.

### Justificantes
Siempre asociados a un empleado.

## Comando para migrar la base de datos seteada desde cero 
```bash
php artisan migrate
```

## Se crearon 3 seeders para la importacion de datos por default
```
php artisan make:seeder UsersTableSeeder
php artisan make:seeder CompaniesTableSeeder
php artisan make:seeder RolesTableSeeder
```

