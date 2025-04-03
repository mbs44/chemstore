<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Definition for all breadcrumbs used in the application

Breadcrumbs::for('home', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->push($isEnglish?'Home':'Domov', route('home'));
});

// Chemicals
Breadcrumbs::for('chemicals.index', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('home');
    $trail->push($isEnglish?'Chemicals':'Chemikálie', route('chemicals.index'));
});

// Create Chemical
Breadcrumbs::for('chemicals.create', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('chemicals.index');
    $trail->push($isEnglish?'Add':'Pridať', route('chemicals.index'));
});

// Show Chemical
Breadcrumbs::for('chemicals.show', function ($trail, $id) {
    $trail->parent('chemicals.index');
    $trail->push( 'ID: '.$id, route('chemicals.show', $id));
});

// Edit Chemical
Breadcrumbs::for('chemicals.edit', function ($trail, $chemical) {
    $isEnglish = session('language') === 'en';
    $trail->parent('chemicals.index');
    $trail->push($isEnglish?'Edit':'Zmeniť', route('chemicals.edit', $chemical->id));
});


// Experiments
Breadcrumbs::for('experiments.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Experiment', route('experiments.index'));
});

// Create experiment
Breadcrumbs::for('experiments.create', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('experiments.index');
    $trail->push($isEnglish?'Add':'Pridať', route('experiments.index'));
});

// Show experiment
Breadcrumbs::for('experiments.show', function ($trail, $id) {
    $trail->parent('experiments.index');
    $trail->push( 'ID: '.$id, route('experiments.show', $id));
});

// Edit experiment
Breadcrumbs::for('experiments.edit', function ($trail, $experiment) {
    $isEnglish = session('language') === 'en';
    $trail->parent('experiments.index');
    $trail->push($isEnglish?'Edit':'Zmeniť', route('experiments.edit', $experiment->id));
});


// Student requests
Breadcrumbs::for('requests.index', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('home');
    $trail->push($isEnglish?'Request':'Žiadosť', route('requests.index'));
});

// Create request
Breadcrumbs::for('requests.create', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('requests.index');
    $trail->push($isEnglish?'Add':'Pridať', route('requests.index'));
});

// Show request
Breadcrumbs::for('requests.show', function ($trail, $id) {
    $trail->parent('requests.index');
    $trail->push( 'ID: '.$id, route('requests.show', $id));
});

// Edit request
Breadcrumbs::for('requests.edit', function ($trail, $request) {
    $isEnglish = session('language') === 'en';
    $trail->parent('requests.index');
    $trail->push($isEnglish?'Edit':'Zmeniť', route('requests.edit', $request->id));
});

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('users.index'));
});

// Edit Users
Breadcrumbs::for('users.edit', function ($trail, $request) {
    $trail->parent('users.index');
    $trail->push('Edit', route('users.edit', $request->id));
});

