# Patrons de conception

[![Latest Version on Packagist](https://img.shields.io/packagist/v/opmvpc/patrons.svg?style=flat-square)](https://packagist.org/packages/opmvpc/patrons)
[![Total Downloads](https://img.shields.io/packagist/dt/opmvpc/patrons.svg?style=flat-square)](https://packagist.org/packages/opmvpc/patrons)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/opmvpc/patrons/run-tests?label=tests)](https://github.com/opmvpc/patrons/actions?query=workflow%3Arun-tests+branch%3Amaster)
![Build Status](https://app.chipperci.com/projects/b2372d80-a773-46f9-a3bd-4849db860e5c/status/master)

Exemples d'implémentation de patrons de conception en php.

Le package est écrit à l'aide de l'analyseur statique de code psalm. Le code utilise un maximum les nouvelles fonctionnalités de typages offertes par php 7.4. Le code est couvert par les tests à 100%.

Les différents diagrames de classe UML sont générés à partir du code. Le package utilisé ne représente pas les relations entre les classes.

![](patrons.jpg)
The Gang of Four working on their next pattern idea.

## ⚙ Requirements
- php ^7.4
- composer

Pour générer les diagrames de classe UML:
- extension php imagick
- graphviz installé (+ var d'environnement PATH pour windows)

## 🛠 Installation

You can install the package via composer:

```bash
git clone
composer update
```

## 📚 Table des matières

Attention, le contenu est en construction!

**[Creational](#Creational)**
* [Singleton](#Singleton)
* [Abstract Factory](#Abstract-Factory)
* [Prototype](#Prototype)


**[Structural](#Structural)**
* [Proxy](#Proxy)
* [Decorator](#Decorator)
* [Composite](#Composite)
* [Facade](#Facade)
* [Bridge](#Bridge)
* [Flyweight](#Flyweight)
* [Adapter](#Adapter)


**[Behavioral](#Behavioral)**
* [Command](#Command)
* [Memento](#Memento)
* [Observer](#Observer)
* [Visitor](#Visitor)
* [Template](#Template)
* [State](#State)
* [Interceptor](#Interceptor)
* [Configuration](#Configuration)

**[Autres Patterns](#Autres-Patterns)**
* [Interpreter](#Interpreter)

**[Bibliographie](#Bibliographie)**

# Creational


## Singleton

Permet de forcer une classe à n'être instanciée qu'une seule fois. Pour mettre ce patron en oeuvre, on fait appel aux attributs statiques et mettant la visibilité private aux constructeurs.

En php on va faire en sorte que les méthodes magiques __construct(), __clone() et __wakeup() ne puissent pas être utilisées.

![](src/Creational/Singleton/cd.png)

### Singleton classic
[code de Singleton.php](src/Creational/Singleton/Singleton.php)

*Problème:* la variable statique $instance est partagée pour toutes les classes qui étendent Singleton

### Singleton Générique

[code de SingletonGeneric.php](src/Creational/Singleton/SingletonGeneric.php)

*Problème:* En php, on a pas encore de types génériques. On peut utiliser Psalm pour les simuler avec la balise "@ template T" Malheureusement, elle ne fonctionne pas pour les attributs statiques.

*Solution:* On peut stocker les instances dans un tableau.

[https://blog.cotten.io/how-to-screw-up-singletons-in-php-3e8c83b63189](https://blog.cotten.io/how-to-screw-up-singletons-in-php-3e8c83b63189)

### Comment ajouter la fonctionnalité Singleton à une classe.
*Solution:* On peut utiliser la réflexion pour recréer des classes en leur ajoutant les fonctionnalités d'un singleton. Exemple de création d'une SingletonFactory.

[https://patrick-assoa-adou.medium.com/a-generic-php-singleton-the-long-of-it-661b1ead3981](https://patrick-assoa-adou.medium.com/a-generic-php-singleton-the-long-of-it-661b1ead3981)

*Solution:* Ou on passe par une fonction singletonize

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

[code de l'exemple du dictionnaire](src/Creational/Singleton/Dict)

On peut instancier plusieurs classes qui étendent DictSingleton. On viole les principes du patron Singleton de base.

*À quoi ça sert:* On est quand même certain que les différents dictiunaires ne seront instanciés qu'une fois et qu'on ne permet pas de modifier ces objets.

## Abstract Factory
Permet de créer des objets différents avec une API qui sera similaire.
Exemple ici avec Des usines à voitures thermiques et électriques.

[code du pattern AbstractFactory](src/Creational/Factory/AbstractFactory/)

![](src/Creational/Factory/AbstractFactory/cd.png)

Utilisation:
* Quand *plusieurs lignes de produits* à gérer
* Un reader de fichier différent en fonction de l'OS

## Prototype
Cloner des objets plutôt que de les créer par l'opération "new ObjectClass()". Se rélèle moins couteux et demande souvent moins de code quand on a besoin de plusieurs objets similaires. Attention, il faut implémenter la méthode clone pour faire des deepcopies.

Utilisations:

* Interface graphique de création de niveau de jeux video.
* logiciel CAD?

Exercice: Utiliser une classe abstraite qui utilise un array pour stocker les valeurs des attributs et fourni une méthode clone qui copie les attributs

Bonus php: On implémente l'interface ArrayAccess pour accéder au valeurs de la propriété `$attributes` d'un de nos objets avec la même notation que celle d'un tableau (Ex: `$floor['floorId]`)

[code du pattern Prototype](src/Creational/Prototype)

![](src/Creational/Prototype/cd.png)

# Structural
## Proxy

Permet de cacher un objet couteux en ressources en ne manipulant qu'un objet proxy qui va s'occuper de créer et manipuler l'objet couteux pour nous.

[code du pattern Proxy](src/Structural/Proxy)

![](src/Structural/Proxy/cd.png)

Utilisations:
* On doit controller l'accès à un objet
* On doit ajouter des fonctionnalités quand on accède à un objet.
* Droits d'accès
* Le proxy peut-être utilisé comme substitue d'un autre objet

Types de proxies:
* Protection proxy (controlle d'accès à une ressource)
* Virtual proxy (exemple du placeholder video)
* Remote proxy (objet local qui cache les appels à distance vers un serveur)

Sources:

[https://en.wikipedia.org/wiki/Proxy_pattern](https://en.wikipedia.org/wiki/Proxy_pattern)

[https://www.geeksforgeeks.org/proxy-design-pattern/](https://www.geeksforgeeks.org/proxy-design-pattern/)

## Decorator
Permet d'ajouter dynamiquement des fonctionnalités à un objet. Alternative à la création de sous-classes.

[code du pattern Decorator](src/Structural/Decorator)

![](src/Structural/Decorator/cd.png)

### Comparaison Proxy et Decorator

Ils ont une structure proche. Ils utilisent tous deux une interface pour créer des objets aux méthodes compatibles et chainables.

Le but de pattern Proxy est "de représenter"/"être à la place" d'un autre objet, tandis que le but du pattern Decorator est d'ajouter des nouvelles fonctionnalités à des objets à l'exécution.

### Problème des ScrollDecorator et du 3DDecorator

L'effet 3D s'applique sur la fenetre mais pas sur les scrollbars.

Solution:
* On force une instance de classe à n'être référencée qu'une seule fois. (je suis pas certain d'avoir bien compris 😥)

[https://en.wikipedia.org/wiki/Decorator_pattern#Motivation](https://en.wikipedia.org/wiki/Decorator_pattern#Motivation)

## Composite
Exercice: Gestionnaire de fichiers avec le pattern Composite.
* création de fichiers et dossiers
* supprimer des fichiers et dossiers
* déplacer des fichiers et dossiers
* copier des fichiers et dossiers
* check si des fichiers et dossiers sont les même / ont la même structure
* check si deux fichiers ont la même structure

[code du pattern Composite](src/Structural/Composite)

![](src/Structural/Composite/cd.png)
Exercice: Gestionnaire de fichiers avec le pattern Composite.

Solution:
* Ajout d'une classe FileManager qui permet de simplifier l'api
* Quelques méthodes en plus (find($name), goTo($path))
* Attention, l'écriture sur disque n'est pas implémentée. Pour cela, il faudrait juste compléter certaines méthodes.

#### Comment utiliser le pattern Visitor avec le pattern Composite?
#### Comment utiliser le pattern PlayerRole avec le pattern Composite pour implémenter la transformation d'une feuille/container en component?

## Facade

## Bridge
Permet de découpler l'implémentation d'une interface et de découpler notre code de l'interface.
On peut ainsi changer d'implémentation durant l'exécution.

Exemple: Système de réponse qui peut render de l'Html soit du Json en fonction de l'implémentation de renderer utilisée.

[code du pattern Bridge](src/Structural/Bridge)

![](src/Structural/Bridge/cd.png)

### Exercices
#### Ajouter une implémentation TailwindCSS et observer l'impact sur l'architecture:
* Pas d'impacte notable. On doit juste créer une nouvelle classe qui implémente RendererImplementation
#### RendererImplementation est une interface. Comment on peut l'améliorer en utilisant une classe abstraite (voir pattern Template)
* Todo
#### Comment une Abstract Factory pourrait contribuer au pattern Bridge?
On pourrait utiliser les abstract factory pour choisir l'implémentation utilisée en fonction des besoins dans chaque factory.

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

# Autres Patterns
## Interpreter

## TODO
- [x] Découper en catégories (behavioral, creational, structural)
- [x] Méthodes clone et wakeup pour le pattern singleton
- [x] Générer les diagrammes de classe sur base du code
- [x] Faire une TOC
- [ ] Ajouter les patterns vus aux cours (+ tests, description, réponses questions et Diagramme de classe, maj TOC)
    - [x] Singleton
    - [x] Abstract Factory
    - [x] Proxy
    - [x] Decorator
    - [x] Composite
    - [x] Prototype
    - [x] Bridge
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

## Psalm (static analysis)

``` bash
composer psalm
```

## Génération diagrames de classe

``` bash
php generateUmlCD.php
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
