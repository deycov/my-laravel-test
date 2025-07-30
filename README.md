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

Clase 2: Creación de datos falsos para pruebas con factories y seeders
--

**Los factories** son fragmentos de codigo, los cuales estan dise;ados para generar datos de prueba en la BD, basicamente genera la estructura random que se debe generar en el
**Seeder** es una estructura que se encarga de generar el codigo random usando como base lo escrito en el factorie.

*ejemplo basico*
```
// en el factorie de users tendremos una funcion
public function definition(): array
{
    return [
        // se definen todos los campos de la tabla  "users" con datos faque usando 
        // las herramientas de la libreria fake de laravel
        // fake tiene muchas formas de crear informacion de prueba, es cuestion de ver que usar
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => static::$password ??= Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
}
```

para hacer uso del factory en el seed:

```
//el llenado se hace instanciando la clase del modelo que se deba rellenar
use App\Models\User; // esta es la clase que permite el llenado


//encontraremos esta funcion que se encarga de correr el llenado en los modelos (database) 
public function run(): void
{
    // User::factory(10)->create(); se usa este metodo en el que su parametro solicita un valor numerico
    // para procesar esa cantidad de veces la creacion de los datos

    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
}
 ```

 ```
    // y por ultimo... usando el flag 
    php artisan migrate:refresh --seed
    // se crea la migracion del proyecto nuevamente con los datos
 ```

Datos adicionales del uso de los seeders y factories

```
// para agregar ids foraneos
// ejmplo con el Idfk de usuarios en cualquier tabla
    public function run(): void
    {
        //se debe declarar en el seeder directamente de la siguiente forma
        $categories = User::inRandomOrder()->first()->id;
        // de esta forma obtendras el ID al menos con una forma para realizar pruebas
    }
```

**Consultas diferidas**

Es la aplicacion de una mejora en procesos repetitivos, el objetivo es que agregues en un bucle o en un proceso que pudiera ser aleatorio para que este sea aleatorio de verdad

ejemplo:

```
    'category_id' => function() {
        return Category::all()->random()->id;
    },
    'user_id' => function() {
        return User::all()->random()->id;
    },
```

**Las relaciones polimorfas**

```
    //Se desarrollan en el seeder, basicamente integrandole al factory una logica que logra introducir la relacion
     Comment::factory(20)->create([
        'user_id' => fn() => User::inRandomOrder()->first()->id,
        'commentable_id' => fn() => $answer->random()->id,
        'commentable_type' => fn() => Answer::class
    ]);
    Comment::factory(20)->create([
        'user_id' => fn() => User::inRandomOrder()->first()->id,
        'commentable_id' => fn() => $question->random()->id,
        'commentable_type' => fn() => Question::class
    ]);
    Comment::factory(20)->create([
        'user_id' => fn() => User::inRandomOrder()->first()->id,
        'commentable_id' => fn() => $publication->random()->id,
        'commentable_type' => fn() => Publication::class
    ]);

