<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create database if it doesnt exists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = Config::get('database.connections.pgsql.database');
        $host = Config::get('database.connections.pgsql.host');
        $port = Config::get('database.connections.pgsql.port');
        $username = Config::get('database.connections.pgsql.username');
        $password = Config::get('database.connections.pgsql.password');

        // Temporarily set the database to 'postgres' for creating the new database
        Config::set('database.connections.pgsql.database', 'postgres');
        $connection = DB::connection('pgsql');

        $exists = $connection->select("SELECT 1 FROM pg_database WHERE datname = ?", [$database]);

        if (empty($exists)) {
            $connection->statement("CREATE DATABASE \"$database\"");
            $this->info("Database '$database' created successfully.");
        } else {
            $this->info("Database '$database' already exists.");
        }

        // Restore the original database configuration
        Config::set('database.connections.pgsql.database', $database);

        return 0;
    }
}
