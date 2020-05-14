<?php

	
	use GuzzleHttp\Client;
	use App\TelegramUser;
	
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/adminer', function () {
   
});

Route::post('/bot', function () {
	$client = new Client();
	$request = $client->get('http://newsapi.org/v2/top-headlines?apiKey=key&country=ru');
	$articles = json_decode($request->getBody(), true)['articles'];
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if($data['message']['text'] == '/start'){
		$id = $data['message']['chat']['id'];
		if(App\TelegramUser::where('telegram_id', $id)->count() == 0){
			$categories = App\TelegramCategory::all();
			var_dump($categories);

			$msg = 'Выберите интересующую Вас категорию для рассылки новостей бота' . "\n";
			foreach ($categories as $category) {
				$msg .= "/" . $category['name'] . "\n";
			}
			//$msg = 'Вы только что подписались на рассылку новостей бота';
			$client->post('https://api.telegram.org/botK/sendMessage', ['form_params' => array(
			'chat_id' => $id,
			'text' => $msg
			)]);
			//App\TelegramUser::create(['telegram_id' => $id]);
		} else {
			$msg = 'Вы уже подписаны на эту рассылку';
			$client->post('https://api.telegram.org/botK/sendMessage', ['form_params' => array(
			'chat_id' => $id,
			'text' => $msg
			)]);
		}
	} else if($data['message']['text'] == '/stop'){
		$id = $data['message']['chat']['id'];
		 App\TelegramUser::where(['telagram_id' => $id])->delete();
		 $client->post('https://api.telegram.org/botK/sendMessage', ['form_params' => array(
			'chat_id' => $id,
			'text' => 'Вы отписались от рассылки'
			)]);
	} else {
		if(preg_match('/\//', $data['message']['text'])){
				$cat = explode("/",  $data['message']['text'])[1];
				$id = $data['message']['chat']['id'];
				$client->post('https://api.telegram.org/botK/sendMessage', ['form_params' => array(
				'chat_id' => $id,
				'text' => "Вы успешно подписались на рассылку новостей категории " . $cat
				)]);
		}
	}
	
	if($data['message']['text'] == 'привет'){
		\Log::info($data['message']['chat']['id']);
		foreach ($articles as $article) {
			$response = array(
			'chat_id' => '312610535',
			'text' => $article['url']
			);	
			$client->post('https://api.telegram.org/botK/sendMessage', ['form_params' => $response]);
		}
	}	
});
