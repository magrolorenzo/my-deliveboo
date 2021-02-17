@extends('layouts.app')

@section('page-title', 'pagina prova')


@section('content')
<div id="app">
  <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container d-flex justify-content-center">

                <div class="input-group w-50">
                    <input type="text" class="form-control" placeholder="Ristoranti, tipi di cucina...">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </div>
                <dish/>
                
            </div>
    </nav>

</div>
@endsection