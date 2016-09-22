## Laravel 5 Package for manage resources and uploads in a Bootstrap way

Imagine a world where get a simply but effective media manager for our projects just be a reallity. Make this dream come true!

### Install

#### Quick Install
Do this on the terminal
````
composer require jlopezcur/media-manager
````

At your config/app.php add next:
````
'providers' => [
    ...
    Jlopezcur\MediaManager\MediaManager::class
    ...
],
...
'aliases' => [
    ...
    'MediaManager' => Jlopezcur\MediaManager\Facade::class,
    ...
],
````

### Usage

For the very basic use, do this:
````
{{ MediaManager::field('field_name', $default, $options) }}
````
Also you can use the Laravel Collective Macro:
````
{{ Form::mediamanager('field_name', $default, $options) }}
````
In both forms there will be the same result, you can select a file with a dialog for this.

#### Options

##### Preview
You can previw the content of the selection if is a image file, passing as option:
````
...
'preview' => true,
'preview.size' => [100, 100],
...
````
These are the default values.

### Roadmap

* 0.3.0
  * Accept paste from clipboard
  * Use Drag&Drop for between folders

* 0.2.0
  * Use Vue.js for component


* <s>0.1.0</s> - 20/01/2016
  * First release

### License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
