# Patrons de conception

[![Latest Version on Packagist](https://img.shields.io/packagist/v/opmvpc/patrons.svg?style=flat-square)](https://packagist.org/packages/opmvpc/patrons)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/opmvpc/patrons/run-tests?label=tests)](https://github.com/opmvpc/patrons/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/opmvpc/patrons.svg?style=flat-square)](https://packagist.org/packages/opmvpc/patrons)

## Requirements
- php ^7.4

## 🛠 Installation

You can install the package via composer:

```bash
composer require opmvpc/patrons
```

# Creational


## Singleton

Permet de forcer une classe à n'être instanciée qu'une seule fois. Pour mettre ce patron en oeuvre, on fait appel aux attributs statiques et mettant la visibilité private aux constructeurs.

![](src/Creational/Singleton/cd.png)

### Singleton classic
[Singleton.php](src/Creational/Singleton/Singleton.php)

*Problème:* la variable statique $instance est partagée pour toutes les classes qui étendent Singleton

### Singleton Générique

[SingletonGeneric.php](src/Creational/Singleton/SingletonGeneric.php)

*Problème:* En php, on a pas encore de types génériques. On peut utiliser Psalm pour les simuler avec la balise "@ template T" Malheureusement, elle ne fonctionne pas pour les attributs statiques.

*Solution:* On peut stocker les instances dans un tableau.

[https://blog.cotten.io/how-to-screw-up-singletons-in-php-3e8c83b63189](https://blog.cotten.io/how-to-screw-up-singletons-in-php-3e8c83b63189)

### Comment ajouter la fonctionnalité Singleton à une classe.
*Solution:* On peut utiliser la réflexion pour recréer des classes en leur ajoutant les fonctionnalités d'un singleton. Exemple de création d'une SingletonFactory.

[https://patrick-assoa-adou.medium.com/a-generic-php-singleton-the-long-of-it-661b1ead3981](https://patrick-assoa-adou.medium.com/a-generic-php-singleton-the-long-of-it-661b1ead3981)

*Solution:* Ou on passe par une fonction singletonize

``` php
<?php
function singletonize(\Closure $func)
{
    $singled = new class($func)
    {
        // Hold the class instance.
        private static $instance = null;
        public function __construct($func = null)
        {
            if (self::$instance === null) {
                self::$instance = $func();
            }
            return self::$instance;
        }
        // The singleton decorates the class returned by the closure
        public function __call($method, $args)
        {
            return call_user_func_array([self::$instance, $method], $args);
        }
        private function __clone(){}
        private function __wakeup(){}
    };
    return $singled;
}
```

[https://patrick-assoa-adou.medium.com/a-generic-php-singleton-1985f17eeb6f](https://patrick-assoa-adou.medium.com/a-generic-php-singleton-1985f17eeb6f)

*Remarque:* C'est sencé être mieux d'utiliser l'injection de dépendances que Singleton que certains considèrent comme un anti-pattern

### Utilisation du pattern dans des gros projets

Usages fréquents:
* DAO (accès db)
* un Logger
* lock file pour l'application

Exemple:
* Laravel ServiceContainer

### Utilisation du pattern pour un dictionnaire en plusieurs langues

[DictSingleton.php](src/Creational/Singleton/Dict/DictSingleton.php)

[DictEnglishSingleton.php](src/Creational/Singleton/Dict/DictEnglishSingleton.php)

On peut instancier plusieurs classes qui étendent DictSingleton. On viole les principes du patron Singleton de base.

*À quoi ça sert:* On est quand même certain que les différents dictiunaires ne seront instanciés qu'une fois et qu'on ne permet pas de modifier ces objets.

## Abstract Factory
Permet de créer des objets différents avec une API qui sera similaire.
Exemple ici avec Des usines à voitures thermiques et électriques.

[AbstractFactory.php](src/Creational/Factory/AbstractFactory/AbstractFactory.php)

![](src/Creational/Factory/AbstractFactory/cd.png)

Utilisation:
* Quand *plusieurs lignes de produits* à gérer
* Un reader de fichier différent en fonction de l'OS

## Prototype
Cloner des objets plutôt que de les créer par l'opération "new ObjectClass()". Se rélèle moins couteux et demande souvent moins de code quand on a besoin de plusieurs objets similaires.

# Structural
## Proxy

## Decorator

## Composite

## Facade

## Bridge

## Flyweight

## Adapter

# Behavioral

## Command

## Memento

## Observer

## Visitor

## Template

## State

## Interceptor

## Configuration

## TODO
- [x] Découper en catégories (behavioral, creational, structural)
- [ ] Méthodes clone et wakeup pour le pattern singleton
- [x] Générer les diagrammes de classe sur base du code
- [ ] Ajouter les patterns vus aux cours
    - [ ] Proxy
    - [ ] Decorator
    - [ ] Composite
    - [ ] Prototype
    - [ ] Bridge
    - [ ] Configuration
    - [ ] Observer
    - [ ] Flyweight
    - [ ] Intercepteur
    - [ ] Visitor
    - [ ] Command
    - [ ] Facade
    - [ ] Memento
    - [ ] Playerrole
    - [ ] Interpreter

## Bibliographie

Design Patterns PHP (plein de paterns avec exemples de code et diagrammes de classe)

[https://designpatternsphp.readthedocs.io/en/latest/README.html](https://designpatternsphp.readthedocs.io/en/latest/README.html)

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [opmvpc](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
