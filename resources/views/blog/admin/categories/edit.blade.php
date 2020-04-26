@extends('layouts.app')

@section('content')
    @php /** \App\Models\BlogCategory $item */ @endphp
    <div class="container">
        @include('blog.admin.categories.includes.result_messages')

        @if ($item->exists)
            <form method="post" action="{{ route('blog.admin.categories.update', $item->id) }}">
                @method('PATCH')
        @else
            <form method="post" action="{{ route('blog.admin.categories.store') }}">
        @endif
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('blog.admin.categories.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('blog.admin.categories.includes.item_edit_add_col')
                    </div>
                </div>
            </form>

        @if ($item->exists)
            @include('blog.admin.categories.includes.delete')
        @endif
    </div>
@endsection
