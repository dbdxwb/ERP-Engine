@extends('application-install::layouts.master')

@section('title')
    安装协议
@endsection
@section('container')
  <div class="bg-white shadow p-6 rounded text-sm">
    <div class="text-base mb-4">
      请仔细阅读协议并遵循协议规则进行使用：
    </div>
      <pre class="p-4 bg-gray-100 overflow-auto">{!! $content !!}</pre>
  </div>

  <div class="text-right py-4">
    <a href="{{ route('DevEngineInstaller::requirements') }}" class="bg-blue-600 text-white text-sm px-4 py-3  rounded shadow items-center inline-flex hover:shadow-md" >
      <div>检查组件</div>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </a>
  </div>
@endsection
