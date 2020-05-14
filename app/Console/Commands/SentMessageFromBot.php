<?php

namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use GuzzleHttp\Client;
    use App\TelegramUser;

class SentMessageFromBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $telegramUsers = \App\TelegramUser::all();
        $client = new Client();
        $request = $client->get('http://newsapi.org/v2/top-headlines?apiKey=6a7aacf41a0a49099eff808b42a16b28&country=ru&category=technology');
        \Log::info(date('h:i:s'));
$articles = json_decode($request->getBody(), true)['articles'];
    $data = file_get_contents('php://input');

            $data = json_decode($data, true);
            
    
           foreach ($telegramUsers as $user) {
                foreach ($articles as $article) {
                    $response = array(
                    'chat_id' => $user->telagram_id,
                    'text' => $article['url']
                    );  
                    $client->post('https://api.telegram.org/bot1127300015:AAEgKSzUy2bWjlcxEBW95ER0EPVTpIeE5I0/sendMessage', ['form_params' => $response]);
                }
           }
    }
}
