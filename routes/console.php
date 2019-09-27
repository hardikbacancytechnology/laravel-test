<?php
use Illuminate\Foundation\Inspiring;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
use App\User;
use Illuminate\Support\Facades\Hash;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('build {project}', function ($project){
    $this->comment("Building {$project}!");
    $name = $this->ask('What is your name?');
    $email = $this->ask('What is your email?');
    if(!FILTER_VAR($email,FILTER_VALIDATE_EMAIL)){
		$this->error('Invalid email');
    }else{
    	$source = $this->choice('Which source would you like to use?', ['master', 'develop']);
	    if ($this->confirm('Do you wish to save changes?')) {
	    	$user = new User;
	    	$user->name = $name;
	    	$user->email = $email;
	    	$user->password = Hash::make(rand());
	    	if($user->save()){
	    		$this->info('Data has been saved!');
	    	}else{
	    		$this->error('Data has been saved!');
	    	}
	    }else{
	    	$this->error('Data not saved');
	    }
    }
})->describe('Build the project');

Artisan::command('view-users',function(){
	$this->output->progressStart(10);
    for ($i = 0; $i < 10; $i++) {
        sleep(1);
        $this->output->progressAdvance();
    }
    $this->output->progressFinish();
	$headers = ['Name', 'Email'];
    $users = App\User::all(['name', 'email'])->toArray();
    $this->table($headers, $users);
});
