@extends('application-install::layouts.master')

@section('title')
    权限检查
@endsection

@section('container')

  @foreach($folders as $vo)
    <div class="bg-white shadow px-6 py-4 rounded text-sm mb-2 flex items-center">
      <div class="text-gray-600 flex-grow ">
        <div class="text-sm">{{ $vo['folder'] }}</div>
      </div>
      <div class="flex-none text-sm text-gray-900 flex-none {{ $vo['status'] ? 'text-green-600' : 'text-red-600' }}">
        {{$vo['permission']}}
      </div>
    </div>
  @endforeach


  @if ( !$error )
    <div class="text-right py-4">
      <a href="{{ route('DevEngineInstaller::environment') }}"
         class="bg-blue-600 text-white text-sm px-4 py-3  rounded shadow items-center inline-flex hover:shadow-md">
        <div>安装配置</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  @endif

@endsection
