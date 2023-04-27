@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('USUARIOS') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    
              <table>
                <thead>
                    <tr>
                    <th>usuarios</th>
                    <th>opc</th>
                    </tr>
                
                    
                </thead>
                <tbody>
                    <tr>
                        @foreach($us as $user)

                        <td>{{$user->name}}</td>
                    
                   
                        
                            <td>
                     <a href="{{route('home.delete', $user->id)}}"
                        onclick="event.preventDefault();
                        if(confirm('¿Está seguro de que desea eliminar el producto?')) {
                        document.getElementById('delete-form-{{$user->id}}').submit();
                        }" class="btn  btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                          </svg>
                      </a>
                     <form id="delete-form-{{$user->id}}" action="{{route('home.delete', $user->id)}}"
                        method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                        </form>
                    </td>
                    </tr>
                    @endforeach
                         </tbody>
                        </table> 
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <form method="POST" action="{{ url('/enviar-mensaje') }}">
                @csrf
                <textarea name="mensaje"></textarea>
                <button type="submit">Enviar mensaje</button>
            </form>
        </div>
    </div>
</div>
@endsection
