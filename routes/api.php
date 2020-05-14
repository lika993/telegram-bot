<?php
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\QrCodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/code', function(Request $request) {
	$client = new Client();
	$data = urlencode("https://www.php.net/manual/ru/function.urlencode.php");
		$response = $client->get(
			'http://api.qrserver.com/v1/create-qr-code',
			['query'   => ["data" =>  $request->data, "size" => "320x320"]]);

	return $response;
});

Route::get('/test', function(Request $request) {
	$codeMake = new QrCodeController();
	
 	return $codeMake->createCode($request);
});