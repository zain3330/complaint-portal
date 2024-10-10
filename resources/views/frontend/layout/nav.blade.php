<nav class="bg-[#348C4B] shadow-md">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('complaint.index') }}">
                <img src="https://www.niu.edu.pk/wp-content/uploads/2024/09/NIU-Logo-h-w.png" alt="NIU Care Logo" class="h-16">
            </a>
        </div>

        <!-- Hamburger Icon for Mobile View -->
        <div class="md:hidden">
            <button id="menu-btn" class="text-white focus:outline-none">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('complaint.register') }}" class="text-white text-sm font-semibold hover:white-500 px-6 py-3">REGISTER COMPLAINT</a>
            <a href="{{ route('complaint.statusForm') }}" class="text-white text-sm font-semibold bg-blue-600 px-6 py-3 rounded-full hover:bg-blue-900">COMPLAINT STATUS</a>
            <a href="{{ route('dashboard') }}" class="text-white text-sm font-semibold bg-red-600 px-6 py-3 rounded-full hover:bg-red-900">ADMIN LOGIN</a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#348C4B] p-4 rounded-lg shadow-lg">
        <a href="{{ route('complaint.register') }}" class="block text-[#348C4B] text-sm font-semibold px-4 py-2 rounded-lg bg-white hover:bg-[#2b703c] hover:text-white mb-2 transition-all duration-300 ease-in-out">REGISTER COMPLAINT</a>
        <a href="{{ route('complaint.statusForm') }}" class="block text-[#348C4B] text-sm font-semibold px-4 py-2 rounded-lg bg-white hover:bg-[#2b703c] hover:text-white mb-2 transition-all duration-300 ease-in-out">COMPLAINT STATUS</a>
        <a href="{{ route('dashboard') }}" class="block text-[#348C4B] text-sm font-semibold px-4 py-2 rounded-lg bg-white hover:bg-[#2b703c] hover:text-white transition-all duration-300 ease-in-out">ADMIN LOGIN</a>
    </div>

</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
