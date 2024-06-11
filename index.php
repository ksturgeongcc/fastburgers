<?php
include 'partials/header.php';
?>

<div class="relative bg-yellow-50 min-h-screen flex items-center overflow-hidden">
    <div class="container m-auto px-6 md:px-12 lg:px-7">
        <div class="flex items-center flex-wrap px-2 md:px-0">
            <div class="relative lg:w-6/12 lg:py-24 xl:py-32 text-center w-full">
                <h1 class="font-bold text-4xl text-yellow-900 md:text-5xl">Fast Burgers</h1>
                <h2 class="font-bold text-2xl text-yellow-700 md:text-3xl mt-6">Admin Panel</h2>
                <a href="<?= BASE_PATH ?>dashboard" class="inline-flex justify-center items-center py-3 px-5 mt-12 text-base font-medium text-center text-white rounded-full bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300">
                    Dashboard
                </a>
            </div>
            <div class="ml-auto lg:w-6/12 lg:absolute lg:top-0 lg:right-0">
                <img src="https://tailus.io/sources/blocks/food-delivery/preview/images/food.webp" class="relative" alt="food illustration" loading="lazy" width="4500" height="4500">
            </div>
        </div>
    </div>
</div>