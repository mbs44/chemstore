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
    $trail->push('Edit Chemical', route('chemicals.edit', $chemical->id));
});
