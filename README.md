Proyecto de aprendizaje
---

Clase 1: Creación de modelos, migraciones y factories en Laravel
--
Resumen

**Los modelos** son representacion de tablas en php
**Migraciones** son la estructura de una tabla escrita en php
**Factories**  es una estructura que se utiliza para crear datos falsos

Estos 3 archivos son los que inician el proyecto, modelo para la manipulacion, migracion para la base, factorie para los primeros datos de prueba. *Para crear la estructura por primera vez podemos correr el sigiente comando en cosola*

```
    php artisan make:model ModelName -mf
```

**La consola de Laravel** trae muchos comandos para distintas herramientas, es muy potente, basicamente puedes crear todos los ficheros del proyecto usandola. Me queda como tarea ejecutar el siguiente comando para observar lo que tiene:

```
    php artisan //para obtener todos los tools 
    php artisan <tool> --help // para obtener las herramientas que incluyen al tool
    php artisan make:model ModelName -mf // existen herramientas que pueden correrse al mismo tiempo
```

Cabe destacar que en la convencionalidad de php se deben crear los modelos en singular, pero la estructura de las migraciones seran en plural.

Estructura del proyecto:
tenemos como tablas a:
- usuarios (users)
- preguntas (questions)
- respuestas (answers)
- categorias (categories)
- comentarios (comments)
- corazones (hearts)
- publicaciones (blogs)
las relaciones entre cada una

el esquema es: 
los usuarios hacen comentarios y preguntas (usuarios como dato relacion entre ambos), 
Las preguntas tienen respuestas y son comentarios, 
las respuestas son hechas para las preguntas (relacion directa a la pregunta) y son comentarios, 
los comentarios tienen categorias (preguntas y respuestas),
- corazones los corazones son para los comentarios, preguntas y respuestas,
- las publicaciones tienen comentarios y pertenecen a una categoria, 