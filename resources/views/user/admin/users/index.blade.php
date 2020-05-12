@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('user.admin.users.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggler navbar-light">
                    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Создать пользователя</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Группа</th>
                                    <th>Email</th>
                                    <th>Имя</th>
                                    <th>Дата создания</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($paginator as $user)
                                @php
                                    /** @var \App\Models\BlogPost $post */
                                @endphp
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->group_id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a>
                                    </td>
                                    <td>
                                        {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') : '' }}
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
