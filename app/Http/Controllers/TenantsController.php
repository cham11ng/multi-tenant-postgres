<?php

namespace App\Http\Controllers;

use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = DB::table('information_schema.schemata')->select('schema_name')->get();

        return view('tenants.show', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::statement('CREATE SCHEMA ' . $request->name);

        $schemaName = $request->name;
        $query      = 'SET search_path TO ' . $schemaName;
        $result     = DB::statement($query);

        $tables = DB::table('information_schema.tables')
                    ->select('table_name')
                    ->where('table_schema', '=', $schemaName)
                    ->get();

        foreach ($tables as $table) {
            if ($table->table_name === 'migrations') {
                Artisan::call('migrate');

                return redirect('tenants');
            }
        }
        Artisan::call('migrate:install');
        Artisan::call('migrate');

        return redirect('tenants');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tenant              $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
