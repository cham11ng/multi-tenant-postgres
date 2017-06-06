@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tenants</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                            </tr>
                            @foreach($tenants as $key => $tenant)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $tenant->schema_name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
