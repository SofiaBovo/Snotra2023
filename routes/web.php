<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::get('/register/verify/{code}', 'App\Http\Controllers\Auth\RegisterController@verify');

Route::get('/', function () {

    return view('home');
});
Route::get('home', function () {
    //
})->name('home');

/*Chat*/
Route::get('/index', 'App\Http\Controllers\vendor\Chatify\MessagesController@index')->name(config('chatify.routes.prefix'));
Route::post('/idInfo', 'App\Http\Controllers\Vendor\Chatify\MessagesController@idFetchData');
Route::post('sendMessage', 'App\Http\Controllers\Vendor\Chatify\MessagesController@send')->name('send.message');
Route::post('fetchMessages', 'App\Http\Controllers\Vendor\Chatify\MessagesController@fetch')->name('fetch.messages');
Route::get('/download/{fileName}', 'App\Http\Controllers\Vendor\Chatify\MessagesController@download')->name(config('chatify.attachments.download_route_name'));
Route::post('/chat/auth', 'App\Http\Controllers\Vendor\Chatify\MessagesController@pusherAuth')->name('pusher.auth');
Route::post('/makeSeen', 'App\Http\Controllers\Vendor\Chatify\MessagesController@seen')->name('messages.seen');
Route::post('/getContacts', 'App\Http\Controllers\Vendor\Chatify\MessagesController@getContacts')->name('contacts.get');
Route::post('/star', 'App\Http\Controllers\Vendor\Chatify\MessagesController@favorite')->name('star');
Route::post('/favorites', 'App\Http\Controllers\Vendor\Chatify\MessagesController@getFavorites')->name('favorites');
Route::post('/search', 'App\Http\Controllers\Vendor\Chatify\MessagesController@search')->name('search');
Route::post('/shared', 'App\Http\Controllers\Vendor\Chatify\MessagesController@sharedPhotos')->name('shared');
Route::post('/deleteConversation', 'App\Http\Controllers\Vendor\Chatify\MessagesController@deleteConversation')->name('conversation.delete');
Route::post('/updateSettings', 'App\Http\Controllers\Vendor\Chatify\MessagesController@updateSettings')->name('avatar.update');
Route::post('/setActiveStatus', 'App\Http\Controllers\Vendor\Chatify\MessagesController@setActiveStatus')->name('activeStatus.set');

/*Perfil de usuario*/

Route::get('profile/edit', 'App\Http\Controllers\Auth\ProfileController@index')->name('profile.edit');
Route::put('profile/actualizar', 'App\Http\Controllers\Auth\ProfileController@updatepersonal')->name('profile.updatepersonal');
Route::put('profile/editar', 'App\Http\Controllers\Auth\ProfileController@updatecontra')->name('profile.updatecontra');

/*Página principal*/
Auth::routes();
Route::get('/directivo', 'App\Http\Controllers\DirectivoController@index')->name('directivo')->middleware('directivo');
Route::get('/docente', 'App\Http\Controllers\DocenteController@index')->name('docente')->middleware('docente');
Route::get('/familia', 'App\Http\Controllers\FamiliaController@index')->name('familia')->middleware('familia');
Route::get('/noverificado', 'App\Http\Controllers\FamiliaController@noverificado')->name('noverificado');

/*Verificación de email*/
Auth::routes(['verify' => true]);
Route::get('verify', function () {
    return view('auth/verify');
});
Route::get('profile', function () {
})->middleware('verified');

Route::get('verificado', function () {
    return view('auth/verificado');
});


/*Carga de archivos*/
Route::get('formulario', 'App\Http\Controllers\ColegioController@index')->name('formulario');
Route::post('storage/create', 'App\Http\Controllers\ColegioController@store');
Route::get('storage/{id}/editar', 'App\Http\Controllers\ColegioController@edit')->name('edit');
Route::put('storage/{id}', 'App\Http\Controllers\ColegioController@update')->name('update');
Route::get('configuraciones', 'App\Http\Controllers\ConfiguracionesController@index')->name('configuraciones');
Route::post('configuraciones/create', 'App\Http\Controllers\ConfiguracionesController@store')->name('confi');

/*Carga de docentes*/
Route::resource('admin/docentes','App\Http\Controllers\CargaDocenteController');
Route::get('admin/{id}/ver', 'App\Http\Controllers\CargaDocenteController@show')->name('ver');
Route::delete('admin/{id}/destroydoc', 'App\Http\Controllers\CargaDocenteController@destroy')->name('destroydoc');
Route::get('admin/{id}/editardoc', 'App\Http\Controllers\CargaDocenteController@editardoc')->name('editardocente');
Route::put('admin/{id}', 'App\Http\Controllers\CargaDocenteController@update')->name('docentes.update');

/*Carga de familias*/
Route::resource('admin/familias','App\Http\Controllers\CargaFamiliaController');
Route::get('admin/familia/create', 'App\Http\Controllers\CargaFamiliaController@crearfamilia')->name('crearfamilia');
Route::post('admin/familia/store', 'App\Http\Controllers\CargaFamiliaController@storefamilia')->name('storefamilia');
Route::get('admin/{id}/editarfam', 'App\Http\Controllers\CargaFamiliaController@editarfamilia')->name('editarfam');
Route::put('admin/familia/{id}', 'App\Http\Controllers\CargaFamiliaController@updatefamilia')->name('actualizarfam');
Route::delete('admin/familia/{id}', 'App\Http\Controllers\CargaFamiliaController@destroy')->name('eliminarfamilia');
Route::get('infoalumnos', 'App\Http\Controllers\InformacionAlumnoController@index')->name('infoalumnos');

/*Carga de alumnos*/
Route::resource('admin/alumnos','App\Http\Controllers\CargaAlumnoController');
Route::get('admin/{id}/show', 'App\Http\Controllers\CargaAlumnoController@showalumnos')->name('show');
Route::get('admin/{id}/showfam', 'App\Http\Controllers\CargaAlumnoController@showfamilia')->name('showfam');
Route::delete('admin/{id}', 'App\Http\Controllers\CargaAlumnoController@destroy')->name('destroy');
Route::get('admin/{id}/editaralu', 'App\Http\Controllers\CargaAlumnoController@editaralumno')->name('editaralumno');
Route::put('admin/{id}', 'App\Http\Controllers\CargaAlumnoController@updatealu')->name('updatealu');
Route::get('/autocomplete/familiar/','App\Http\Controllers\CargaAlumnoController@getAutocompletefamiliar')->name('Autocomplte.familiar');


/*Creación de año escolar*/
Route::get('añoescolar', 'App\Http\Controllers\AñoController@index')->name('añoescolar');
Route::get('añoescolar/create', 'App\Http\Controllers\AñoController@create')->name('añocreate');
Route::post('añoescolar/store', 'App\Http\Controllers\AñoController@store')->name('añoescolar.store');
Route::get('armadogrado', 'App\Http\Controllers\AñoController@listadogrado')->name('armadogrado');
Route::post('armadogrado/buscar', 'App\Http\Controllers\AñoController@buscar')->name('buscar');
Route::get('armadogrado/create', 'App\Http\Controllers\AñoController@creategrado')->name('armadogrado.create');
Route::post('armadogrado/store', 'App\Http\Controllers\AñoController@armadogrado')->name('armadogrado.store');
Route::delete('añoescolar/{id}', 'App\Http\Controllers\AñoController@destroy')->name('eliminaraño');
Route::get('añoescolar/{id}/editaraño', 'App\Http\Controllers\AñoController@editaraño')->name('editaraño');
Route::put('añoescolar/{id}', 'App\Http\Controllers\AñoController@actualizaraño')->name('actualizaraño');
Route::get('añoescolar/{id}/estado', 'App\Http\Controllers\AñoController@actualizarestado')->name('actualizarestado');
Route::post('añoescolar/especiales/{id}', 'App\Http\Controllers\AñoController@armadoespeciales')->name('armado.especiales');
Route::get('armadogrado/{id}/editargrado', 'App\Http\Controllers\AñoController@editargrado')->name('editargrado');
Route::put('armadogrado/{id}', 'App\Http\Controllers\AñoController@actualizargrado')->name('actualizargrado');


Route::get('/autocomplete/getAutocomplete/','App\Http\Controllers\ControllerEvent@getAutocomplete')->name('Autocomplte.getAutocomplte');
Route::get('/autocomplete/divisiones/','App\Http\Controllers\ConfiguracionesController@getAutocompletedivisiones')->name('Autocomplte.divisiones');
Route::get('/autocomplete/espacioscurriculares/','App\Http\Controllers\ConfiguracionesController@getAutocompleteespacios')->name('Autocomplte.espacios');
Route::get('/autocomplete/calificacion/','App\Http\Controllers\ConfiguracionesController@getAutocompletecalificacion')->name('Autocomplte.calificacion');


/*Calendario de eventos.*/
// formulario
Route::get('evento/form','App\Http\Controllers\ControllerEvent@form')->name('form');
Route::post('Evento/create','App\Http\Controllers\ControllerEvent@create');

Route::get('Eventos/listado','App\Http\Controllers\ControllerEvent@listadofamilias')->name('eventosfamilia');

Route::get('Eventos/listado/{id}','App\Http\Controllers\ControllerEvent@listadofamilias')->name('eventosfamilianotif');
Route::get('Evento/calendariodocente/{month}','App\Http\Controllers\ControllerEvent@indexmes')->name('calendariodocente');
Route::get('Evento/calendariodirectivo/{month}','App\Http\Controllers\ControllerEvent@indexmes')->name('calendariodirectivo');

Route::put('Eventos/{id}/estadorechazado', 'App\Http\Controllers\ControllerEvent@eventorechazado')->name('rechazarevento');
Route::put('Eventos/{id}/estadoaceptado', 'App\Http\Controllers\ControllerEvent@eventoaceptado')->name('aceptarevento');

Route::delete('evento/{id}/deletevento', 'App\Http\Controllers\ControllerEvent@destroy')->name('deletevento');

// Detalles de evento

Route::get('Evento/form','App\Http\Controllers\ControllerEvent@form');
Route::post('Evento/create','App\Http\Controllers\ControllerEvent@create');

Route::get('Evento/details/{id}','App\Http\Controllers\ControllerEvent@details');
Route::get('Evento/index','App\Http\Controllers\ControllerEvent@index')->name('calendario');
Route::get('Evento/index/{month}','App\Http\Controllers\ControllerEvent@index_month');
Route::post('Evento/calendario','App\Http\Controllers\ControllerEvent@calendario');
Route::get('Evento/{id}/editarevento', 'App\Http\Controllers\ControllerEvent@editarevento')->name('editarevento');
Route::put('Evento/{id}', 'App\Http\Controllers\ControllerEvent@actualizarevento')->name('actualizarevento');

/*Carga de criterios de evaluación*/
Route::get('criteriosevaluacion', 'App\Http\Controllers\CriteriosevaluacionController@index')->name('criteriosevaluacion');
Route::get('criterios/create', 'App\Http\Controllers\CriteriosevaluacionController@create')->name('criteriocreate');
Route::post('criterios/store', 'App\Http\Controllers\CriteriosevaluacionController@store')->name('criterios.store');
Route::delete('criterios/{id}/destroycriterio', 'App\Http\Controllers\CriteriosevaluacionController@destroy')->name('destroycriterio');
Route::get('criterios/{id}/editarcri', 'App\Http\Controllers\CriteriosevaluacionController@editarcriterio')->name('editarcriterio');
Route::put('criterios/{id}', 'App\Http\Controllers\CriteriosevaluacionController@update')->name('criterios.update');

/*Carga de notas*/
Route::get('buscadornotas', 'App\Http\Controllers\NotasController@buscador')->name('buscadornotas');
Route::get('listadonotas', 'App\Http\Controllers\NotasController@index')->name('listadonotas');
Route::put('listadonotas/editarnota/{id_alumno}', 'App\Http\Controllers\NotasController@updatenota')->name('notas.update');
Route::put('listadonotas/editar/{id_alumno}', 'App\Http\Controllers\NotasController@updateobservacion')->name('observacion.update');

/*Registro de asistencias*/

Route::get('asistencias','App\Http\Controllers\AsistenciaController@index')->name('asistencias');
Route::get('asistenciasespe','App\Http\Controllers\AsistenciaController@index')->name('asistencias.especiales');
Route::get('listadoasistencias','App\Http\Controllers\AsistenciaController@listadoasistencias')->name('listado.asistencias');
Route::get('asistencias/create', 'App\Http\Controllers\AsistenciaController@create')->name('asistencia.create');
Route::post('asistencias/store', 'App\Http\Controllers\AsistenciaController@store')->name('asistencia.store');
Route::get('asistencias/editarasis', 'App\Http\Controllers\AsistenciaController@editarasistencia')->name('asistencia.editar');
Route::put('asistencias/editar', 'App\Http\Controllers\AsistenciaController@update')->name('asistencia.update');
Route::get('asistencias/edita', 'App\Http\Controllers\AsistenciaController@buscador')->name('asistencia.edita');

/*Impresión de libretas*/
Route::get('libretas','App\Http\Controllers\LibretasController@buscador')->name('libretas');
Route::get('listadoalumnos','App\Http\Controllers\LibretasController@index')->name('listadoalumnos');
Route::get('generarlibreta/{nombrecompleto}','App\Http\Controllers\LibretasController@generarlibreta')->name('generarlibreta');
Route::get('informefinal/{nombrecompleto}','App\Http\Controllers\LibretasController@informefinal')->name('informefinal');
Route::get('generartodosinformes','App\Http\Controllers\LibretasController@generartodosinformes')->name('generartodosinformes');
Route::get('compartirinforme/{nombrecompleto}','App\Http\Controllers\LibretasController@compartirinforme')->name('compartirinforme');

/*Visualización asistencias por parte de la familia*/
Route::get('asistenciasalumnos','App\Http\Controllers\AsistenciaFamiliaController@buscador')->name('asistenciasalumnos');
Route::put('enviarjustificacion/{id}', 'App\Http\Controllers\AsistenciaFamiliaController@enviarjustificacion')->name('enviarjustificacion');
Route::get('justificacioninasistencias','App\Http\Controllers\AsistenciaFamiliaController@justificacioninasistencias')->name('justificacioninasistencias');
Route::put('aceptarjustificacion/{id}', 'App\Http\Controllers\AsistenciaFamiliaController@aceptarjustificacion')->name('aceptarjustificacion');
Route::put('descargararchivo/{id}','App\Http\Controllers\AsistenciaFamiliaController@descargararchivo')->name('descargararchivo');
Route::get('busquedasasistencias','App\Http\Controllers\AsistenciaFamiliaController@busquedasasistencias')->name('busquedasasistencias');

/*Información académica*/
Route::get('informacionacademica','App\Http\Controllers\InformacionAcademicaController@buscador')->name('informacionacademica');
Route::get('/autocomplete/alumnos/','App\Http\Controllers\InformacionAcademicaController@getAutocompletealumno')->name('Autocomplete.Alumnos');
Route::get('listadoinfoacademica','App\Http\Controllers\InformacionAcademicaController@index')->name('listadoinfoacademica');
Route::get('linechart','App\Http\Controllers\InformacionAcademicaController@showChart')->name('linechart');

/*Notas finales*/
Route::get('buscadornotasfinales', 'App\Http\Controllers\NotasController@buscadornotasfinales')->name('buscadornotasfinales');
Route::get('listadonotasfinales', 'App\Http\Controllers\NotasController@listadonotasfinales')->name('listadonotasfinales');
//Route::put('listadonotas/editarnota/{id_alumno}', 'App\Http\Controllers\NotasController@updatenota')->name('notas.update');
Route::put('listadonotasfinales/editar/{id_alumnos}', 'App\Http\Controllers\NotasController@updateobservacionfinal')->name('observacionfinal.update');
Route::put('notafinal/editar', 'App\Http\Controllers\NotasController@updatenotafinal')->name('notafinal.update');

/*Pase de grado*/
Route::get('buscadorpasegrado', 'App\Http\Controllers\PaseGradoController@buscador')->name('buscadorpase');
Route::get('listadopasegrado', 'App\Http\Controllers\PaseGradoController@index')->name('listadopase');
Route::put('pasedegrado/{id_alumno}', 'App\Http\Controllers\PaseGradoController@pasedegrado')->name('accionpasegrado');
Route::put('nopasedegrado/{id_alumno}', 'App\Http\Controllers\PaseGradoController@nopasedegrado')->name('nopasegrado');

Route::put('modificarpasedegrado/{id_alumno}', 'App\Http\Controllers\PaseGradoController@modificarpasedegrado')->name('modificarpasegrado');
Route::put('modificarnopasedegrado/{id_alumno}', 'App\Http\Controllers\PaseGradoController@modificarnopasedegrado')->name('modificarnopasegrado');

Route::put('pasartodos', 'App\Http\Controllers\PaseGradoController@pasartodos')->name('pasartodos');
Route::put('nopasartodos', 'App\Http\Controllers\PaseGradoController@nopasartodos')->name('nopasartodos');