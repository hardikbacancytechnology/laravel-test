<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\User;
class SendEmails extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(User $user){
        if($user->sendEmail(User::find($this->argument('user')))){
            $this->info('Mail not sent :-(');
        }else{
            $this->info('Mail sent successfully :-)');
        }
    }
}