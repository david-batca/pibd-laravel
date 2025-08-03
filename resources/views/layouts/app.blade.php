<!DOCTYPE html>
<html lang="ro" class="overflow-y-scroll">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
      window.routes = {
        artistDelete: '{{ route('artist.delete', ':id') }}',
        artistFind: '{{ route('artist.find', ':id') }}',
        artistUpdate: '{{ route('artist.update', ':id') }}',
        artistDelete: '{{ route('artist.delete', ':id') }}',
      };
    </script>
  </head>

  <body class="h-screen flex flex-col overflow-hidden">
    <header class="navbar bg-error h-20 sticky top-0 z-10">
      <div id="toggle_button" class="w-80 pl-3">
        <button class="btn btn-error btn-circle" onclick="toggleSidebar()">
          <i class="mdi mdi-menu text-2xl text-black"></i>
        </button>
      </div>
      <div id="header_title" class="text-black text-2xl">Bazar de muzica</div>
    </header>

    <main class="flex flex-1 overflow-hidden">
      <aside id="sidebar" class="menu w-80 px-5 bg-error h-full sticky top-20 overflow-auto">
        <ul class="text-black">
          <li class="mb-4">
            <a href="{{ route('home') }}" @class(['text-xl', 'menu-active' => request()->routeIs('home')])>Acasa</a>
          </li>
          <li class="mb-4">
            <a href="{{ route('artists.index') }}" @class(['text-xl', 'menu-active' => request()->routeIs('artists.*')])>Artisti</a>
          </li>
          <li>
            <a href="{{ route('songs.index') }}" @class(['text-xl', 'menu-active' => request()->routeIs('songs.*')])>Melodii</a>
          </li>
        </ul>
      </aside>

      <section class="flex-1 overflow-auto bg-error h-full">
        <div id="main_content" class="bg-base-100 h-full rounded-tl-2xl p-4">
          @yield('content')
        </div>
      </section>
    </main>

    @stack('scripts')
  </body>

  <script>
    let showMenu = true;

    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main_content');
    const toggleButton = document.getElementById('toggle_button');
    const headerTitle = document.getElementById('header_title');

    const toggleSidebar = () => {
      showMenu = !showMenu;

      sidebar.classList.toggle('w-80', showMenu);
      sidebar.classList.toggle('hidden', !showMenu);

      mainContent.classList.toggle('rounded-tl-2xl', showMenu);

      toggleButton.classList.toggle('w-80', showMenu);

      headerTitle.classList.toggle('ml-5', !showMenu);
    }
  </script>

</html>
