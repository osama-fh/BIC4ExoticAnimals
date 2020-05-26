# BIC4 Project: Exotic animals

## The register of exotic animals

This software lists exotic animals and species belongs to them.
It is possible to search for animals by various parameters.

## Exercise

### Already providing

All routes that are needed are implemented:
 * **GET** ```/animal``` &rarr; Lists all animals
 * **GET** ```/list/animal``` &rarr; Returns JSON of all animals
 * **GET** ```/list/species``` &rarr; Returns JSON of all species
 * **POST** ```/animal``` &rarr; Stores new animals
 * **GET** ```/animal/{slug}``` &rarr; Show animal
 * **PUT** ```/animal/{slug}``` &rarr; Update animal
 * **DELETE** ```/animal/{slug}``` &rarr; Delete animal
 * **GET** ```/animal/{slug}/edit``` &rarr; Edit animal
 * **GET** ```/search/animal``` &rarr; Search animals
 * **POST** ```/search/animal``` &rarr; Query animals
 * **GET** ```/species``` &rarr; Lists all species
 * **GET** ```/list/species``` &rarr; Returns JSON of all species
 * **POST** ```/species``` &rarr; Stores new species
 * **GET** ```/species/{slug}``` &rarr; Show species
 * **PUT** ```/species/{slug}``` &rarr; Update species
 * **DELETE** ```/species/{slug}``` &rarr; Delete species
 * **GET** ```/species/{slug}/edit``` &rarr; Edit species

All views can be found in ```/resources/views```.

### TODO

#### VueJS

Implement your [VueJS](https://vuejs.org) components in the folder ```/resources/js/components```.
Register your components in ```/resources/js/app.js``` and use them in the following files:

 * ```/resources/views/species```
     * ```/resources/views/species/create.blade.php```
     * ```/resources/views/species/edit.blade.php```
     * ```/resources/views/species/index.blade.php```
     * ```/resources/views/species/show.blade.php```
 * ```/resources/views/animal```
      * ```/resources/views/animal/create.blade.php```
      * ```/resources/views/animal/edit.blade.php```
      * ```/resources/views/animal/index.blade.php```
      * ```/resources/views/animal/search.blade.php```
      * ```/resources/views/animal/show.blade.php```
      
To query data for dropdowns in forms or to reload lists use the list routes:
 * **GET** ```/list/species```
 * **GET** ```/list/animal```
 
For the search form use ```q``` as the name for the text input.
The search will be handled by the backend.

#### CSS (SCSS)

The design of the software need to be adapted.
[Bulma](https://bulma.io) is used to layout and style the website.
If wanted default styles can be overwritten by setting variables in the ```/resources/sass/_variables.scss``` file.
Also it is possible to write custom styles in ```/resources/sass/_custom.scss```.

A new logo need to be set. If pictures will be present on the website place them in ```/public/img``` folder.
Here you will also find the logo.

### Hints

#### JavaScript and CSS (SCSS)

To compile scss and JavaScript ```npm run dev``` need to be executed in the project folder.
It is also possible to run ```npm run watch``` so it is not need to execute ```npm run dev``` every time a change happend. 

#### Data for Database

To make starting developing fast there are some seeders implemented to fill all needed tables except the user table.
To populate the database run the command ```php artisan db:seed``` in the terminal in project root folder.
