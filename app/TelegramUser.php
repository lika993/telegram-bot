<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
	

   protected $table = 'telegram_users';

    public $timestamps = false;

    protected $primaryKey = 'telegram_id';

    public function categories()
    {
    	return $this->belongsToMany('App\TelegramUser', 'telegram_users_telegram_categories');
    }
}
