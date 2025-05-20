@php
    $grupoTareas = [];

    // Para todos (público o autenticado)
    $grupoTareas[] = [
        'nombre' => 'Dashboard',
        'icono' => 'home',
        'ruta' => route('home'),
        'current' => request()->routeIs('home'),
    ];

      // Si el usuario está autenticado
      if (auth()->check()) {
          $grupoTareas[] = [
              'nombre' => 'Tareas',
              'icono' => 'clipboard-document-list',
              'ruta' => route('tareas.index'),
            'current' => request()->routeIs('tareas.*'),
          ];
      }

    // Agrupamos
    $groups = [
        'Tareas' => $grupoTareas,
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!--SweetArlert2-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- CSS de Quill directamente -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <!--JQUERY-->
        <script src="{{ asset('vendor/jquery/jquery-3.7.1.js') }}"></script>
        <!-- jQuery UI CSS-->
        <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui-1.14.1/jquery-ui.min.css') }}">


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxAppearance

    </head>

    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <!--LOGOTIPO-->
            <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                {{-- <--RUTA DEL LOGOTIPO--> --}}
                <x-app-logo />
            </a>

            <!----NAV FLUX ICONO---->
            <flux:navlist variant="outline">
                <!----LINKS---->
                @foreach ($groups as $group => $links)
                    
                    <flux:navlist.group :heading="$group" class="grid">

                        @foreach ($links as $link)

                            <flux:navlist.item :icon="$link['icono']" :href="$link['ruta']" :current="$link['current']" wire:navigate>{{ $link['nombre'] }}
                            </flux:navlist.item>

                        @endforeach
                        
                    </flux:navlist.group>
                
                @endforeach
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu MENU INFERIOR DESPLEGABLE-->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Opciones') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu MENU CUANDO MINIMIZAMOS LA PANTALLA-->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Opciones') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

            <div class="text-left w-full px-4 py-2 bg-blue-100 text-blue-800 text-sm rounded mb-4 shadow-sm">
                <h1 class="font-semibold">
                    ¡Bienvenido a la gestion de tareas{{ auth()->check() ? ', ' . auth()->user()->name : '' }}!
                </h1>
            </div>
        

        <flux:main>
            {{ $slot }}
        </flux:main>

        @fluxScripts
        <!--DEFINIMOS EN MI PLANTILLA PRINCIPAL LOS ALERTAS DE SWEETALERT Y CONTENIDO JS-->
        @stack('js')

        @if(session('swa1'))

            <script>
                Swal.fire(@json(session('swa1')));
            </script>
            
        @endif
    </body>
</html>

