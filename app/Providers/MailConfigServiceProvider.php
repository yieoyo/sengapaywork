<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
	   $driver		=	Config::get('Settings.mail_type');
	   $host		=	Config::get('Settings.mail_host');
	   $port		=	Config::get('Settings.mail_port');
	   $encryption	=	Config::get('Settings.smtp_security');
	   $username	=	Config::get('Settings.mail_user_name');
	   $password	=	Config::get('Settings.mail_user_password');
	   
		$config = array(
				'driver'     => $driver,
				'host'       => $host,
				'port'       => $port,
				'from'       => array('address' => null, 'name' => null),
				'encryption' => $encryption,
				'username'   => $username,
				'password'   => $password,
				'sendmail'   => '/usr/sbin/sendmail -bs',
				'pretend'    => false,
			);
			Config::set('mail', $config);


	   /* if (\Schema::hasTable('mails')) {
            $mail = DB::table('mails')->first();
            if ($mail) //checking if table is not empty
            {
                
				
				
				$config = array(
                    'driver'     => $mail->driver,
                    'host'       => $mail->host,
                    'port'       => $mail->port,
                    'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
                    'encryption' => $mail->encryption,
                    'username'   => $mail->username,
                    'password'   => $mail->password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        } */
    }
}