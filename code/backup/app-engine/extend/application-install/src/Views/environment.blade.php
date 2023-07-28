@extends('application-install::layouts.master')


@section('title')
    安装配置
@endsection

@section('container')
    <form method="post" action="{{ route('DevEngineInstaller::environmentSave') }}">
        {{ csrf_field()}}
        @foreach($data as $list)
            <div class="bg-white shadow px-6 py-2 rounded text-sm mb-4">
                @foreach($list as $key => $vo)
                    <div class="my-4  {{ $errors->has($key) ? 'text-red-600' : '' }}">
                        <label for="about" class="block text-sm font-medium text-gray-700">
                            {{$vo}}
                        </label>
                        <div class="mt-1">
                            <input type="text" name="{{$key}}" value="{{$env[$key]}}"
                                   class="p-2 shadow-sm focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-blue-600 focus:border-blue-600 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"/>
                        </div>
                        @if ($errors->has($key))
                            <span class="mt-1 text-red-600 block">
                                {{ $errors->first($key) }}
                            </span>
                        @endif

                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white text-sm px-4 py-3  rounded shadow items-center inline-flex hover:shadow-md">
                <div>开始安装</div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </form>
@endsection
