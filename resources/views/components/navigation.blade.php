<nav class="bg-gray-800 p-4 text-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-lg font-semibold">PeakPost</a>

        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:underline">Inicio</a></li>

            @auth
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:underline">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:underline">Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}" class="hover:underline">Registrarse</a></li>
            @endauth
        </ul>
    </div>
</nav>
