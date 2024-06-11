<!-- Navigation Component -->
<nav class="w-full bg-yellow-50">
    <div class="container m-auto px-2 md:px-12 lg:px-7">
        <div class="flex flex-wrap items-center justify-between py-3 gap-6 md:py-4 md:gap-0">
            <div class="w-full px-6 flex justify-between lg:w-max md:px-0">
                <a href="<?= BASE_PATH ?>index" aria-label="logo" class="flex space-x-2 items-center">
                    <img src="https://tailus.io/sources/blocks/food-delivery/preview/images/icon.png" class="w-16" alt="tailus logo" width="144" height="133">
                    <span class="text-4xl font-bold text-yellow-900">Fast <span class="text-yellow-700">Burger</span></span>
                </a>

                <button aria-label="humburger" id="hamburger" class="relative w-10 h-10 -mr-2 lg:hidden focus:outline-none">
                    <div aria-hidden="true" id="line1" class="inset-0 w-6 h-0.5 m-auto rounded bg-yellow-900 transition duration-300"></div>
                    <div aria-hidden="true" id="line2" class="inset-0 w-6 h-0.5 mt-2 m-auto rounded bg-yellow-900 transition duration-300"></div>
                    <div aria-hidden="true" id="line3" class="inset-0 w-6 h-0.5 mt-2 m-auto rounded bg-yellow-900 transition duration-300"></div>
                </button>
            </div>

            <div id="menu" class="hidden w-full lg:flex flex-wrap justify-end items-center space-y-6 p-6 rounded-xl bg-yellow-50 md:space-y-0 md:p-0 md:flex-nowrap lg:w-7/12">
                <div class="flex flex-col lg:flex-row lg:space-x-4 w-full lg:w-auto">
                    <a href="<?= BASE_PATH ?>dashboard" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</a>
                    <a href="<?= BASE_PATH ?>menu" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Menu</a>
                    <a href="<?= BASE_PATH ?>orders" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Orders</a>
                    <a href="<?= BASE_PATH ?>stock" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Stock</a>
                    <a href="<?= BASE_PATH ?>staff" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Staff</a>
                    <a href="<?= BASE_PATH ?>shifts" class="px-3 py-2 rounded-md text-lg leading-5 font-medium text-gray-800 font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700">Staff Shifts</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('hamburger').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
