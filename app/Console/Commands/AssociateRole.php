<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssociateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:associate-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command allows you to add a role to a user without going to the database or interface.';

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
        $email = $this->argument('email');
        $role = $this->argument('role');

        $confirm = $this->confirm("Are you sure you want to add the role (".$role.") to the user (". $email.")");

        if ($confirm)
        {
            $user = User::where('email', $email)->first();
            $user->assignRole(Role::where('name', $role)->first());
            $this->info("The role has been added.");
        }

        return 0;
    }
}
