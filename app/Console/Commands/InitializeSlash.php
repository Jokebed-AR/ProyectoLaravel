<?php

namespace App\Console\Commands;

use App\Models\Form;
use App\Models\Group;
use App\Models\Resource;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InitializeSlash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slash:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para inicializar un proyecto';

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
//        $output = exec('composer install');
//        $this->comment($output);
        $output = shell_exec('php artisan key:generate');
        $this->comment($output);
        $output =  exec('php artisan nova:install');
        $this->comment($output);
        $output = shell_exec('php artisan migrate');
        $this->comment($output);
        $name = $this->ask('Nombre del usuario?');
        $email = $this->ask('Correo del usuario?');
        $password = $this->ask('Contraseña del usuario?');
        if(User::where('email', $email)->exists()){
            $this->error('Ya hay un usuario asignado con ese correo.');
        }else{
            $user = User::create([
                'name' => $name,
                'email' =>$email,
                'password' => Hash::make($password),
            ]);
            $user->is_super = true;
            $user->save();
        }

        Resource::createResources();
        $this->comment('Módulos creados exitósamente');
        Form::createForms();
        $this->comment('Colecciones de datos creadas exitósamente');
        Group::createGroups();
        $this->comment('Grupos creados exitósamente');
         $this->info('Proyecto inicializado exitósamente.');
    }
}
