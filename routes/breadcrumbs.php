<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Chemicals
Breadcrumbs::for('chemicals.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Chemicals', route('chemicals.index'));
});

Breadcrumbs::for('chemicals.create', function ($trail) {
    $trail->parent('chemicals.index');
    $trail->push('Add', route('chemicals.index'));
});

// Show Chemical
Breadcrumbs::for('chemicals.show', function ($trail, $id) {
    $trail->parent('chemicals.index');
    $trail->push( 'ID: '.$id, route('chemicals.show', $id));
});

// Edit Chemical
Breadcrumbs::for('chemicals.edit', function ($trail, $chemical) {
    $trail->parent('chemicals.index');
    $trail->push('Edit', route('chemicals.edit', $chemical->id));
});


// Experiments
Breadcrumbs::for('experiments.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Experiment', route('experiments.index'));
});

Breadcrumbs::for('experiments.create', function ($trail) {
    $trail->parent('experiments.index');
    $trail->push('Add', route('experiments.index'));
});

// Show Chemical
Breadcrumbs::for('experiments.show', function ($trail, $id) {
    $trail->parent('experiments.index');
    $trail->push( 'ID: '.$id, route('experiments.show', $id));
});

// Edit Chemical
Breadcrumbs::for('experiments.edit', function ($trail, $chemical) {
    $trail->parent('experiments.index');
    $trail->push('Edit', route('experiments.edit', $chemical->id));
});
