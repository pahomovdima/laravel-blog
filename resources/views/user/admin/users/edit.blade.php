@extends('layouts.admin')

@section('content')
    @php /** \App\Models\BlogCategory $item */ @endphp
    <div class="container">
        <nav class="navbar-toggler">
            <a class="btn btn btn-secondary" href="{{ route('admin.users.index') }}">Назад</a>
        </nav>

        @include('user.admin.users.includes.result_messages')

        @if ($item->exists)
            <form method="post" action="{{ route('admin.users.update', $item->id) }}">
                @method('PATCH')
        @else
            <form method="post" action="{{ route('admin.users.store') }}">
        @endif
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('user.admin.users.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('user.admin.users.includes.item_edit_add_col')
                    </div>
                </div>
            </form>

        @if ($item->exists)
            @include('user.admin.users.includes.delete')
        @endif
    </div>
@endsection
