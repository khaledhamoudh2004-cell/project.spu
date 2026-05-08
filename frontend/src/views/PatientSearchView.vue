<script setup>
import LogoutButton from "../components/LogoutButton.vue";
</script>
<template>
  <div class="bg-background text-on-background font-body-md min-h-screen pb-20 md:pb-0">
<!-- TopAppBar -->
<header class="hidden md:flex bg-white/95 backdrop-blur-md sticky top-0 z-50 w-full border-b border-outline-variant shadow-[0_-4px_12px_rgba(15,82,186,0.08)]">
<div class="flex items-center justify-between px-6 py-3 w-full max-w-screen-2xl mx-auto">
<div class="flex items-center gap-sm">
<span class="text-xl font-black text-primary tracking-tighter">PharmaLink</span>
</div>
<nav class="flex items-center gap-md">
<a class="font-headline-sm text-headline-sm text-primary border-b-2 border-primary pb-1" href="#">Search</a>
<a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">Nearby</a>
<a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">My Orders</a>
<a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">Profile</a>
</nav>
<div class="flex items-center gap-sm text-primary">
<button class="p-2 hover:bg-surface-variant rounded-full transition-colors cursor-pointer active:opacity-80">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 hover:bg-surface-variant rounded-full transition-colors cursor-pointer active:opacity-80">
<span class="material-symbols-outlined">help</span>
</button>
<LogoutButton class="text-primary" />
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="max-w-screen-xl mx-auto px-4 md:px-margin py-margin md:py-xl">
<!-- Hero Search Section -->
<section class="mb-xl text-center">
<h1 class="font-display-lg text-display-lg text-primary mb-sm">Find Your Medication</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-margin max-w-2xl mx-auto">Locate available prescriptions and over-the-counter drugs at pharmacies near you in real-time.</p>
<div class="bg-surface-container-lowest rounded-xl shadow-[0_-4px_12px_rgba(15,82,186,0.08)] p-sm md:p-md max-w-3xl mx-auto relative z-10">
<div class="flex flex-col md:flex-row gap-sm">
<!-- Search Input -->
<div class="flex-1 relative">
<label class="sr-only font-body-sm text-body-sm font-bold text-on-surface" for="drug-search">Search drug name</label>
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline">search</span>
</div>
<input class="w-full pl-10 pr-4 py-3 border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-transparent placeholder-outline transition-colors" id="drug-search" placeholder="Drug name, brand, or category..." type="text"/>
</div>
<!-- Location Input -->
<div class="md:w-1/3 relative">
<label class="sr-only font-body-sm text-body-sm font-bold text-on-surface" for="location-search">Location</label>
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline">location_on</span>
</div>
<input class="w-full pl-10 pr-4 py-3 border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-transparent placeholder-outline transition-colors" id="location-search" placeholder="Zip or City" type="text" value="Seattle, WA"/>
<button class="absolute inset-y-0 right-0 pr-3 flex items-center text-primary hover:text-primary-container">
<span class="material-symbols-outlined">my_location</span>
</button>
</div>
<button class="bg-primary text-on-primary font-headline-sm text-headline-sm py-3 px-6 rounded-lg hover:bg-primary-container transition-colors shadow-sm flex items-center justify-center gap-xs">
<span>Search</span>
</button>
</div>
<!-- Quick Filters -->
<div class="flex flex-wrap gap-xs mt-sm pt-sm border-t border-outline-variant/30">
<button class="px-3 py-1 rounded-full bg-surface-container text-on-surface font-body-sm text-body-sm hover:bg-surface-variant transition-colors flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">tune</span> Filters
                    </button>
<button class="px-3 py-1 rounded-full border border-outline-variant text-on-surface-variant font-body-sm text-body-sm hover:bg-surface-container transition-colors">24 Hour Pharmacies</button>
<button class="px-3 py-1 rounded-full border border-outline-variant text-on-surface-variant font-body-sm text-body-sm hover:bg-surface-container transition-colors">Drive-Thru</button>
<button class="px-3 py-1 rounded-full border border-outline-variant text-on-surface-variant font-body-sm text-body-sm hover:bg-surface-container transition-colors">Delivery Available</button>
</div>
</div>
</section>
<!-- Results Grid -->
<section>
<div class="flex items-center justify-between mb-md">
<h2 class="font-headline-md text-headline-md text-on-surface">Results for "Amoxicillin"</h2>
<span class="font-body-sm text-body-sm text-on-surface-variant">Showing pharmacies near Seattle, WA</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
<!-- Pharmacy Card 1 (In Stock) -->
<article class="bg-surface-container-lowest rounded-xl shadow-[0_-4px_12px_rgba(15,82,186,0.08)] p-md border border-outline-variant/20 flex flex-col relative overflow-hidden group hover:border-primary-fixed-dim transition-colors">
<div class="flex justify-between items-start mb-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">CVS Pharmacy #1029</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">distance</span> 0.8 miles away
                            </p>
</div>
<div class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full font-label-caps text-label-caps flex items-center gap-1 shrink-0">
<span class="material-symbols-outlined fill-icon" style="font-size: 14px;">check_circle</span> In Stock
                        </div>
</div>
<div class="mb-md">
<p class="font-body-sm text-body-sm text-on-surface mb-1">531 Queen Anne Ave N</p>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">schedule</span> Open until 10:00 PM
                        </p>
</div>
<div class="mt-auto pt-sm border-t border-outline-variant/30 flex items-center justify-between">
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Estimated Price</span>
<span class="font-headline-sm text-headline-sm text-primary">$12.99</span>
</div>
<button class="text-primary font-headline-sm text-headline-sm hover:text-primary-container flex items-center gap-1">
                            View Map <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
</button>
</div>
</article>
<!-- Pharmacy Card 2 (Low Stock) -->
<article class="bg-surface-container-lowest rounded-xl shadow-[0_-4px_12px_rgba(15,82,186,0.08)] p-md border border-outline-variant/20 flex flex-col relative overflow-hidden group hover:border-primary-fixed-dim transition-colors">
<div class="flex justify-between items-start mb-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Walgreens</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">distance</span> 1.2 miles away
                            </p>
</div>
<div class="bg-error-container text-on-error-container px-3 py-1 rounded-full font-label-caps text-label-caps flex items-center gap-1 shrink-0">
<span class="material-symbols-outlined fill-icon" style="font-size: 14px;">warning</span> Low Stock
                        </div>
</div>
<div class="mb-md">
<p class="font-body-sm text-body-sm text-on-surface mb-1">1531 Broadway</p>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">schedule</span> 24 Hours
                        </p>
</div>
<div class="mt-auto pt-sm border-t border-outline-variant/30 flex items-center justify-between">
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Estimated Price</span>
<span class="font-headline-sm text-headline-sm text-primary">$14.50</span>
</div>
<button class="text-primary font-headline-sm text-headline-sm hover:text-primary-container flex items-center gap-1">
                            View Map <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
</button>
</div>
</article>
<!-- Pharmacy Card 3 (Out of Stock) -->
<article class="bg-surface-container-lowest rounded-xl shadow-[0_-4px_12px_rgba(15,82,186,0.08)] p-md border border-outline-variant/20 flex flex-col relative overflow-hidden opacity-75">
<div class="flex justify-between items-start mb-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Bartell Drugs</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">distance</span> 1.5 miles away
                            </p>
</div>
<div class="bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full font-label-caps text-label-caps flex items-center gap-1 shrink-0">
<span class="material-symbols-outlined fill-icon" style="font-size: 14px;">block</span> Out of Stock
                        </div>
</div>
<div class="mb-md">
<p class="font-body-sm text-body-sm text-on-surface mb-1">600 1st Ave N</p>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px;">schedule</span> Open until 9:00 PM
                        </p>
</div>
<div class="mt-auto pt-sm border-t border-outline-variant/30 flex items-center justify-between">
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Estimated Price</span>
<span class="font-body-sm text-body-sm text-outline">N/A</span>
</div>
<button class="text-outline font-headline-sm text-headline-sm cursor-not-allowed flex items-center gap-1" disabled="">
                            View Map <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
</button>
</div>
</article>
</div>
</section>
</main>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 bg-white/90 backdrop-blur-lg border-t border-slate-100 shadow-[0_-4px_12px_rgba(15,82,186,0.08)] rounded-t-2xl pb-safe">
<div class="flex justify-around items-center h-16 px-4">
<!-- Active Item: Search -->
<button class="flex flex-col items-center justify-center text-primary bg-blue-50/50 rounded-xl px-2 py-1 scale-95 transition-transform active:scale-90">
<span class="material-symbols-outlined mb-1">search</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest">Search</span>
</button>
<!-- Inactive Items -->
<button class="flex flex-col items-center justify-center text-slate-400 hover:text-primary transition-colors scale-95 active:scale-90 active:bg-slate-100 rounded-xl px-2 py-1">
<span class="material-symbols-outlined mb-1">distance</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest">Nearby</span>
</button>
<button class="flex flex-col items-center justify-center text-slate-400 hover:text-primary transition-colors scale-95 active:scale-90 active:bg-slate-100 rounded-xl px-2 py-1">
<span class="material-symbols-outlined mb-1">medication</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest">My Orders</span>
</button>
<button class="flex flex-col items-center justify-center text-slate-400 hover:text-primary transition-colors scale-95 active:scale-90 active:bg-slate-100 rounded-xl px-2 py-1">
<span class="material-symbols-outlined mb-1">person_outline</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest">Profile</span>
</button>
</div>
</nav>
  </div>
</template>