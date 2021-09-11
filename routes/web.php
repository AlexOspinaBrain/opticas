<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpsController;
use App\Http\Controllers\Cie10tmpController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetfacturaController;
use App\Http\Controllers\DetfaclenteController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;

use App\Exports\UsuariosripsExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('root');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/sinpermiso', function () {
    return view('sinpermiso');
})->name('sinpermiso');

//clientes
Route::middleware(['auth:sanctum', 'verified'])->get('/cliente/gestion', 
    [ClienteController::class, 'crea'])->name('cliente');

Route::middleware(['auth:sanctum', 'verified'])->post('/cliente/gestion', 
    [ClienteController::class, 'store'])->name('clientepost');

Route::middleware(['auth:sanctum', 'verified'])->patch('/cliente/actualiza', 
    [ClienteController::class, 'update'])->name('clienteactualiza');

Route::middleware(['auth:sanctum', 'verified'])->post('/cliente/existe', 
    [ClienteController::class, 'clienteexiste'])->name('clienteexiste');   
    
Route::middleware(['auth:sanctum', 'verified'])->get('/cliente/index', 
    [ClienteController::class, 'index'])->name('clientes.index');

Route::middleware(['auth:sanctum', 'verified'])->delete('/cliente/{id}/elimina-cliente', 
    [ClienteController::class, 'destroy'])->name('clientes.delete');

//historias
Route::middleware(['auth:sanctum', 'verified'])->get('/historias/index', 
    [HistoriaController::class, 'index'])->name('historias.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/historias/gestion', 
    [HistoriaController::class, 'crea'])->name('historias');
    
Route::middleware(['auth:sanctum', 'verified'])->post('/historias/gestion', 
    [HistoriaController::class, 'store'])->name('historiascrea');

Route::middleware(['auth:sanctum', 'verified'])->patch('/historias/gestion', 
    [HistoriaController::class, 'update'])->name('historias.actualiza');

Route::middleware(['auth:sanctum', 'verified'])->post('/historias/existe', 
    [HistoriaController::class, 'existe'])->name('historia.existe');    

//facturacion
Route::middleware(['auth:sanctum', 'verified'])->get('/facturacion/gestion', 
    [FacturaController::class, 'genera'])->name('facturacion');
    
Route::middleware(['auth:sanctum', 'verified'])->post('/facturacion/gestion', 
    [FacturaController::class, 'crea'])->name('facturacrea');

Route::middleware(['auth:sanctum', 'verified'])->put('/facturacion/gestion', 
    [FacturaController::class, 'confact'])->name('actualizafactura');

Route::middleware(['auth:sanctum', 'verified'])->get('/facturacion/vefactura', 
    [FacturaController::class, 'download'])->name('vefactura');

Route::middleware(['auth:sanctum', 'verified'])->post('/facturacion/factura-cliente', 
    [FacturaController::class, 'facturacliente'])->name('clienteconfactura');

Route::middleware(['auth:sanctum', 'verified'])->put('/facturacion/factura-abono', 
    [FacturaController::class, 'abono'])->name('rutaabono');

Route::middleware(['auth:sanctum', 'verified'])->get('/facturacion/impresion', 
    [FacturaController::class, 'imprime'])->name('facimp');

Route::middleware(['auth:sanctum', 'verified'])->get('/facturacion/factura', 
    [FacturaController::class, 'index'])->name('factura.index');

Route::middleware(['auth:sanctum', 'verified'])->put('/facturacion/factura', 
    [FacturaController::class, 'update'])->name('factura.update');


//detalle factura
Route::middleware(['auth:sanctum', 'verified'])->post('/facturacion/detalle-factura', 
    [DetfacturaController::class, 'store'])->name('detallefactura');

Route::middleware(['auth:sanctum', 'verified'])->delete('/facturacion/{id}/elimina-itemfactura', 
    [DetfacturaController::class, 'destroy'])->name('eliminadetallefactura');

//detalle lente
Route::middleware(['auth:sanctum', 'verified'])->post('/facturacion/detalle-lente', 
    [DetfaclenteController::class, 'detalle'])->name('buscalente');

Route::middleware(['auth:sanctum', 'verified'])->post('/facturacion/crea-lente', 
    [DetfaclenteController::class, 'graba'])->name('guardalente');


//importar archivos

Route::middleware(['auth:sanctum', 'verified'])->get('/import/importExportView',
     [EpsController::class, 'importExportView'])->name('importExportView');

Route::middleware(['auth:sanctum', 'verified'])->post('/import',
     [EpsController::class, 'import'])->name('import');

Route::middleware(['auth:sanctum', 'verified'])->post('/actcie10',
     [Cie10tmpController::class, 'actualizacie10'])->name('actcie10');

Route::middleware(['auth:sanctum', 'verified'])->post('/importcie10',
     [Cie10tmpController::class, 'import'])->name('importcie10');     


//informes
Route::middleware(['auth:sanctum', 'verified'])->get('/informes',
     [InformesController::class, 'index'])->name('informes.index');     

Route::middleware(['auth:sanctum', 'verified'])->post('/informes',
     [InformesController::class, 'infrips'])->name('informes.infrips');     

//usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios/gestion', 
    [UserController::class, 'index'])->name('usuarios.index');
Route::middleware(['auth:sanctum', 'verified'])->patch('/usuarios/gestion', 
    [UserController::class, 'update'])->name('usuarios.actualiza');
Route::middleware(['auth:sanctum', 'verified'])->post('/usuarios/gestion', 
    [UserController::class, 'existe'])->name('usuarios.data');

//productos
Route::middleware(['auth:sanctum', 'verified'])->get('/productos/gestion', 
    [ProductoController::class, 'index'])->name('productos.index');

Route::middleware(['auth:sanctum', 'verified'])->post('/productos/existe', 
    [ProductoController::class, 'existe'])->name('productos.existe');

Route::middleware(['auth:sanctum', 'verified'])->post('/productos/elimina', 
    [ProductoController::class, 'destroy'])->name('productos.elimina');

Route::middleware(['auth:sanctum', 'verified'])->post('/productos/gestion', 
    [ProductoController::class, 'store'])->name('productos.crea');

Route::middleware(['auth:sanctum', 'verified'])->patch('/productos/gestion', 
    [ProductoController::class, 'update'])->name('productos.actualiza');

Route::middleware(['auth:sanctum', 'verified'])->post('/productos/desactiva', 
    [ProductoController::class, 'desactiva'])->name('productos.desactiva');

Route::resource('eps', EPSController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);