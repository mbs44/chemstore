<?php

// Home
use Diglactic\Breadcrumbs\Breadcrumbs;

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

Breadcrumbs::for('experiments.create', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('experiments.index');
    $trail->push($isEnglish?'Add':'Pridať', route('experiments.index'));
});

// Show Chemical
Breadcrumbs::for('experiments.show', function ($trail, $id) {
    $trail->parent('experiments.index');
    $trail->push( 'ID: '.$id, route('experiments.show', $id));
});

// Edit Chemical
Breadcrumbs::for('experiments.edit', function ($trail, $experiment) {
    $isEnglish = session('language') === 'en';
    $trail->parent('experiments.index');
    $trail->push($isEnglish?'Edit':'Zmeniť', route('experiments.edit', $experiment->id));
});


// Experiments
Breadcrumbs::for('requests.index', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('home');
    $trail->push($isEnglish?'Request':'Žiadosť', route('requests.index'));
});

Breadcrumbs::for('requests.create', function ($trail) {
    $isEnglish = session('language') === 'en';
    $trail->parent('requests.index');
    $trail->push($isEnglish?'Add':'Pridať', route('requests.index'));
});

// Show Chemical
Breadcrumbs::for('requests.show', function ($trail, $id) {
    $trail->parent('requests.index');
    $trail->push( 'ID: '.$id, route('requests.show', $id));
});

// Edit Chemical
Breadcrumbs::for('requests.edit', function ($trail, $request) {
    $isEnglish = session('language') === 'en';
    $trail->parent('requests.index');
    $trail->push($isEnglish?'Edit':'Zmeniť', route('requests.edit', $request->id));
});

// Experiments
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('users.index'));
});

Breadcrumbs::for('users.edit', function ($trail, $request) {
    $trail->parent('users.index');
    $trail->push('Edit', route('users.edit', $request->id));
});

