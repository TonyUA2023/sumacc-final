<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Appointments
Breadcrumbs::for('admin.appointments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Citas', route('admin.appointments.index'));
});

Breadcrumbs::for('admin.appointments.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.appointments.index');
    $trail->push('Crear', route('admin.appointments.create'));
});

Breadcrumbs::for('admin.appointments.show', function (BreadcrumbTrail $trail, $appointment) {
    $trail->parent('admin.appointments.index');
    $trail->push('Ver', route('admin.appointments.show', $appointment));
});

Breadcrumbs::for('admin.appointments.edit', function (BreadcrumbTrail $trail, $appointment) {
    $trail->parent('admin.appointments.index');
    $trail->push('Editar', route('admin.appointments.edit', $appointment));
});

// Services
Breadcrumbs::for('admin.services.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Servicios', route('admin.services.index'));
});

Breadcrumbs::for('admin.services.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.services.index');
    $trail->push('Crear', route('admin.services.create'));
});

Breadcrumbs::for('admin.services.show', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.services.index');
    $trail->push('Ver', route('admin.services.show', $service));
});

Breadcrumbs::for('admin.services.edit', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.services.index');
    $trail->push('Editar', route('admin.services.edit', $service));
});

// Clients
Breadcrumbs::for('admin.clients.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Clientes', route('admin.clients.index'));
});

Breadcrumbs::for('admin.clients.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.clients.index');
    $trail->push('Crear', route('admin.clients.create'));
});

Breadcrumbs::for('admin.clients.show', function (BreadcrumbTrail $trail, $client) {
    $trail->parent('admin.clients.index');
    $trail->push('Ver', route('admin.clients.show', $client));
});

Breadcrumbs::for('admin.clients.edit', function (BreadcrumbTrail $trail, $client) {
    $trail->parent('admin.clients.index');
    $trail->push('Editar', route('admin.clients.edit', $client));
});

// Users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Usuarios', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Crear', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Ver', route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Editar', route('admin.users.edit', $user));
});

// Calendar
Breadcrumbs::for('admin.calendar', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Calendario', route('admin.calendar'));
});

// Reports
Breadcrumbs::for('admin.reports', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Reportes', route('admin.reports'));
});