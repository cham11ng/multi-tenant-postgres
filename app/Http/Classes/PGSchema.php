<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/**
 * Class Schemas
 * @package App\Http\Schema
 */
class PGSchema
{
    /**
     * List all the tables for a schema
     *
     * @param string $schemaName
     *
     * @return mixed
     */
    protected function listTables($schemaName)
    {
        $tables = DB::table('information_schema.tables')
                    ->select('table_name')
                    ->where('table_schema', '=', $schemaName)
                    ->get();

        return $tables;
    }

    /**
     * Check to see if a table exists within a schema
     *
     * @param string $schemaName
     * @param string $tableName
     *
     * @return bool
     */
    protected function tableExists($schemaName, $tableName)
    {
        $tables = $this->listTables($schemaName);

        return in_array($tableName, $tables->toArray());
    }

    /**
     * List all schemas
     *
     * @return mixed
     */
    public function listSchemas()
    {
        $schemas = DB::table('information_schema.schemata')
                     ->select('schema_name')
                     ->whereNotIn('schema_name', ['pg_catalog', 'pg_toast', 'pg_temp_1', 'pg_toast_temp_1', 'information_schema'])
                     ->get();

        return $schemas;
    }

    /**
     * Check to see if a schema exists
     *
     * @param string $schemaName
     *
     * @return bool
     */
    public function schemaExists($schemaName)
    {
        $schema = DB::table('information_schema.schemata')
                    ->select('schema_name')
                    ->where('schema_name', '=', $schemaName)
                    ->count();

        return ($schema > 0);
    }

    /**
     * Create a new schema
     *
     * @param string $schemaName
     * @return bool
     */
    public function create($schemaName)
    {
        if (!$this->schemaExists($schemaName)) {
            return DB::statement('CREATE SCHEMA ' . $schemaName);
        }

        return false;
    }

    /**
     * Drop an existing schema
     *
     * @param string $schemaName
     * @return bool
     */
    public function drop($schemaName)
    {
        if (!$this->schemaExists($schemaName)) {
            return DB::statement('DROP SCHEMA ' . $schemaName . ' CASCADE');
        }

        return false;
    }

    /**
     * Set the search_path to the schema name
     *
     * @param string|array $schemaName
     */
    public function switchTo($schemaName = 'public')
    {
        if (!is_array($schemaName)) {
            $schemaName = [$schemaName];
        }
        $query = 'SET search_path TO ' . implode(',', $schemaName);

        return DB::statement($query);
    }

    /**
     * Run migrations on a schema
     *
     * @param string $schemaName
     * @param array  $args
     */
    public function migrate($schemaName, $args = [])
    {
        $this->switchTo($schemaName);
        if (!$this->tableExists($schemaName, 'migrations')) {
            Artisan::call('migrate:install');
        }
        Artisan::call('migrate', $args);
    }

    /**
     * Re-run all the migrations on a schema
     *
     * @param string $schemaName
     * @param array  $args
     */
    public function migrateRefresh($schemaName, $args = [])
    {
        $this->switchTo($schemaName);
        Artisan::call('migrate:refresh', $args);
    }

    /**
     * Reverse all migrations on a schema
     *
     * @param string $schemaName
     * @param array  $args
     */
    public function migrateReset($schemaName, $args = [])
    {
        $this->switchTo($schemaName);
        Artisan::call('migrate:reset', $args);
    }

    /**
     * Rollback the latest migration on a schema
     *
     * @param string $schemaName
     * @param array  $args
     */
    public function migrateRollback($schemaName, $args = [])
    {
        $this->switchTo($schemaName);
        Artisan::call('migrate:rollback', $args);
    }

    /**
     * Return the current search path (schema)
     *
     * @return string
     */
    public function getSearchPath()
    {
        $query      = DB::select('show search_path');
        $searchPath = array_pop($query)->search_path;

        return $searchPath;
    }

    /**
     * Create and migrate schema
     *
     * @param        $schemaName
     * @param array  $args
     * @return bool
     */
    public function install($schemaName, $args = [])
    {
        if ($this->create($schemaName)) {
            $this->migrate($schemaName, $args);

            return true;
        }

        return false;
    }
}