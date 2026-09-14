<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("location: /pages/error/unauthorized.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../../generalStyle.css">
    <style type="text/tailwindcss">
        @theme {
        /* Custom Fonts */
            --font-display: "Plus Jakarta Sans", sans-serif;

            /* Custom Colors */
            --color-primary: #3e5c76;
            --color-secondary: #748cab;
            --color-accent: #f0ebd8;
            --color-primary-dark: #1d2d44;

            --color-dark-blue: #0d1321;
            --color-white: #f2f2f2;
            --color-black: #202020;

            --breakpoint-xs: 30rem;
            --breakpoint-2xl: 100rem;
            --breakpoint-3xl: 150rem;
        }
    </style>
    <title>Admin | Medicine Inventory</title>
</head>

<body class="relative w-full h-dvh bg-white text-dark-blue text-sm font-display">

    <!-- Back to top button -->
    <button id="backToTopBtn" class="fixed bg-secondary z-20 bottom-10 right-10 text-sm text-white flex gap-2 items-center justify-center px-4 py-3 pr-5 rounded-md cursor-pointer">
        <svg class="lucide lucide-arrow-up-from-dot-icon lucide-arrow-up-from-dot size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="m5 9 7-7 7 7" />
            <path d="M12 16V2" />
            <circle cx="12" cy="21" r="1" />
        </svg>
        <p>Back to top</p>
    </button>

    <!-- Filter -->
    <aside id="inventoryFilterPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-600/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80dvh] bg-white shadow-2xl flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[25%]">
            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Filter</h2>
                </section>
                <button type="button" class="closeFilterBtn text-gray-400 hover:text-gray-600 transition-colors p-1" onclick="hideFilterSidePanel()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </section>

            <!-- Form Scroll Area -->
            <section class="p-5 overflow-y-auto flex-1 flex flex-col gap-5 text-sm scrollbar-none">
                <hr class="border-gray-100">

                <!-- Category 1: Stock Status -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Stock Status</label>

                    <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2.5">
                        <label class="flex items-center gap-2.5 cursor-pointer text-xs font-medium text-gray-700 hover:text-gray-900">
                            <input type="checkbox" name="stock_status" value="in_stock" class="rounded border-gray-300 text-secondary focus:ring-secondary w-4 h-4" />
                            <span>Active</span>
                        </label>
                        <label class="flex items-center gap-2.5 cursor-pointer text-xs font-medium text-gray-700 hover:text-gray-900">
                            <input type="checkbox" name="stock_status" value="low_stock" class="rounded border-gray-300 text-secondary focus:ring-secondary w-4 h-4" />
                            <span>Inactive</span>
                        </label>
                    </section>
                </section>
            </section>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="reset" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Reset
                </button>
                <button type="button" class="w-2/3 bg-[#2d3e50] hover:bg-[#1e2a38] text-white font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Apply Filters
                </button>
            </section>
        </section>
    </aside>

    <!-- Supplier Detail View Panel -->
    <aside id="viewDetailPanel" class="hidden fixed top-0 right-0 z-60 bg-gray-900/40 w-dvw h-dvh border-l flex flex-col justify-end font-display transition duration-200 lg:flex-row">
        <!-- Main Content Wrapper -->
        <section class="w-full h-[80%] flex flex-col bg-white p-6 justify-between lg:h-dvh lg:w-[40%] xl:w-[25%] overflow-y-auto scrollbar-none">

            <section class="flex flex-col w-full gap-6 items-start justify-between">
                <!-- Header & Close Button -->
                <section class="flex items-start justify-between pb-2 w-full border-b border-gray-100">
                    <div>
                        <span class="text-xs mediumt-semibold text-secondary">Supplier ID: #2</span>
                        <section class="flex items-center gap-3">
                            <h2 class="text-xl font-bold text-gray-900 leading-tight mt-0.5" contenteditable="false">VIP Pharma Supplies</h2>
                            <p class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 border border-green-500 text-green-700">Active</p>
                            <p class="px-3 py-1 text-xs rounded-full border border-red-500 bg-red-200 text-red-700">Inactive</p>
                        </section>
                    </div>
                    <button class="closeViewDetailPanelBtn text-gray-400 transition-colors cursor-pointer hover:text-gray-600 p-1" onclick="hideDetailViewPanel()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </section>

                <!-- Supplier Summary Card -->
                <section class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col gap-2 w-full">
                    <section class="flex items-center justify-between">
                        <span class="text-xs font-medium text-gray-500">Total Transactions</span>
                        <span class="bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            24 Orders
                        </span>
                    </section>
                    <section class="flex items-baseline gap-1 mt-1">
                        <span class="text-3xl font-extrabold text-gray-900">₱450,250.00</span>
                    </section>
                </section>

                <!-- Supplier Contact Details Section -->
                <section class="flex flex-col gap-4 w-full">
                    <h3 class="text-xs font-medium text-gray-400">Contact Information</h3>

                    <!-- Address -->
                    <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="p-2 bg-white rounded-lg border border-gray-200/80 text-gray-600 mt-0.5">
                            <svg class="lucide lucide-map-pin-icon lucide-map-pin size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Address</p>
                            <p class="text-sm font-semibold text-gray-800 leading-tight mt-0.5">123 Metro Ave, Makati City</p>
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="p-2 bg-white rounded-lg border border-gray-200/80 text-gray-600 mt-0.5">
                            <svg class="lucide lucide-phone-icon lucide-phone size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Contact Number</p>
                            <p class="text-sm font-semibold text-gray-800 leading-tight mt-0.5">+63 917 123 4567</p>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="p-2 bg-white rounded-lg border border-gray-200/80 text-gray-600 mt-0.5">
                            <svg class="lucide lucide-mail-icon lucide-mail size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs text-gray-400 font-medium">Email Address</p>
                            <p class="text-sm font-semibold text-gray-800 leading-tight mt-0.5 truncate">contact@vippharma.ph</p>
                        </div>
                    </div>
                </section>

                <!-- Recent Orders Associated with Supplier -->
                <section class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-medium text-gray-400">Recent Purchase Orders</h3>
                        <span class="text-xs text-gray-500 font-medium">Latest 3</span>
                    </div>

                    <div class="flex flex-col gap-2.5">
                        <!-- PO 1 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900 text-xs">PO-2026-089</span>
                                <span class="text-xs text-emerald-600 font-medium bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Completed</span>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>Aug 18, 2026</span>
                                <span class="font-bold text-gray-900">₱24,500.00</span>
                            </div>
                        </div>

                        <!-- PO 2 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900 text-xs">PO-2026-074</span>
                                <span class="text-xs text-emerald-600 font-medium bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Completed</span>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>Jul 30, 2026</span>
                                <span class="font-bold text-gray-900">₱18,200.00</span>
                            </div>
                        </div>

                        <!-- PO 3 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900 text-xs">PO-2026-074</span>
                                <span class="text-xs text-emerald-600 font-medium bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Completed</span>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>Jul 30, 2026</span>
                                <span class="font-bold text-gray-900">₱18,200.00</span>
                            </div>
                        </div>
                    </div>
                </section>

            </section>

            <!-- Quick Action Footer -->
            <section class="pt-4 mt-6 border-t border-gray-100 flex flex-col gap-2">
                <section class="flex gap-2 items-center">
                    <button class="w-full bg-gray-100 text-sky-700 border-2 border-sky-700 bg-sky-100 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors cursor-pointer">
                        Edit
                    </button>
                    <button class="w-full bg-green-100 text-green-700 border border-green-500 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors cursor-pointer">
                        Set as Active
                    </button>
                    <button class="w-full bg-red-100 text-red-700 border border-red-500 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors cursor-pointer">
                        Set as Inctive
                    </button>
                </section>
            </section>
        </section>
    </aside>

    <!-- Add Supplier Side Panel Drawer -->
    <aside id="addSupplierPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-900/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80%] bg-white flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[25%]">

            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Add New Supplier</h2>
                </section>
                <button type="button" class="closeAddSupplierBtn text-gray-400 hover:text-gray-600 transition-colors p-1 cursor-pointer" onclick="hideAddSupplierPanel()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </section>

            <!-- Form Fields Scroll Area -->
            <form id="addSupplierForm" class="p-5 overflow-y-auto flex-1 flex flex-col gap-4 text-sm scrollbar-none">

                <label class="text-xs font-medium text-gray-400 mb-1">Supplier Credentials</label>

                <!-- Supplier Name Input -->
                <section>
                    <label for="supplier_name" class="block text-xs font-semibold text-gray-700 mb-1">Supplier / Company Name <span class="text-red-500">*</span></label>
                    <section class="relative">
                        <input type="text" id="supplier_name" name="supplier_name" required class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-9 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"></path>
                        </svg>
                    </section>
                    <p class="text-xs mt-1 text-red-700">Error Message</p>
                </section>

                <!-- Address Input -->
                <section>
                    <label for="supplier_address" class="block text-xs font-semibold text-gray-700 mb-1">Business Address <span class="text-red-500">*</span></label>
                    <section class="relative">
                        <textarea id="supplier_address" name="supplier_address" rows="3" required class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-9 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none resize-none"></textarea>
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </section>
                    <p class="text-xs mt-1 text-red-700">Error Message</p>
                </section>

                <!-- Contact Number Input -->
                <section>
                    <label for="supplier_contact" class="block text-xs font-semibold text-gray-700 mb-1">Contact Number <span class="text-red-500">*</span></label>
                    <section class="relative">
                        <input type="tel" id="supplier_contact" name="supplier_contact" required class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-9 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </section>
                    <p class="text-xs mt-1 text-red-700">Error Message</p>
                </section>

                <!-- Email Address Input -->
                <section>
                    <label for="supplier_email" class="block text-xs font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <section class="relative">
                        <input type="email" id="supplier_email" name="supplier_email" required class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-9 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </section>
                    <p class="text-xs mt-1 text-red-700">Error Message</p>
                </section>

            </form>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="button" class="closeAddSupplierBtn w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors cursor-pointer">
                    Cancel
                </button>
                <button type="submit" form="addSupplierForm" class="w-2/3 bg-primary hover:bg-primary/90 text-white font-medium py-2.5 rounded-lg text-sm transition-colors cursor-pointer">
                    Save Supplier
                </button>
            </section>

        </section>
    </aside>

    <!-- Main Content -->
    <main class="w-full h-fit min-h-full grid grid-cols-1 divide-x divide-primary/20 lg:grid-cols-[auto_1fr]">
        <!-- Sidebar -->
        <aside id="sidebar" class="hidden absolute z-50 w-full h-fit bg-secondary text-white p-5 flex flex-col gap-3 divide-y divide-primary/20 overflow-y-scroll scrollbar-none transition duration-100 lg:block lg:static lg:h-dvh lg:bg-white lg:text-dark-blue">
            <!-- Logo Container -->
            <section class="flex items-center justify-between lg:justify-center xl:justify-between">
                <a href=" " class="py-3 flex items-center lg:justify-center 2xl:justify-start gap-2">
                    <p class="sidebar-trigger bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-semibold rounded-md text-md">AC</p>
                    <p class="sidebar-hidden-item text-lg font-medium font-semibold lg:hidden">ApexCare</p>
                </a>
                <button id="closeSidebarBtn" class="text-accent rounded-md cursor-pointer lg:w-fit h-fit p-2 flex items-center gap-3 lg:hidden 2xl:w-full">
                    <svg class="lucide lucide-x-icon lucide-x size-9" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </section>

            <!-- Profile -->
            <section class="flex flex-col gap-2 w-full h-fit py-3">
                <section class="flex flex-col gap-2">
                    <p class="sidebar-hidden-item lg:hidden font-medium text-white/60 lg:text-dark-blue/30">My Profile</p>
                    <section class="flex gap-2 items-center">
                        <p class="sidebar-trigger bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-medium rounded-md text-md">RT</p>
                        <section class="flex flex-col">
                            <p class="sidebar-hidden-item text-lg font-medium lg:hidden">Renzo Tolentino</p>
                            <p class="sidebar-hidden-item text-white/70 lg:text-gray-500 lg:hidden">U1213</p>
                        </section>
                    </section>
                </section>

                <section class="w-full mt-10 text-center lg:w-fit">
                    <button class="border border-primary rounded-md text-center flex items-center justify-center gap-2 cursor-pointer w-full lg:w-fit xl:w-full h-fit px-3 py-2 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="sidebar-trigger lucide lucide-log-out-icon lucide-log-out size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 17 5-5-5-5" />
                            <path d="M21 12H9" />
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        </svg>
                        <p class="sidebar-hidden-item lg:hidden">Logout</p>
                    </button>
                </section>
            </section>

            <!-- Sidebar Menu List -->
            <section class="divide-y divide-primary/20 flex flex-col gap-4 ">
                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start" title="Dashboard">
                    <p class="sidebar-hidden-item font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Overview</p>
                    <a href="../admin/dashboard.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-layout-dashboard-icon lucide-layout-dashboard size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="7" height="9" x="3" y="3" rx="1" />
                            <rect width="7" height="5" x="14" y="3" rx="1" />
                            <rect width="7" height="9" x="14" y="12" rx="1" />
                            <rect width="7" height="5" x="3" y="16" rx="1" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Dashboard</p>
                    </a>
                </section>

                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="sidebar-hidden-item font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Procurement</p>
                    <a href="../admin/supplierManagement.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-handshake-icon lucide-handshake size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8 " stroke-linecap="round" stroke-linejoin="round">
                            <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                            <path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                            <path d="m21 3 1 11h-2" />
                            <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                            <path d="M3 4h8" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Supplier Management</p>
                    </a>
                    <a href="../admin/orderManagement.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-clipboard-pen-icon lucide-clipboard-pen size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                            <path d="M21.34 15.664a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                            <path d="M8 22H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <rect x="8" y="2" width="8" height="4" rx="1" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Order Management</p>
                    </a>
                    <a href="../admin/deliveryMangement.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-truck-icon lucide-truck size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Delivery Management</p>
                    </a>
                    <a href="../admin/purchaseRecords.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-receipt-text-icon lucide-receipt-text size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 16H8" />
                            <path d="M14 8H8" />
                            <path d="M16 12H8" />
                            <path d="M4 3a1 1 0 0 1 1-1 1.3 1.3 0 0 1 .7.2l.933.6a1.3 1.3 0 0 0 1.4 0l.934-.6a1.3 1.3 0 0 1 1.4 0l.933.6a1.3 1.3 0 0 0 1.4 0l.933-.6a1.3 1.3 0 0 1 1.4 0l.934.6a1.3 1.3 0 0 0 1.4 0l.933-.6A1.3 1.3 0 0 1 19 2a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1 1.3 1.3 0 0 1-.7-.2l-.933-.6a1.3 1.3 0 0 0-1.4 0l-.934.6a1.3 1.3 0 0 1-1.4 0l-.933-.6a1.3 1.3 0 0 0-1.4 0l-.933.6a1.3 1.3 0 0 1-1.4 0l-.934-.6a1.3 1.3 0 0 0-1.4 0l-.933.6a1.3 1.3 0 0 1-.7.2 1 1 0 0 1-1-1z" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Purchase Records</p>
                    </a>
                </section>

                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="sidebar-hidden-item font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Sales</p>
                    <a href="../admin/salesRecords.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Sales Records</p>
                    </a>
                    <a href="../admin/salesReports.php" class="rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-chart-column-icon lucide-chart-column size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                            <path d="M18 17V9" />
                            <path d="M13 17V5" />
                            <path d="M8 17v-3" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Sales Reports</p>
                    </a>
                </section>

                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="sidebar-hidden-item font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Inventory</p>
                    <a href="../admin/medicineInventory.php" class="bg-primary text-white rounded-md cursor-pointer w-full h-fit px-3 py-2 flex items-center gap-3 transition duration-100 lg:w-fit hover:bg-secondary/40">
                        <svg class="sidebar-trigger lucide lucide-warehouse-icon lucide-warehouse size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 21V10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v11" />
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 1.132-1.803l7.95-3.974a2 2 0 0 1 1.837 0l7.948 3.974A2 2 0 0 1 22 8z" />
                            <path d="M6 13h12" />
                            <path d="M6 17h12" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Medicine Inventory</p>
                    </a>
                </section>

                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="sidebar-hidden-item  font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Staff</p>
                    <a href="../admin/userManagement.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="sidebar-trigger lucide lucide-user-round-icon lucide-user-round size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="5" />
                            <path d="M20 21a8 8 0 0 0-16 0" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Staff Management</p>
                    </a>
                </section>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="w-full h-dvh p-5 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4 lg:gap-3 lg:grid-rows-[auto_auto_12fr] overflow-y-scroll scrollbar-thin scrollbar-thumb-secondary">
            <!-- Header -->
            <section class="col-span-full flex items-center justify-between">
                <section class="flex items-center gap-3">
                    <p class="col-span-full flex items-center text-lg font-medium md:text-2xl">Medicine Inventory</p>
                </section>

                <section class="flex items-center gap-2">
                    <button id="openSidebarBtn" class="bg-primary p-1 size-10 flex items-center justify-center text-white rounded-md lg:hidden">
                        <svg class="lucide lucide-menu-icon lucide-menu size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 5h16" />
                            <path d="M4 12h16" />
                            <path d="M4 19h16" />
                        </svg>
                    </button>
                </section>

            </section>

            <!-- Search, Filter & Add sales button -->
            <section class="col-span-full flex gap-2 items-center justify-between flex-col sm:flex-row">
                <section class="flex items-center gap-2 h-fit w-full">
                    <section class="border border-primary flex items-center gap-2 p-2 pr-3 rounded-md w-full h-fit sm:w-80 md:w-100">
                        <svg class="lucide lucide-search-icon lucide-search size-4.5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34" />
                            <circle cx="11" cy="11" r="8" />
                        </svg>
                        <input class="outline-0 text-sm w-full " type="text" name="medicineSearchQuery" id="medicineSearchQueryTxt">
                    </section>
                    <button class="bg-primary text-white size-9 p-2 rounded-md flex items-center justify-center cursor-pointer hover:bg-primary/90" onclick="showFilterSidePanel()">
                        <svg class="lucide lucide-funnel-icon lucide-funnel size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z" />
                        </svg>
                    </button>
                </section>
            </section>

            <!-- Table records -->
            <section class="col-span-full rounded-md h-full border border-gray-400/40 overflow-hidden">
                <div class="max-h-full h-full w-full overflow-y-auto scrollbar-thin scrollbar-thumb-secondary rounded-b-lg">
                    <table class="w-full text-sm border-collapse relative">
                        <thead>
                            <tr>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 w-10 rounded-tl-md">ID</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 w-[55%] sm:w-[75%] lg:w-70">Medicine Name</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 w-50 hidden xl:table-cell">Supplier</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden xl:table-cell">Batch Number</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden lg:table-cell">Expirey Date</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden lg:table-cell">Status</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden lg:table-cell">Stock Left</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 pr-5 rounded-tr-md lg:w-50"></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-slate-100">
                            <tr class="h-1">
                                <td class="max-w-[0] truncate py-4 pl-5">1</td>
                                <td class="max-w-[0] truncate py-4 pl-5">
                                    <div>
                                        <p class="font-semibold truncate">Amoxicillin 500mg Capsule</p>
                                        <section class="text-gray-800/50">
                                            Amoxil | Capsule
                                        </section>
                                    </div>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">Zuellig Pharma</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">BN-2026-001</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">January 1, 2027</td>
                                <td class="py-4 pl-5 hidden lg:table-cell">
                                    <p class="bg-red-200 border border-red-600 w-fit py-1 px-4 rounded-full text-red-600 flex items-center justify-center">Out of Stock</p>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">0</td>
                                <td class="max-w-[0] truncate py-4 pl-5">
                                    <button id="viewDetailBtn1" class="bg-primary text-white rounded-md cursor pointer flex items-center gap-1 px-3 py-2 cursor-pointer">
                                        <svg class="lucide lucide-eye-icon lucide-eye size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <p class="hidden md:block">View details</p>
                                    </button>
                                </td>
                            </tr>
                            <tr class="h-1">
                                <td class="max-w-[0] truncate py-4 pl-5">2</td>
                                <td class="max-w-[0] truncate py-4 pl-5">
                                    <div>
                                        <p class="font-semibold truncate">Paracetamol 500mg Tablet</p>
                                        <section class="text-gray-800/50">
                                            Biogesic | Tablet
                                        </section>
                                    </div>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">Unilab Health</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">BN-2026-042</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">June 26, 2028</td>
                                <td class="py-4 pl-5 hidden lg:table-cell">
                                    <p class="bg-orange-200 border border-orange-600 w-fit px-4 py-1 rounded-full text-orange-600 flex items-center justify-center">Low</p>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">5</td>
                                <td class="max-w-[0] truncate py-4 pl-5 ">
                                    <button class="bg-primary text-white rounded-md cursor pointer flex items-center gap-1 px-3 py-2 cursor-pointer">
                                        <svg class="lucide lucide-eye-icon lucide-eye size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <p class="hidden md:block">View details</p>
                                    </button>
                                </td>
                            </tr>
                            <tr class="h-1">
                                <td class="max-w-[0] truncate py-4 pl-5">3</td>
                                <td class="max-w-[0] truncate py-4 pl-5">
                                    <div>
                                        <p class="font-semibold truncate">Cetirizine HCl 10mg Tablet</p>
                                        <section class="text-gray-800/50">
                                            Allercur | Tablet
                                        </section>
                                    </div>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">United Laboratories</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">BN-2026-108</td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell">May 1, 2026</td>
                                <td class="py-4 pl-5 hidden lg:table-cell">
                                    <p class="bg-green-200 border border-green-600 w-fit px-4 py-1 rounded-full text-green-600 flex items-center justify-center">Good</p>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell">1500</td>
                                <td class="max-w-[0] truncate py-4 pl-5">
                                    <button class="bg-primary text-white rounded-md cursor pointer flex items-center gap-1 px-3 py-2 cursor-pointer">
                                        <svg class="lucide lucide-eye-icon lucide-eye size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <p class="hidden md:block">View details</p>
                                    </button>
                                </td>
                            </tr>
                            <tr id="emptyDeliveryRecordRow" class="hidden colspan-full">
                                <td colspan="7">
                                    <div class="w-full h-full flex flex-col items-center justify-center gap-2 p-15 text-center">
                                        <img class="size-35 lg:size-100" src="../../assets/image/empty_delivery.png" alt="">
                                        <p class="font-semibold">Oops! There are no deliveries arrived here...</p>
                                        <p class="text-gray-600/80">There are no recorded delivery record here.</p>
                                        <a href="../admin/orderManagement.php" button class="bg-primary px-4 py-2 rounded-md text-white cursor-pointer">Receive Delivery</a>
                                    </div>
                                </td>
                            </tr>

                            <tr id="emptySearchResultRow" class="hidden colspan-full">
                                <td colspan="7">
                                    <div class="w-full h-full flex flex-col items-center justify-center gap-2 p-15 text-center">
                                        <img class="size-35 lg:size-100" src="../../assets/image/no_result.png" alt="">
                                        <p class="font-semibold">Oops! Can't find what you need.</p>
                                        <p class="text-gray-600/80">There is no results that matches what you're searching. Please try again.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>

    <script src="../../js/jquery.min.js"></script>
    <script>
        /*
        ==============================================================================
        MAIN FUNCTIONS 
         - Functions that are needed/required and do specific things 
        ==============================================================================
        */


        /*
        ==============================================================================
        TOGGLE FUNCTIONS 
        - Functions just show/hide elements
        ==============================================================================
         */

        $("#sidebar ").on("mouseenter", function() {
            $("#sidebar .sidebar-hidden-item").removeClass("lg:hidden").show(200);
            $("#sidebar a").removeClass("lg:w-fit");
            $("#sidebar section").removeClass("lg:w-fit");
        });
        $("#sidebar").on("mouseleave", function() {
            $("#sidebar .sidebar-hidden-item").addClass("lg:hidden transition duration-100").hide(200);
            $("#sidebar a").addClass("lg:w-full");
            $("#sidebar section").addClass("lg:w-full");
        });

        $("#openSidebarBtn").click(() => {
            $("#sidebar").slideDown();
        });
        $("#closeSidebarBtn").click(() => {
            $("#sidebar").slideUp();
        });

        let tooltipMessageToggleBtnCount = $(".toggleToolTipMessageBtn").length;

        for (let index = 0; index < tooltipMessageToggleBtnCount; index++) {
            $(`#toggleToolTipMessageBtn${index + 1}`).click(() => {
                $(`#toggleToolTipMessageBtn${index + 1} > section`).toggle(100);

                setTimeout(() => {
                    if ($(`#toggleToolTipMessageBtn${index + 1} > section`).css("display").toLowerCase() === "block") {
                        $(`#toggleToolTipMessageBtn${index + 1} > section`).toggle(100);
                    }
                }, 5000);
            })
        }

        function showFilterSidePanel() {
            $("#inventoryFilterPanel").toggleClass("hidden");
        }

        function hideFilterSidePanel() {
            $("#inventoryFilterPanel").toggleClass("hidden");
        }
        /*
        ==============================================================================
        HELPER FUNCTIONS, ADDITIONAL FUNCTIONS & EVENT LISTENER FUNCTIONS
        - Functions to help reduce redundancy
        ==============================================================================
        */
    </script>
</body>


</html>