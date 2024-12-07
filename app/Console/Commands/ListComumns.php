<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ListComumns extends Command
{
    protected $signature = 'db:list-columns {table}';
    protected $description = 'Liste les colonnes d\'une table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = $this->argument('table');
        $columns = Schema::getColumnListing($table);

        foreach ($columns as $column) {
            $this->info($column);
        }

        return 0;
    }
}
