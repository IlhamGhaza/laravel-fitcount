<header class="Navbar"
    style="width: 100%; max-width: 1440px; height: 79px; position: relative; background: white; margin: 0 auto;">
    <a href="{{ route('home') }}" style="text-decoration: none;">
        <div class="Fitcount" style="width: 197px; height: 40px; left: 5%; top: 19px; position: absolute;">
            <span
                style="color: black; font-size: clamp(24px, 3vw, 36px); font-family: 'Poppins', sans-serif; font-weight: 800; word-wrap: break-word">Fit</span>
            <span
                style="color: #A5B987; font-size: clamp(24px, 3vw, 36px); font-family: 'Poppins', sans-serif; font-weight: 800; word-wrap: break-word">C</span>
            <span
                style="color: black; font-size: clamp(24px, 3vw, 36px); font-family: 'Poppins', sans-serif; font-weight: 800; word-wrap: break-word">ount</span>
        </div>
    </a>

    <!-- Desktop Menu Items -->
    <div class="menu-container" style="display: flex; position: absolute; right: 200px; top: 22px; gap: 30px;">
        <a href="{{ route('home') }}" style="text-decoration: none;">
            <div class="Utama"
                style="text-align: center; color: black; font-size: clamp(16px, 1.5vw, 20px); font-family: 'Poppins', sans-serif; font-weight: 600; transition: color 0.3s;">
                Utama</div>
        </a>
        <a href="{{ route('hitung') }}" style="text-decoration: none;">
            <div class="Hitung"
                style="text-align: center; color: black; font-size: clamp(16px, 1.5vw, 20px); font-family: 'Poppins', sans-serif; font-weight: 600; transition: color 0.3s;">
                Hitung</div>
        </a>
        <a href="{{ route('tentang') }}" style="text-decoration: none;">
            <div class="Tentang"
                style="text-align: center; color: black; font-size: clamp(16px, 1.5vw, 20px); font-family: 'Poppins', sans-serif; font-weight: 600; transition: color 0.3s;">
                Tentang</div>
        </a>
        <a href="{{ route('komunitas') }}" style="text-decoration: none;">
            <div class="Komunitas"
                style="text-align: center; color: black; font-size: clamp(16px, 1.5vw, 20px); font-family: 'Poppins', sans-serif; font-weight: 600; transition: color 0.3s;">
                Komunitas</div>
        </a>
    </div>

    <!-- User Avatar -->
    <a href="{{ route('check.auth') }}" style="text-decoration: none;">
        <div class="Ellipse1"
            style="width: 48px; height: 48px; position: absolute; right: 5%; top: 15px; cursor: pointer;">
            @auth
                <img src="{{ Auth::user()->avatar }}" alt="Profile" class="object-cover w-full h-full rounded-full">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>            @endauth
        </div>
    </a>


    <!-- Mobile Hamburger Icon -->
    <div
        style="display: none; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer; @media (max-width: 1024px) { display: block; }">
        <button id="hamburger" style="background: none; border: none; padding: 10px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        style="display: none; position: absolute; top: 79px; left: 0; width: 100%; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 1000;">
        <a href="{{ route('home') }}"
            style="display: block; padding: 15px 20px; text-decoration: none; color: black; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #eee;">Utama</a>
        <a href="{{ route('hitung') }}"
            style="display: block; padding: 15px 20px; text-decoration: none; color: black; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #eee;">Hitung</a>
        <a href="{{ route('tentang') }}"
            style="display: block; padding: 15px 20px; text-decoration: none; color: black; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #eee;">Tentang</a>
        <a href="{{ route('komunitas') }}"
            style="display: block; padding: 15px 20px; text-decoration: none; color: black; font-family: 'Poppins', sans-serif;">Komunitas</a>
    </div>
</header>

<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburger.addEventListener('click', () => {
        const currentDisplay = mobileMenu.style.display;
        mobileMenu.style.display = currentDisplay === 'none' ? 'block' : 'none';
    });

    // Handle responsive menu visibility on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            mobileMenu.style.display = 'none';
        }
    });
</script>
