<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login Page | Authentication</title>
    <!-- CSS files -->
    <link rel="stylesheet" href="/mycss/mystyle.css">
    <link href="/assets/demo/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="/assets/demo/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="/assets/demo/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="/assets/demo/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="/assets/demo/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
        background-color: #EEEEEE;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1467' height='1467' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='88' y1='88' x2='0' y2='0'%3E%3Cstop offset='0' stop-color='%23004dae'/%3E%3Cstop offset='1' stop-color='%233e7be5'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='75' y1='76' x2='168' y2='160'%3E%3Cstop offset='0' stop-color='%23868686'/%3E%3Cstop offset='0.09' stop-color='%23ababab'/%3E%3Cstop offset='0.18' stop-color='%23c4c4c4'/%3E%3Cstop offset='0.31' stop-color='%23d7d7d7'/%3E%3Cstop offset='0.44' stop-color='%23e5e5e5'/%3E%3Cstop offset='0.59' stop-color='%23f1f1f1'/%3E%3Cstop offset='0.75' stop-color='%23f9f9f9'/%3E%3Cstop offset='1' stop-color='%23FFFFFF'/%3E%3C/linearGradient%3E%3Cfilter id='c' x='0' y='0' width='200%25' height='200%25'%3E%3CfeGaussianBlur in='SourceGraphic' stdDeviation='12' /%3E%3C/filter%3E%3C/defs%3E%3Cpolygon fill='url(%23a)' points='0 174 0 0 174 0'/%3E%3Cpath fill='%23000' fill-opacity='0.87' filter='url(%23c)' d='M121.8 174C59.2 153.1 0 174 0 174s63.5-73.8 87-94c24.4-20.9 87-80 87-80S107.9 104.4 121.8 174z'/%3E%3Cpath fill='url(%23b)' d='M142.7 142.7C59.2 142.7 0 174 0 174s42-66.3 74.9-99.3S174 0 174 0S142.7 62.6 142.7 142.7z'/%3E%3C/svg%3E");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: top left;
      }

      .card{
        position: relative;
        left: 150px;
        /* background: red; */
        padding: 70px 0px 70px 0px;
      }
      
      .for-logo{
        position: relative;
        z-index: 999;
        right: 400px;
        bottom: 500px;
      }
      
     
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="/assets/demo/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>


        <div class="card card-md">
          
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Login Forms</h2>
            <form action="/loginrequest" method="get">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input value="{{ old('email') }}" type="email" class="form-control" placeholder="your@email.com" autocomplete="off" required name="email">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control"  placeholder="Your password"  autocomplete="off" required name="password">
                  <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                  </span>
                </div>
              </div>
              
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Go !</button>
                @if(session()->has('Login Gagal'))
        <div class="alert mt-5 bg-danger text-light alert-dismissible fade show">
          {{ session('Login Gagal') }}
          <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>        
      @endif
              </div>
            </form>
          </div>
        
      </div>

      <div class="for-logo">
        <img src="/icon/toe-logo-removed.png" alt="">

      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/assets/demo/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="/assets/demo/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>

