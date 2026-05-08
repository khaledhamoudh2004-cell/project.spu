<script setup>
import LogoutButton from "../components/LogoutButton.vue";
</script>

<template>
  <div class="bg-background text-on-background font-body-md h-screen overflow-hidden flex">
<!-- SideNavBar (Desktop) -->
<aside class="hidden md:flex flex-col bg-slate-50 border-r border-slate-200 h-screen w-64 fixed left-0 top-0 font-manrope antialiased z-40">
<div class="text-lg font-bold text-slate-900 px-4 py-6">
            PharmaLink
        </div>
<div class="px-4 pb-4">
<div class="flex items-center gap-3 mb-1">
<img alt="Admin User Profile" class="w-10 h-10 rounded-full bg-surface-container-high object-cover" data-alt="close-up portrait of a professional man in a business setting with soft natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDv96g-13UgGu-yDkTJpqsVi_d_7VgxGAfaq-16pAWuDFhF54zx9vCpsNBQQMQNYYpF1N7SEeDbMOnBSEf6s4qAJZQzWnJZbClJaDFQ-GlS7-5_gJJD_Q0KuxVxqNpWMjw8tWFvFnL1f1v1D4jINT9t7kIxcQLPnzwwF_PjuFWwPVIjcaFvmCzWwKMx5sbtu17tqk0XpjL6CyBZr8micR7JOuyFP9-xHOebmOTXkiORPmf3CLpHs7iENIyKpBYBXrF4pVXOiX3jRw"/>
<div>
<p class="font-body-sm font-semibold text-on-surface">Management Console</p>
<p class="font-label-caps text-outline">System Administrator</p>
</div>
</div>
</div>
<nav class="flex flex-col space-y-1 p-3 overflow-y-auto flex-1">
<!-- Active Tab: Dashboard -->
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT bg-white text-blue-700 font-semibold shadow-sm transition-all duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">dashboard</span>
<span class="font-body-sm">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">inventory_2</span>
<span class="font-body-sm">Inventory</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">monitoring</span>
<span class="font-body-sm">Search Trends</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">local_pharmacy</span>
<span class="font-body-sm">Pharmacies</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">group</span>
<span class="font-body-sm">User Management</span>
</a>
</nav>
<div class="p-3 border-t border-slate-200 mt-auto">
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">support_agent</span>
<span class="font-body-sm">Support</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-DEFAULT text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 ease-in-out cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">settings</span>
<span class="font-body-sm">Settings</span>
</a>
</div>
</aside>
<!-- Main Content Canvas -->
<div class="flex-1 flex flex-col md:ml-64 w-full h-full relative">
<!-- TopAppBar -->
<header class="bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm docked full-width top-0 sticky z-50 flex items-center justify-between px-6 py-3 w-full max-w-screen-2xl mx-auto">
<div class="flex items-center gap-4 flex-1">
<div class="md:hidden text-xl font-black text-blue-700 tracking-tighter">
                    PharmaLink
                </div>
<!-- Search Box -->
<div class="hidden md:flex relative max-w-md w-full items-center">
<span class="material-symbols-outlined absolute left-3 text-slate-400">search</span>
<input class="w-full bg-surface-container-low border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-full py-2 pl-10 pr-4 font-body-sm text-on-surface placeholder-slate-400 outline-none transition-colors" placeholder="Search resources, users, or pharmacies..." type="text"/>
</div>
</div>
<div class="flex items-center gap-2">
<button class="p-2 text-blue-700 hover:bg-slate-50 rounded-full transition-colors cursor-pointer active:opacity-80 flex items-center justify-center">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-blue-700 hover:bg-slate-50 rounded-full transition-colors cursor-pointer active:opacity-80 flex items-center justify-center">
<span class="material-symbols-outlined">help</span>
</button>
<LogoutButton class="text-blue-700 hover:bg-slate-50 flex items-center justify-center" />
</div>
</header>
<!-- Main Scrollable Area -->
<main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-margin bg-background">
<div class="max-w-screen-2xl mx-auto space-y-md">
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-sm">
<div>
<h1 class="font-headline-md text-on-surface">System Overview</h1>
<p class="font-body-sm text-on-surface-variant mt-1">Live metrics and management controls for the PharmaLink network.</p>
</div>
<div class="flex items-center gap-2">
<span class="flex items-center gap-1 font-code-data text-on-surface-variant bg-surface-container py-1 px-3 rounded-full">
<span class="w-2 h-2 rounded-full bg-secondary-fixed-dim inline-block"></span>
                            System Status: Operational
                        </span>
<button class="bg-white border border-outline-variant text-on-surface font-body-sm font-semibold px-4 py-2 rounded-lg hover:bg-surface-container-low transition-colors shadow-sm flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">download</span>
                            Export Report
                        </button>
</div>
</div>
<!-- KPI Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
<!-- KPI Card 1 -->
<div class="bg-white p-md rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] flex flex-col justify-between">
<div class="flex justify-between items-start mb-4">
<div class="bg-primary-fixed p-2 rounded-lg text-primary">
<span class="material-symbols-outlined">local_pharmacy</span>
</div>
<span class="font-label-caps text-secondary-fixed-dim flex items-center gap-1 bg-secondary-fixed/20 px-2 py-1 rounded-full">
<span class="material-symbols-outlined text-[12px]">trending_up</span> 12%
                            </span>
</div>
<div>
<p class="font-body-sm text-on-surface-variant mb-1">Total Pharmacies</p>
<p class="font-headline-md text-on-surface">1,248</p>
</div>
</div>
<!-- KPI Card 2 -->
<div class="bg-white p-md rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] flex flex-col justify-between">
<div class="flex justify-between items-start mb-4">
<div class="bg-tertiary-fixed p-2 rounded-lg text-tertiary-container">
<span class="material-symbols-outlined">search</span>
</div>
<span class="font-label-caps text-secondary-fixed-dim flex items-center gap-1 bg-secondary-fixed/20 px-2 py-1 rounded-full">
<span class="material-symbols-outlined text-[12px]">trending_up</span> 8.4%
                            </span>
</div>
<div>
<p class="font-body-sm text-on-surface-variant mb-1">Daily Drug Searches</p>
<p class="font-headline-md text-on-surface">45.2k</p>
</div>
</div>
<!-- KPI Card 3 -->
<div class="bg-white p-md rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] flex flex-col justify-between">
<div class="flex justify-between items-start mb-4">
<div class="bg-error-container p-2 rounded-lg text-error">
<span class="material-symbols-outlined">warning</span>
</div>
<span class="font-label-caps text-error flex items-center gap-1 bg-error-container/50 px-2 py-1 rounded-full">
<span class="material-symbols-outlined text-[12px]">trending_down</span> 2.1%
                            </span>
</div>
<div>
<p class="font-body-sm text-on-surface-variant mb-1">Critical Low Stock Alerts</p>
<p class="font-headline-md text-on-surface">84</p>
</div>
</div>
<!-- KPI Card 4 -->
<div class="bg-white p-md rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] flex flex-col justify-between">
<div class="flex justify-between items-start mb-4">
<div class="bg-surface-container-highest p-2 rounded-lg text-surface-tint">
<span class="material-symbols-outlined">group</span>
</div>
<span class="font-label-caps text-outline flex items-center gap-1 bg-surface-container px-2 py-1 rounded-full">
<span class="material-symbols-outlined text-[12px]">remove</span> 0%
                            </span>
</div>
<div>
<p class="font-body-sm text-on-surface-variant mb-1">Active Pharmacists</p>
<p class="font-headline-md text-on-surface">3,892</p>
</div>
</div>
</div>
<!-- Main Content Split (Map & Trends) -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-gutter">
<!-- Map View -->
<div class="xl:col-span-2 bg-white rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] overflow-hidden flex flex-col">
<div class="p-sm border-b border-surface-container-high flex justify-between items-center bg-surface-container-lowest">
<h2 class="font-headline-sm text-on-surface">Pharmacy Distribution &amp; Search Hotspots</h2>
<div class="flex gap-2">
<button class="p-1 rounded-DEFAULT text-on-surface-variant hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-[20px]">filter_list</span></button>
<button class="p-1 rounded-DEFAULT text-on-surface-variant hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-[20px]">more_vert</span></button>
</div>
</div>
<div class="relative flex-1 min-h-[400px] bg-surface-container-low">
<!-- Placeholder for Map -->
<img class="absolute inset-0 w-full h-full object-cover opacity-80 mix-blend-multiply" data-alt="abstract stylized digital map showing glowing nodes and connections over a dark geographic background" data-location="United States" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiSib95tQ0F1dYZ9hFzY2Ey_Qy5KkHEYnrxCUElPOEuLHfzNTyobju341eSIj7RC3Kk4iQJxmpsCu5UKJMrvC3_SHwfR8GqVdiHGhQKROu3jk94Vi-hufv2c9x3KFHENZbq-9zTVGho2vBwQYTPbI-SP22yg5cRHaVJTiCrxD8fw0qUtPuvNSQj4sq_5BA0kCi7mqe2GNF_-wTjOIBV5602FoL9KX5k-ZpH2jeEexI6xMrSgqRuaVBLabvYOJAhzlzvIVSrhUBZA"/>
<!-- Map Overlay Controls -->
<div class="absolute top-4 right-4 flex flex-col gap-2">
<button class="bg-white p-2 rounded-lg shadow-sm border border-surface-container-high text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">add</span></button>
<button class="bg-white p-2 rounded-lg shadow-sm border border-surface-container-high text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">remove</span></button>
</div>
<!-- Legend -->
<div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm p-3 rounded-lg shadow-sm border border-surface-container-high">
<p class="font-label-caps text-on-surface-variant mb-2">Search Density</p>
<div class="flex items-center gap-2 font-code-data text-on-surface-variant">
<span class="w-3 h-3 rounded-full bg-primary-fixed-dim"></span> Low
                                    <span class="w-3 h-3 rounded-full bg-primary-container ml-2"></span> High
                                </div>
</div>
</div>
</div>
<!-- Top Searched Medications -->
<div class="bg-white rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] flex flex-col">
<div class="p-sm border-b border-surface-container-high flex justify-between items-center">
<h2 class="font-headline-sm text-on-surface">Trending Searches</h2>
<span class="font-label-caps text-outline">Last 24h</span>
</div>
<div class="p-sm flex-1 overflow-y-auto">
<ul class="space-y-4">
<li class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-code-data font-bold">1</div>
<div>
<p class="font-body-sm font-semibold text-on-surface">Amoxicillin 500mg</p>
<p class="font-code-data text-on-surface-variant">Antibiotic</p>
</div>
</div>
<div class="text-right">
<p class="font-body-sm font-bold text-on-surface">4,201</p>
<span class="font-label-caps text-secondary flex items-center justify-end gap-1">
<span class="material-symbols-outlined text-[12px]">arrow_upward</span> 12%
                                        </span>
</div>
</li>
<li class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-code-data font-bold">2</div>
<div>
<p class="font-body-sm font-semibold text-on-surface">Lisinopril 10mg</p>
<p class="font-code-data text-on-surface-variant">ACE Inhibitor</p>
</div>
</div>
<div class="text-right">
<p class="font-body-sm font-bold text-on-surface">3,840</p>
<span class="font-label-caps text-secondary flex items-center justify-end gap-1">
<span class="material-symbols-outlined text-[12px]">arrow_upward</span> 8%
                                        </span>
</div>
</li>
<li class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-code-data font-bold">3</div>
<div>
<p class="font-body-sm font-semibold text-on-surface">Albuterol Inhaler</p>
<p class="font-code-data text-on-surface-variant">Bronchodilator</p>
</div>
</div>
<div class="text-right">
<p class="font-body-sm font-bold text-on-surface">2,912</p>
<span class="font-label-caps text-error flex items-center justify-end gap-1">
<span class="material-symbols-outlined text-[12px]">arrow_downward</span> 3%
                                        </span>
</div>
</li>
<li class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-code-data font-bold">4</div>
<div>
<p class="font-body-sm font-semibold text-on-surface">Metformin 1000mg</p>
<p class="font-code-data text-on-surface-variant">Antidiabetic</p>
</div>
</div>
<div class="text-right">
<p class="font-body-sm font-bold text-on-surface">2,504</p>
<span class="font-label-caps text-secondary flex items-center justify-end gap-1">
<span class="material-symbols-outlined text-[12px]">arrow_upward</span> 5%
                                        </span>
</div>
</li>
<li class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-code-data font-bold">5</div>
<div>
<p class="font-body-sm font-semibold text-on-surface">Atorvastatin 20mg</p>
<p class="font-code-data text-on-surface-variant">Statin</p>
</div>
</div>
<div class="text-right">
<p class="font-body-sm font-bold text-on-surface">2,100</p>
<span class="font-label-caps text-outline flex items-center justify-end gap-1">
<span class="material-symbols-outlined text-[12px]">horizontal_rule</span> 0%
                                        </span>
</div>
</li>
</ul>
</div>
</div>
</div>
<!-- Management Table (Pharmacies) -->
<div class="bg-white rounded-xl border border-surface-container-high shadow-[0_-4px_12px_rgba(15,82,186,0.02)] overflow-hidden">
<div class="p-sm border-b border-surface-container-high flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
<h2 class="font-headline-sm text-on-surface">Recent Pharmacy Activity</h2>
<div class="flex gap-2 w-full sm:w-auto">
<div class="relative flex-1 sm:w-64">
<span class="material-symbols-outlined absolute left-2 top-1.5 text-[18px] text-slate-400">search</span>
<input class="w-full bg-surface-container-low border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg py-1.5 pl-8 pr-3 font-body-sm text-on-surface placeholder-slate-400 outline-none transition-colors" placeholder="Filter pharmacies..." type="text"/>
</div>
<button class="bg-white border border-outline-variant text-on-surface font-body-sm px-3 py-1.5 rounded-lg hover:bg-surface-container-low transition-colors shadow-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">filter_alt</span> Filter
                            </button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-lowest border-b border-surface-container-high">
<th class="p-3 font-label-caps text-on-surface-variant w-1/4">Pharmacy Name</th>
<th class="p-3 font-label-caps text-on-surface-variant">Location</th>
<th class="p-3 font-label-caps text-on-surface-variant">Status</th>
<th class="p-3 font-label-caps text-on-surface-variant text-right">Inventory Health</th>
<th class="p-3 font-label-caps text-on-surface-variant text-right">Last Sync</th>
</tr>
</thead>
<tbody class="font-body-sm text-on-surface">
<tr class="border-b border-surface-container-high hover:bg-tertiary-fixed/30 transition-colors">
<td class="p-3 font-semibold">CityHealth Central</td>
<td class="p-3 text-on-surface-variant">Downtown Metro</td>
<td class="p-3">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[12px] font-semibold bg-secondary-fixed text-on-secondary-fixed">Online</span>
</td>
<td class="p-3 text-right">
<div class="flex items-center justify-end gap-2">
<div class="w-16 h-1.5 bg-surface-container rounded-full overflow-hidden">
<div class="h-full bg-secondary w-[92%]"></div>
</div>
<span class="font-code-data text-on-surface-variant">92%</span>
</div>
</td>
<td class="p-3 text-right font-code-data text-on-surface-variant">2 mins ago</td>
</tr>
<tr class="border-b border-surface-container-high hover:bg-tertiary-fixed/30 transition-colors">
<td class="p-3 font-semibold">Valley Care Pharmacy</td>
<td class="p-3 text-on-surface-variant">Westside Suburbs</td>
<td class="p-3">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[12px] font-semibold bg-secondary-fixed text-on-secondary-fixed">Online</span>
</td>
<td class="p-3 text-right">
<div class="flex items-center justify-end gap-2">
<div class="w-16 h-1.5 bg-surface-container rounded-full overflow-hidden">
<div class="h-full bg-error w-[45%]"></div>
</div>
<span class="font-code-data text-error font-semibold">45%</span>
</div>
</td>
<td class="p-3 text-right font-code-data text-on-surface-variant">5 mins ago</td>
</tr>
<tr class="border-b border-surface-container-high hover:bg-tertiary-fixed/30 transition-colors">
<td class="p-3 font-semibold">Main St. Apothecary</td>
<td class="p-3 text-on-surface-variant">Historic District</td>
<td class="p-3">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[12px] font-semibold bg-surface-container-high text-on-surface-variant">Syncing</span>
</td>
<td class="p-3 text-right">
<div class="flex items-center justify-end gap-2">
<div class="w-16 h-1.5 bg-surface-container rounded-full overflow-hidden">
<div class="h-full bg-secondary w-[88%]"></div>
</div>
<span class="font-code-data text-on-surface-variant">88%</span>
</div>
</td>
<td class="p-3 text-right font-code-data text-on-surface-variant">Just now</td>
</tr>
<tr class="hover:bg-tertiary-fixed/30 transition-colors">
<td class="p-3 font-semibold">Riverside Meds</td>
<td class="p-3 text-on-surface-variant">East River Campus</td>
<td class="p-3">
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[12px] font-semibold bg-error-container text-error">Offline</span>
</td>
<td class="p-3 text-right">
<div class="flex items-center justify-end gap-2">
<span class="font-code-data text-outline">Unknown</span>
</div>
</td>
<td class="p-3 text-right font-code-data text-error">4 hrs ago</td>
</tr>
</tbody>
</table>
</div>
<div class="p-3 border-t border-surface-container-high bg-surface-container-lowest flex justify-end">
<button class="text-primary font-body-sm font-semibold hover:underline">View All Pharmacies</button>
</div>
</div>
<!-- Spacer for Bottom Nav on Mobile -->
<div class="h-20 md:hidden"></div>
</div>
</main>
</div>
<!-- BottomNavBar (Mobile) -->
<nav class="md:hidden bg-white/90 backdrop-blur-lg border-t border-slate-100 shadow-[0_-4px_12px_rgba(15,82,186,0.08)] fixed bottom-0 left-0 w-full z-50 flex justify-around items-center h-16 px-4 pb-safe rounded-t-2xl">
<a class="flex flex-col items-center justify-center text-slate-400 active:bg-slate-100 scale-95 active:scale-90 transition-transform" href="#">
<span class="material-symbols-outlined text-[24px]">search</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest mt-1">Search</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 active:bg-slate-100 scale-95 active:scale-90 transition-transform" href="#">
<span class="material-symbols-outlined text-[24px]">distance</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest mt-1">Nearby</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 active:bg-slate-100 scale-95 active:scale-90 transition-transform" href="#">
<span class="material-symbols-outlined text-[24px]">medication</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest mt-1">My Orders</span>
</a>
<!-- Active Tab: Profile (Closest match to Dashboard/Admin) -->
<a class="flex flex-col items-center justify-center text-blue-700 bg-blue-50/50 rounded-xl px-2 py-1 active:bg-slate-100 scale-95 active:scale-90 transition-transform" href="#">
<span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' 1;">person_outline</span>
<span class="text-[10px] font-bold font-manrope uppercase tracking-widest mt-1">Profile</span>
</a>
</nav>
  </div>
</template>
