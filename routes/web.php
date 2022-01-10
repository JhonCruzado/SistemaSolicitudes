<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportesGraficos;
use App\Http\Livewire\AdmProductos;
use App\Http\Livewire\Departamentos;
use App\Http\Livewire\Colaboradores;
use App\Http\Livewire\ComprasRealizadas;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\InfoEmpresa;
use App\Http\Livewire\Kardex;
use App\Http\Livewire\NuevaCompra;
use App\Http\Livewire\NuevaVenta;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Proveedores;
use App\Http\Livewire\Areas;
use App\Http\Livewire\Cajas;
use App\Http\Livewire\AsignarColaboradores;
use App\Http\Livewire\AsignarColaboradores2;
use App\Http\Livewire\ReporteMovimientos;
use App\Http\Livewire\RechazandoSolicitudes;
use App\Http\Livewire\AprobandoSolicitudes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::post('/signin', [AuthController::class, 'login'])->name('signin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if(Auth::guest()){
        return view('auth/login');
    }
    return redirect('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Dashboard::class)->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/nueva-solicitud', NuevaCompra::class)->name('nueva-solicitud');
Route::middleware(['auth:sanctum', 'verified'])->get('/solicitudes', ComprasRealizadas::class)->name('solicitudes');

Route::middleware(['auth:sanctum', 'verified'])->get('/departamentos', Departamentos::class)->name('departamentos');
Route::middleware(['auth:sanctum', 'verified'])->get('/areas', Areas::class)->name('areas');
Route::middleware(['auth:sanctum', 'verified'])->get('/colaboradores', Colaboradores::class)->name('colaboradores');
Route::middleware(['auth:sanctum', 'verified'])->get('/asignar', AsignarColaboradores::class)->name('asignar');
Route::middleware(['auth:sanctum', 'verified'])->get('/asignar2', AsignarColaboradores2::class)->name('asignar2');
Route::middleware(['auth:sanctum', 'verified'])->get('/proforma-compra/{id}', [ComprasRealizadas::class, 'pdf']);

Route::middleware(['auth:sanctum', 'verified'])->get('/aprobacion', AprobandoSolicitudes::class)->name('aprobacion');
Route::middleware(['auth:sanctum', 'verified'])->get('/rechazo', RechazandoSolicitudes::class)->name('rechazo');
/*
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/adm-productos', AdmProductos::class)->name('adm-productos');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/proveedores', Proveedores::class)->name('proveedores');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/productos', Productos::class)->name('productos');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/nueva-venta', NuevaVenta::class)->name('nueva-venta');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/ventas', VentasRealizadas::class)->name('ventas');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/kardex', Kardex::class)->name('kardex');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/factura-venta/{id}', [VentasRealizadas::class, 'pdf']);
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/tarjeta-kardex/{id?}', [Kardex::class, 'pdf']);
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/reporte-movimiento', [ReporteMovimientos::class, 'pdf'])->name('rep-movimientos');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/info-empresa', InfoEmpresa::class)->name('empresa');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/usuarios', Usuarios::class)->name('usuarios');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/reporte-ventas', [ReportesGraficos::class, 'reporteVentas'])->name('rep-ventas');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/reporte-compras', [ReportesGraficos::class, 'reporteCompras'])->name('rep-compras');
Route::middleware(['auth:sanctum', 'verified', 'auth2:A'])->get('/caja', Cajas::class )->name('caja');
*/

Route::get('no-autorizado', function(){
    abort('403');
});

Route::get('error', function(){
    abort('404');
});
