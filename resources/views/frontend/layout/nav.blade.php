<nav class="bg-[#348C4B] shadow-md">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('complaint.index') }}"> <!-- This is the clickable link -->
                <img src="https://www.niu.edu.pk/wp-content/uploads/2024/09/NIU-Logo-h-w.png" alt="NIU Care Logo" class="h-16">
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('complaint.register') }}" class="text-white text-sm font-semibold hover:white-500 px-6 py-3 ">REGISTER COMPLAINT</a>
            <a href="{{ route('complaint.statusForm') }}" class="text-white text-sm font-semibold bg-blue-600 px-6 py-3 rounded-full hover:bg-blue-900">COMPLAINT STATUS</a>
            <!-- Admin Dashboard Login Button -->
            <a href="{{ route('dashboard') }}" class="text-white text-sm font-semibold bg-red-600 px-6 py-3 rounded-full hover:bg-red-900">ADMIN LOGIN</a>
        </div>
    </div>
</nav>

