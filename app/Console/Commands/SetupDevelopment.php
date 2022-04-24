<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SetupDevelopment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configura um ambiente pra evitar ter q criar tudo na mão';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Criando Usuário ...');
        $user = User::create(['username' => 'guidevolio', 'password' => '1234', 'name' => 'Gui Devólio', 'email' => 'devguilhermedevolio@gmail.com']);
        $this->info('Usuário Criado: ' . $user->id);
        $this->info('Criando Permissão Admin:');
        $role = Role::create(['name' => 'admin']);
        $this->info('Adicionando permissão admin para o usuário:' . $user->id);
        $user->assignRole($role);

        return 0;
    }
}
