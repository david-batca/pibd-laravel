<!DOCTYPE html>
<html lang="ro" class="overflow-y-scroll">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar de muzică</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>

  <body class="h-screen flex flex-col overflow-hidden">
    <header class="navbar bg-error h-20 sticky top-0 z-10">
      <div id="toggle_button" class="w-80 pl-3">
        <button class="btn btn-error btn-circle" onclick="toggleSidebar()">
          <i class="mdi mdi-menu text-2xl text-black"></i>
        </button>
      </div>
      <div id="header_title" class="text-black text-2xl">Bazar de muzică</div>
    </header>

    <main class="flex flex-1 overflow-hidden">
      <aside id="sidebar" class="menu w-80 px-5 bg-error sticky top-20 overflow-auto">
        <ul class="text-black">
          <li class="mb-4">
            <a href="{{ route('home') }}" @class(['text-xl', 'menu-active' => request()->routeIs('home')])>
              Acasă
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('artists.index') }}" @class(['text-xl', 'menu-active' => request()->routeIs('artists.*')])>
              Artiști
            </a>
          </li>
          <li>
            <a href="{{ route('songs.index') }}" @class(['text-xl', 'menu-active' => request()->routeIs('songs.*')])>
              Melodii
            </a>
          </li>
        </ul>
      </aside>

      <section class="flex w-full overflow-auto bg-error">
        <div id="main_content" class="flex flex-col w-full relative bg-base-100 rounded-tl-2xl p-4">
          @yield('content')
        </div>
      </section>
    </main>

    @stack('scripts')

    <script>
      let showMenu = true;
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.getElementById('main_content');
      const toggleButton = document.getElementById('toggle_button');
      const headerTitle = document.getElementById('header_title');

      function toggleSidebar() {
        showMenu = !showMenu;
        sidebar.classList.toggle('w-80', showMenu);
        sidebar.classList.toggle('hidden', !showMenu);
        mainContent.classList.toggle('rounded-tl-2xl', showMenu);
        toggleButton.classList.toggle('w-80', showMenu);
        headerTitle.classList.toggle('ml-5', !showMenu);
      }
    </script>
  </body>

</html>
