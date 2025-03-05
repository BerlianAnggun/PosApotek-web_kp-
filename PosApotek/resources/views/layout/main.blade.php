<!--
=========================================================
* Soft UI Dashboard Tailwind - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
@include('layout.header')

  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500"> 
    @include('layout.navbar')


      <!-- cards -->
     
      <!-- end cards -->
@yield('content')
  
  </body>
  </main>
  @include('layout.script')
  
</html>
