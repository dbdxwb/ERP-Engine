<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{config('app.name')}}安装向导</title>
    <script defer src="https://lib.baomitu.com/alpinejs/3.2.3/cdn.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        {!! file_get_contents(base_path('vendor/dev-engine/installer/tailwind.css')) !!}
    </style>
</head>
<body class="bg-gray-200 mx-5">

<div class="max-w-screen-lg mx-auto">

  <div class="text-center py-10">
    <div class="text-2xl text-gray-800">欢迎使用{{config('app.name')}}</div>
    <div class="text-base max-w-screen-md mx-auto text-gray-400 mt-2">基于 DevEngine 项目的定制化系统，拥有更快、更便捷、易开发的定制化使用体验。</div>
  </div>

  <div class="bg-white shadow rounded flex  divide-x divide-gray-200 py-4">
    <div class="{{isActive('DevEngineInstaller::welcome', 'flex-auto')}} flex justify-start items-center px-4 space-x-4">
        <div class="{{isActive('DevEngineInstaller::welcome') ? 'bg-blue-600 text-white shadow' : 'text-gray-500'}} p-3 rounded-full ">
            <svg class="w-5 h-5 stroke-current" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="4" width="32" height="40" rx="2" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4H25V20L20.5 16L16 20V4Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 28H26" stroke-width="4" stroke-linecap="round"/><path d="M16 34H32" stroke-width="4" stroke-linecap="round"/></svg>
        </div>
        @if(isActive('DevEngineInstaller::welcome'))
          <div>
              <div class="text-blue-600 text-sm">Step 1/5</div>
              <div class="text-sm">使用协议</div>
          </div>
        @endif
    </div>
    <div class="{{isActive('DevEngineInstaller::requirements', 'flex-auto')}} flex justify-start items-center px-4 space-x-4">
      <div class="{{isActive('DevEngineInstaller::requirements') ? 'bg-blue-600 text-white shadow' : 'text-gray-500'}} p-3 rounded-full ">
        <svg class="w-5 h-5 stroke-current" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 11L24 4L31 11L24 18L17 11Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M30 25L37 18L44 25L37 32L30 25Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 37L24 30L31 37L24 44L17 37Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 24L11 17L18 24L11 31L4 24Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      @if(isActive('DevEngineInstaller::requirements'))
        <div>
          <div class="text-blue-600 text-sm">Step 2/5</div>
          <div class="text-sm">组件检查</div>
        </div>
      @endif
    </div>
    <div class="{{isActive('DevEngineInstaller::permissions', 'flex-auto')}} flex justify-start items-center px-4 space-x-4">
      <div class="{{isActive('DevEngineInstaller::permissions') ? 'bg-blue-600 text-white shadow' : 'text-gray-500'}} p-3 rounded-full ">
        <svg class="w-5 h-5 stroke-current" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 10H6C4.89543 10 4 10.8954 4 12V38C4 39.1046 4.89543 40 6 40H42C43.1046 40 44 39.1046 44 38V35.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 23H18" stroke-width="4" stroke-linecap="round"/><path d="M10 31H34" stroke-width="4" stroke-linecap="round"/><circle cx="34" cy="16" r="6" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M44.0001 28.4187C42.0469 24.6023 38 22 34 22C30 22 28.0071 23.1329 25.9503 25" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      @if(isActive('DevEngineInstaller::permissions'))
        <div>
          <div class="text-blue-600 text-sm">Step 3/5</div>
          <div class="text-sm">权限检查</div>
        </div>
      @endif
    </div>

    <div class="{{isActive('DevEngineInstaller::environment', 'flex-auto')}} flex justify-start items-center px-4 space-x-4">
      <div class="{{isActive('DevEngineInstaller::environment') ? 'bg-blue-600 text-white shadow' : 'text-gray-500'}} p-3 rounded-full ">
        <svg class="w-5 h-5 stroke-current" width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><g><rect width="48" height="48" fill="white" fill-opacity="0.01" stroke-linejoin="round" stroke-width="4" stroke="none" fill-rule="evenodd"/><g transform="translate(4.000000, 4.000000)"><polygon fill="none" points="20 1.74860126e-15 14 6 6 6 6 14 1.74860126e-15 20 6 26 6 34 14 34 20 40 26 34 34 34 34 26 40 20 34 14 34 6 26 6" stroke-linejoin="round" stroke-width="4" fill-rule="nonzero"/><circle fill="none" cx="20" cy="20" r="6" stroke-linejoin="round" stroke-width="4" fill-rule="nonzero"/></g></g></svg>
      </div>
      @if(isActive('DevEngineInstaller::environment'))
        <div>
          <div class="text-blue-600 text-sm">Step 4/5</div>
          <div class="text-sm">安装配置</div>
        </div>
      @endif
    </div>

    <div class="{{isActive('DevEngineInstaller::final', 'flex-auto')}} flex justify-start items-center px-4 space-x-4">
      <div class="{{isActive('DevEngineInstaller::final') ? 'bg-blue-600 text-white shadow' : 'text-gray-500'}} p-3 rounded-full ">
        <svg class="w-5 h-5 stroke-current" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24 4L29.2533 7.83204L35.7557 7.81966L37.7533 14.0077L43.0211 17.8197L41 24L43.0211 30.1803L37.7533 33.9923L35.7557 40.1803L29.2533 40.168L24 44L18.7467 40.168L12.2443 40.1803L10.2467 33.9923L4.97887 30.1803L7 24L4.97887 17.8197L10.2467 14.0077L12.2443 7.81966L18.7467 7.83204L24 4Z" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 24L22 29L32 19" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      @if(isActive('DevEngineInstaller::final'))
        <div>
          <div class="text-blue-600 text-sm">Step 5/5</div>
          <div class="text-sm">安装完成</div>
        </div>
      @endif
    </div>
  </div>

<div class="mt-4">
  @yield('container')
</div>
</div>

@yield('scripts')
</body>
</html>
