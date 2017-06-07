<?php

namespace App\Http\Controllers;

use App\Http\Facades\PGSchema;
use App\Tenant;
use Illuminate\Http\Request;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = PGSchema::listSchemas();

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
        PGSchema::install($request->name);

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
