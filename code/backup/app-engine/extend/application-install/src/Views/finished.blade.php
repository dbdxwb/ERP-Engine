@extends('application-install::layouts.master')

@section('title')
  安装完成
@endsection


@section('container')

  @if(session('message')['status'] == 'error')
    <div class="bg-white shadow p-6 mb-4 rounded text-sm">
      <div class="text-base mb-4">
        安装失败：
      </div>
      <pre class="p-4 bg-gray-100 overflow-auto text-red-600"><code>{{ session('message')['message'] }}
您可以尝试清空数据库重新安装</code></pre>
    </div>
  @endif

  @if(session('message')['dbOutputLog'])
    <div class="bg-white shadow p-6 mb-4 rounded text-sm">
      <div class="text-base mb-4">
        数据库日志：
      </div>
      <pre class="p-4 bg-gray-100 overflow-auto"><code>{{ session('message')['dbOutputLog'] }}</code></pre>
    </div>
  @endif

  @if($finalMessages)
  <div class="bg-white shadow p-6 mb-4 rounded text-sm">
    <div class="text-base mb-4">
      命令执行：
    </div>
    <pre class="p-4 bg-gray-100 overflow-auto"><code>{{ $finalMessages }}</code></pre>
  </div>
  @endif


  @if($finalStatusMessage)
  <div class="bg-white shadow p-6 mb-4 rounded text-sm">
    <div class="text-base mb-4">
      安装记录：
    </div>
    <pre class="p-4 bg-gray-100 overflow-auto"><code>{{ $finalStatusMessage }}</code></pre>
  </div>
  @endif

  <div class="text-right mb-4">
    @if(session('message')['status'] <> 'error')
      <a href="{{ url('/') }}" class="bg-blue-600 text-white text-sm px-4 py-3  rounded shadow items-center inline-flex hover:shadow-md">
        <div>安装结束</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    @endif
  </div>
@endsection
