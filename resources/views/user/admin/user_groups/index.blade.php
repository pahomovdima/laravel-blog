@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('user.admin.users.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar-toggler">
                    <a class="btn btn-primary" href="{{ route('admin.user_groups.create') }}">Добавить</a>
                    <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Пользователи</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Дата создания</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($paginator as $userGroup)
                                @php
                                    /** @var \App\Models\BlogPost $post */
                                @endphp
                                <tr>
                                    <td>{{ $userGroup->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.user_groups.edit', $userGroup->id) }}">{{ $userGroup->name }}</a>
                                    </td>
                                    <td>
                                        {{ $userGroup->created_at ? \Carbon\Carbon::parse($userGroup->created_at)->format('d M Y H:i') : '' }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
