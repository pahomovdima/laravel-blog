@extends('layouts.admin')

@section('content')
    @php /** \App\Models\BlogCategory $item */ @endphp
    <div class="container">
        <nav class="navbar-toggler">
            <a class="btn btn btn-secondary" href="{{ route('admin.user_groups.index') }}">Назад</a>
        </nav>

        @include('user.admin.user_groups.includes.result_messages')

        @if ($item->exists)
            <form method="post" action="{{ route('admin.user_groups.update', $item->id) }}">
                @method('PATCH')
        @else
            <form method="post" action="{{ route('admin.user_groups.store') }}">
        @endif
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('user.admin.user_groups.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('user.admin.user_groups.includes.item_edit_add_col')
                    </div>
                </div>
            </form>

        @if ($item->exists)
            @include('user.admin.user_groups.includes.delete')
        @endif
    </div>
@endsection
