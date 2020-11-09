<?php

/**
 * ====================================================================
 * Script de génération des diagrammes de classe des différents pattern.
 * ====================================================================
 * Utilisation:
 * $ php generateUmlCD
 * Attention! Besoin d'installer graphviz (et aussi l'ajouter à var environnement path) et activer php_imagic_ext sur le système.
 */

start();

function start(): void
{
    echo("Generation des diagrammes de classes dans les différents dossiers..\n\n");
    generateDiagrams();
    echo("\nTerminé!");
}

function generateDiagrams(): void
{
    $dirs = getDirs();

    foreach ($dirs as $dir) {
        echo("\t- $dir\n");
        executeCommand($dir);
    }
}

function getDirs(): array
{
    $patterns = [
        'Creational' => [
            'Factory/AbstractFactory',
            'Singleton',
            'Prototype',
        ],
        'Structural' => [
            'Proxy',
            'Decorator',
            'Composite',
        ],
    ];

    return createPath($patterns);
}

function createPath(array $patterns)
{
    $paths = [];

    $dataSource = 'src/';
    foreach ($patterns as $categoryName => $category) {
        foreach ($category as $pattern) {
            $paths[] = $dataSource . $categoryName . '/' . $pattern;
        }
    }

    return $paths;
}

function executeCommand(string $dir): void
{
    $output = [];
    $return_var = null;
    $command = 'vendor\bin\umlwriter diagram:class ' . $dir . ' --output=' . $dir . '/cd.png';
    $result = exec($command, $output, $return_var);
}
