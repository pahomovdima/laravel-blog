@extends('layouts.admin')

@section('content')
    <div class="container">
        <nav id="sidebar">
            <ul class="list-unstyled components mb-5">
                @foreach ($menu as $val)
                    @if ($val['childs'])
                        <li>
                            <a href="#{{ $val['url'] }}"
                               data-toggle="collapse"
                               aria-expanded="false"
                               class="dropdown-toggle collapsed">{{ $val['name'] }}
                            </a>
                            <ul class="list-unstyled collapse" id="{{ $val['url'] }}" style="">
                                @foreach ($val['childs'] as $val)
                                    <li>
                                        <a href="{{ $val['url'] }}">{{ $val['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ $val['url'] }}">{{ $val['name'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
@endsection
