@extends('application-install::layouts.master')

@section('title')
  组件检查
@endsection

@section('container')
  @foreach($requirements as $extention => $enabled)
    <div class="bg-white shadow px-6 py-4 rounded text-sm mb-2 flex items-center">
      <div class="text-gray-600 flex-grow ">
        <div class="text-base">{{ $extention }}</div>
        @if($extention === 'php')
          <div>
            <small class="text-gray-400">
              (version {{ $minPHP }} required)
            </small>
          </div>
        @endif
      </div>
      <div class="flex-none text-sm text-gray-900 flex-none {{ $enabled !== false ? 'text-green-600' : 'text-red-600' }}">
        @if($extention === 'php')
          @if($enabled === false)
            {{$currentPHP['version']}}
          @else
            {{$enabled}}
          @endif
        @else
          @if($enabled)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          @endif
        @endif
      </div>
    </div>
  @endforeach

  @if ( !$error )
    <div class="text-right py-4">
      <a href="{{ route('DevEngineInstaller::permissions') }}"
         class="bg-blue-600 text-white text-sm px-4 py-3  rounded shadow items-center inline-flex hover:shadow-md">
        <div>检查权限</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  @endif

@endsection
