<script setup>
import LogoutButton from "../components/LogoutButton.vue";
</script>

<template>
  <div class="flex bg-background text-on-background min-h-screen">
<!-- SideNavBar (Web) -->
<nav class="hidden md:flex flex-col bg-slate-50 dark:bg-slate-950 font-manrope antialiased h-screen w-64 fixed left-0 top-0 border-r border-slate-200 dark:border-slate-800 transition-all duration-200 ease-in-out z-40">
<div class="text-lg font-bold text-slate-900 dark:text-white px-4 py-6">
            Management Console
            <div class="font-body-sm text-body-sm text-slate-500 font-normal mt-1">System Administrator</div>
</div>
<div class="flex flex-col space-y-1 p-3 overflow-y-auto flex-grow">
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span>Dashboard</span>
</a>
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-white dark:bg-slate-900 text-blue-700 dark:text-blue-400 font-semibold shadow-sm transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
<span>Inventory</span>
</a>
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">monitoring</span>
<span>Search Trends</span>
</a>
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">local_pharmacy</span>
<span>Pharmacies</span>
</a>
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">group</span>
<span>User Management</span>
</a>
</div>
<div class="p-3 border-t border-slate-200 dark:border-slate-800">
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">support_agent</span>
<span>Support</span>
</a>
<a class="flex items-center space-x-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined">settings</span>
<span>Settings</span>
</a>
</div>
</nav>
<!-- Main Content Area -->
<main class="flex-1 md:ml-64 flex flex-col min-h-screen">
<!-- TopAppBar -->
<header class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md docked full-width top-0 sticky z-50 border-b border-slate-200 dark:border-slate-800 shadow-sm dark:shadow-none flex items-center justify-between px-6 py-3 w-full max-w-screen-2xl mx-auto">
<div class="flex items-center space-x-4">
<div class="text-xl font-black text-blue-700 dark:text-blue-400 tracking-tighter cursor-pointer active:opacity-80">PharmaLink</div>
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
<input class="pl-9 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-full font-body-sm text-body-sm focus:border-blue-700 focus:ring-1 focus:ring-blue-700 outline-none w-64 transition-all" placeholder="Search inventory..." type="text"/>
</div>
</div>
<div class="flex items-center space-x-2 text-blue-700 dark:text-blue-400">
<button class="p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer active:opacity-80">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer active:opacity-80">
<span class="material-symbols-outlined">help</span>
</button>
<LogoutButton class="hover:bg-slate-50 dark:hover:bg-slate-800" />
</div>
</header>
<!-- Content Canvas -->
<div class="p-md md:p-margin flex-1 max-w-screen-2xl mx-auto w-full">
<div class="flex justify-between items-end mb-margin">
<div>
<h1 class="font-headline-md text-headline-md text-on-surface mb-1">Inventory Management</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Monitor stock levels and manage medication availability.</p>
</div>
<button class="bg-primary hover:bg-primary-container text-on-primary font-body-sm text-body-sm font-semibold py-2 px-4 rounded-lg flex items-center shadow-[0_-4px_12px_rgba(15,82,186,0.08)] transition-colors">
<span class="material-symbols-outlined mr-2 text-[18px]">add</span>
                    Add Medication
                </button>
</div>
<!-- Bento Grid Summary -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-margin">
<!-- Alerts Card -->
<div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_-4px_12px_rgba(15,82,186,0.08)] relative overflow-hidden">
<div class="absolute top-0 right-0 w-24 h-24 bg-error-container rounded-bl-full opacity-50"></div>
<div class="flex items-center justify-between mb-sm relative z-10">
<h2 class="font-headline-sm text-headline-sm text-on-surface">Low Stock Alerts</h2>
<span class="material-symbols-outlined text-error">warning</span>
</div>
<div class="text-3xl font-bold text-on-surface mb-2 relative z-10">12</div>
<p class="font-body-sm text-body-sm text-on-surface-variant relative z-10">Items require immediate reordering.</p>
</div>
<!-- Total Inventory Card -->
<div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_-4px_12px_rgba(15,82,186,0.08)] relative overflow-hidden">
<div class="absolute top-0 right-0 w-24 h-24 bg-primary-fixed rounded-bl-full opacity-50"></div>
<div class="flex items-center justify-between mb-sm relative z-10">
<h2 class="font-headline-sm text-headline-sm text-on-surface">Total Items</h2>
<span class="material-symbols-outlined text-primary">inventory_2</span>
</div>
<div class="text-3xl font-bold text-on-surface mb-2 relative z-10">1,458</div>
<p class="font-body-sm text-body-sm text-on-surface-variant relative z-10">Active SKUs in current facility.</p>
</div>
<!-- Recent Changes Card -->
<div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_-4px_12px_rgba(15,82,186,0.08)] relative overflow-hidden">
<div class="absolute top-0 right-0 w-24 h-24 bg-tertiary-fixed rounded-bl-full opacity-50"></div>
<div class="flex items-center justify-between mb-sm relative z-10">
<h2 class="font-headline-sm text-headline-sm text-on-surface">Recent Updates</h2>
<span class="material-symbols-outlined text-tertiary">update</span>
</div>
<div class="text-3xl font-bold text-on-surface mb-2 relative z-10">45</div>
<p class="font-body-sm text-body-sm text-on-surface-variant relative z-10">Modifications in the last 24 hours.</p>
</div>
</div>
<!-- Inventory Table Section -->
<div class="bg-surface-container-lowest rounded-xl shadow-[0_-4px_12px_rgba(15,82,186,0.08)] overflow-hidden">
<div class="p-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
<h2 class="font-headline-sm text-headline-sm text-on-surface">Current Inventory</h2>
<div class="flex space-x-2">
<button class="flex items-center px-3 py-1.5 border border-outline rounded-lg text-on-surface-variant font-body-sm text-body-sm hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[16px] mr-1">filter_list</span>
                            Filter
                        </button>
<button class="flex items-center px-3 py-1.5 border border-outline rounded-lg text-on-surface-variant font-body-sm text-body-sm hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[16px] mr-1">download</span>
                            Export
                        </button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface font-label-caps text-label-caps text-on-surface-variant uppercase border-b border-outline-variant">
<th class="p-sm font-bold">Drug Name</th>
<th class="p-sm font-bold">SKU</th>
<th class="p-sm font-bold">Category</th>
<th class="p-sm font-bold text-right">Stock Level</th>
<th class="p-sm font-bold">Status</th>
<th class="p-sm font-bold">Last Updated</th>
<th class="p-sm font-bold text-right">Actions</th>
</tr>
</thead>
<tbody class="font-body-sm text-body-sm text-on-surface">
<tr class="border-b border-outline-variant hover:bg-tertiary-fixed transition-colors">
<td class="p-sm font-semibold">Amoxicillin 500mg</td>
<td class="p-sm text-on-surface-variant font-code-data text-code-data">AMX-500-CAP</td>
<td class="p-sm">Antibiotics</td>
<td class="p-sm text-right font-code-data text-code-data">1,240</td>
<td class="p-sm">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-secondary-fixed text-on-secondary-fixed">
                                        In Stock
                                    </span>
</td>
<td class="p-sm text-on-surface-variant">Today, 08:30 AM</td>
<td class="p-sm text-right space-x-1">
<button class="p-1 text-primary hover:bg-primary-fixed rounded transition-colors" title="Edit">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1 text-tertiary hover:bg-tertiary-fixed rounded transition-colors" title="Update Stock">
<span class="material-symbols-outlined text-[20px]">add_box</span>
</button>
</td>
</tr>
<tr class="border-b border-outline-variant hover:bg-tertiary-fixed transition-colors">
<td class="p-sm font-semibold">Lisinopril 10mg</td>
<td class="p-sm text-on-surface-variant font-code-data text-code-data">LIS-010-TAB</td>
<td class="p-sm">Cardiovascular</td>
<td class="p-sm text-right font-code-data text-code-data text-error font-bold">12</td>
<td class="p-sm">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-error-container text-on-error-container">
                                        Low Stock
                                    </span>
</td>
<td class="p-sm text-on-surface-variant">Yesterday, 14:15 PM</td>
<td class="p-sm text-right space-x-1">
<button class="p-1 text-primary hover:bg-primary-fixed rounded transition-colors" title="Edit">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1 text-tertiary hover:bg-tertiary-fixed rounded transition-colors" title="Update Stock">
<span class="material-symbols-outlined text-[20px]">add_box</span>
</button>
</td>
</tr>
<tr class="border-b border-outline-variant hover:bg-tertiary-fixed transition-colors">
<td class="p-sm font-semibold">Metformin 500mg</td>
<td class="p-sm text-on-surface-variant font-code-data text-code-data">MET-500-TAB</td>
<td class="p-sm">Antidiabetic</td>
<td class="p-sm text-right font-code-data text-code-data">850</td>
<td class="p-sm">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-secondary-fixed text-on-secondary-fixed">
                                        In Stock
                                    </span>
</td>
<td class="p-sm text-on-surface-variant">Oct 24, 09:00 AM</td>
<td class="p-sm text-right space-x-1">
<button class="p-1 text-primary hover:bg-primary-fixed rounded transition-colors" title="Edit">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1 text-tertiary hover:bg-tertiary-fixed rounded transition-colors" title="Update Stock">
<span class="material-symbols-outlined text-[20px]">add_box</span>
</button>
</td>
</tr>
<tr class="border-b border-outline-variant hover:bg-tertiary-fixed transition-colors bg-surface-container-low">
<td class="p-sm font-semibold text-on-surface-variant">Ibuprofen 400mg</td>
<td class="p-sm text-outline font-code-data text-code-data">IBU-400-TAB</td>
<td class="p-sm text-on-surface-variant">Analgesic</td>
<td class="p-sm text-right font-code-data text-code-data text-on-surface-variant">0</td>
<td class="p-sm">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-surface-variant text-on-surface-variant">
                                        Out of Stock
                                    </span>
</td>
<td class="p-sm text-outline">Oct 20, 11:45 AM</td>
<td class="p-sm text-right space-x-1">
<button class="p-1 text-primary hover:bg-primary-fixed rounded transition-colors" title="Edit">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1 text-tertiary hover:bg-tertiary-fixed rounded transition-colors" title="Update Stock">
<span class="material-symbols-outlined text-[20px]">add_box</span>
</button>
</td>
</tr>
<tr class="hover:bg-tertiary-fixed transition-colors">
<td class="p-sm font-semibold">Atorvastatin 20mg</td>
<td class="p-sm text-on-surface-variant font-code-data text-code-data">ATO-020-TAB</td>
<td class="p-sm">Cardiovascular</td>
<td class="p-sm text-right font-code-data text-code-data">420</td>
<td class="p-sm">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-secondary-fixed text-on-secondary-fixed">
                                        In Stock
                                    </span>
</td>
<td class="p-sm text-on-surface-variant">Today, 10:10 AM</td>
<td class="p-sm text-right space-x-1">
<button class="p-1 text-primary hover:bg-primary-fixed rounded transition-colors" title="Edit">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="p-1 text-tertiary hover:bg-tertiary-fixed rounded transition-colors" title="Update Stock">
<span class="material-symbols-outlined text-[20px]">add_box</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="p-sm border-t border-outline-variant bg-surface flex justify-between items-center text-body-sm font-body-sm text-on-surface-variant">
<span>Showing 1 to 5 of 1,458 entries</span>
<div class="flex space-x-1">
<button class="px-2 py-1 border border-outline-variant rounded hover:bg-surface-container disabled:opacity-50" disabled="">Prev</button>
<button class="px-2 py-1 bg-primary text-on-primary rounded">1</button>
<button class="px-2 py-1 border border-outline-variant rounded hover:bg-surface-container">2</button>
<button class="px-2 py-1 border border-outline-variant rounded hover:bg-surface-container">3</button>
<button class="px-2 py-1 border border-outline-variant rounded hover:bg-surface-container">Next</button>
</div>
</div>
</div>
</div>
</main>
<!-- BottomNavBar (Mobile) -->
<nav class="md:hidden fixed bottom-0 w-full rounded-t-2xl border-t border-slate-100 dark:border-slate-800 shadow-[0_-4px_12px_rgba(15,82,186,0.08)] z-50 flex justify-around items-center h-16 px-4 pb-safe bg-white/90 dark:bg-slate-900/90 backdrop-blur-lg">
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 text-[10px] font-bold font-manrope uppercase tracking-widest scale-95 active:scale-90 transition-transform active:bg-slate-100 dark:active:bg-slate-800 p-2 rounded-xl" href="#">
<span class="material-symbols-outlined mb-1">dashboard</span>
<span>Dash</span>
</a>
<a class="flex flex-col items-center justify-center text-blue-700 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/20 rounded-xl px-2 py-1 text-[10px] font-bold font-manrope uppercase tracking-widest scale-95 active:scale-90 transition-transform active:bg-slate-100 dark:active:bg-slate-800" href="#">
<span class="material-symbols-outlined mb-1" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
<span>Inv</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 text-[10px] font-bold font-manrope uppercase tracking-widest scale-95 active:scale-90 transition-transform active:bg-slate-100 dark:active:bg-slate-800 p-2 rounded-xl" href="#">
<span class="material-symbols-outlined mb-1">monitoring</span>
<span>Trends</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 text-[10px] font-bold font-manrope uppercase tracking-widest scale-95 active:scale-90 transition-transform active:bg-slate-100 dark:active:bg-slate-800 p-2 rounded-xl" href="#">
<span class="material-symbols-outlined mb-1">person_outline</span>
<span>Profile</span>
</a>
</nav>
  </div>
</template>
