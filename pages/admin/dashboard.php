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
    <title>Admin | Dashboard</title>
</head>

<body class="w-full h-dvh bg-white text-dark-blue text-sm font-display">
    <!-- Admin Dashboard -->
    <main class="w-full h-fit min-h-full grid grid-cols-1 divide-x divide-primary/20 lg:grid-cols-[auto_1fr] ">
        <!-- Sidebar -->

        <aside id="sidebar" class="hidden absolute z-50 w-full h-fit bg-secondary text-white p-5 flex flex-col gap-3 divide-y divide-primary/20 lg:block lg:static lg:h-dvh lg:bg-white lg:text-dark-blue overflow-y-scroll scrollbar-none">

            <!-- Logo Container -->
            <section class="flex items-center justify-between lg:justify-center xl:justify-between">
                <a href=" " class="py-3 flex items-center lg:justify-center 2xl:justify-start gap-2">
                    <p class="bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-semibold rounded-md text-l">AC</p>
                    <p class="sidebar-hidden-item text-lg font-medium font-semibold lg:hidden">ApexCare Pharmacy</p>
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
                        <p class="bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-medium rounded-md text-xl">RT</p>
                        <section class="flex flex-col">
                            <p class="sidebar-hidden-item text-lg font-medium lg:hidden">Renzo Tolentino</p>
                            <p class="sidebar-hidden-item text-white/70 lg:text-gray-500 lg:hidden">U1213</p>
                        </section>
                    </section>
                </section>

                <section class="w-full mt-10 text-center">
                    <button class="border border-primary rounded-md text-center flex items-center justify-center gap-2 cursor-pointer w-full lg:w-fit xl:w-full h-fit px-3 py-2 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-log-out-icon lucide-log-out size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                    <a href="../admin/dashboard.php" class="bg-primary text-white rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                    <a href=" ../admin/supplierManagement.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-handshake-icon lucide-handshake size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8 " stroke-linecap="round" stroke-linejoin="round">
                            <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                            <path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                            <path d="m21 3 1 11h-2" />
                            <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                            <path d="M3 4h8" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Supplier Management</p>
                    </a>
                    <a href=" ../admin/orderManagement.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-clipboard-pen-icon lucide-clipboard-pen size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                            <path d="M21.34 15.664a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                            <path d="M8 22H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <rect x="8" y="2" width="8" height="4" rx="1" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Order Management</p>
                    </a>
                    <a href=" ../admin/deliveryMangement.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-truck-icon lucide-truck size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Delivery Management</p>
                    </a>
                    <a href=" ../admin/purchaseRecords.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-receipt-text-icon lucide-receipt-text size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                    <a href=" ../admin/salesRecords.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Sales Records</p>
                    </a>
                    <a href=" ../admin/salesReports.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-chart-column-icon lucide-chart-column size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                    <a href=" ../admin/medicineInventory.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-warehouse-icon lucide-warehouse size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                    <a href=" ../admin/userManagement.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-user-round-icon lucide-user-round size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="5" />
                            <path d="M20 21a8 8 0 0 0-16 0" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Staff Management</p>
                    </a>
                </section>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="w-full h-dvh p-5 grid grid-cols-1 grid-rows-auto md:grid-cols-2 lg:grid-cols-4 lg:grid-rows-[auto_auto_350px_auto] gap-3 overflow-y-scroll scrollbar-thin scrollbar-thumb-sendary">
            <!-- Header -->
            <section class="col-span-full w-full flex items-center justify-between">
                <p class="col-span-full flex items-center text-lg font-medium md:text-2xl">Dashboard</p>
                <section class="flex items-center justify-end gap-3 w-full">
                    <section class="relative">
                        <button id="toggleDateRangeFilterBtn" class="flex items-center gap-1 bg-secondary px-3 py-2 rounded-full text-white cursor-pointer">
                            <p class="hidden sm:block">Date Range</p>
                            <svg class="lucide lucide-funnel size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z" />
                            </svg>
                        </button>
                        <section id="dashboardDateRangeFilter" class="hidden opacity-0 absolute top-auto right-0 w-50 h-fit flex flex-col gap-2 overflow-scroll h-fit p-3 mt bg-gray-50 rounded-lg mt-2 border border-gray-200 scrollbar-none z-20">
                            <p id="" class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Yesterday</p>
                            <p id="" class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Last Week</p>
                            <p id="" class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Last Month</p>
                            <p id="" class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Last Year</p>
                        </section>
                    </section>
                    <button id="openSidebarBtn" class="bg-primary p-1 size-10 flex items-center justify-center text-white rounded-md lg:hidden">
                        <svg class="lucide lucide-menu-icon lucide-menu size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 5h16" />
                            <path d="M4 12h16" />
                            <path d="M4 19h16" />
                        </svg>
                    </button>
                </section>
            </section>

            <!-- Gross Sales -->
            <section class="col-span-full border border-gray-400/30 rounded-lg p-3 md:col-span-1 flex flex-col gap-2">
                <section class="flex items-center w-full justify-between">
                    <p class="text-gray-500">Gross Sales Today</p>
                    <button id="toggleToolTipMessageBtn1" class="toggleToolTipMessageBtn cursor-pointer relative">
                        <svg class="lucide lucide-info-icon lucide-info size-5 md:size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <!-- Pop up information text -->
                        <section class="hidden absolute right-0 mt-1 w-50 bg-blue-100 border border-primary/40 rounded-lg p-2">
                            <p class="text-sm text-dark-blue">This is the total amount of sales earned for today.</p>
                        </section>
                    </button>
                </section>
                <section class="flex items-center gap-3">
                    <p class="text-3xl font-medium">₱1,294</p>
                </section>
                <section>
                    <section class="text-xs w-fit flex items-center text-green-600 gap-1">
                        <svg class="lucide lucide-trending-up-icon lucide-trending-up size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 7h6v6" />
                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                        </svg>
                        <p><span>12</span>% Higher than yesterday</p>
                    </section>
                    <section class="text-xs w-fit flex items-center gap-1 text-red-700">
                        <svg class="lucide lucide-trending-down-icon lucide-trending-down size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 17h6v-6" />
                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                        </svg>
                        <p><span>12</span>% Lower than yesterday</p>
                    </section>
                </section>
            </section>

            <!-- Net Revenue -->
            <section class="col-span-full border border-gray-400/30 rounded-lg p-3 md:col-span-1 flex flex-col gap-2">
                <section class="flex items-center w-full justify-between">
                    <p class="text-gray-500">Net Revenue Today</p>
                    <button id="toggleToolTipMessageBtn1" class="toggleToolTipMessageBtn cursor-pointer relative">
                        <svg class="lucide lucide-info-icon lucide-info size-5 md:size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <!-- Pop up information text -->
                        <section class="hidden absolute right-0 mt-1 w-50 bg-blue-100 border border-primary/40 rounded-lg p-2">
                            <p class="text-sm text-dark-blue">This is the total amount of sales earned for today.</p>
                        </section>
                    </button>
                </section>
                <section class="flex items-center gap-3">
                    <p class="text-3xl font-medium">₱1,294</p>
                </section>
                <section>
                    <section class="text-xs w-fit flex items-center text-green-600 gap-1">
                        <svg class="lucide lucide-trending-up-icon lucide-trending-up size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 7h6v6" />
                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                        </svg>
                        <p><span>12</span>% Higher than yesterday</p>
                    </section>
                    <section class="text-xs w-fit flex items-center gap-1 text-red-700">
                        <svg class="lucide lucide-trending-down-icon lucide-trending-down size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 17h6v-6" />
                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                        </svg>
                        <p><span>12</span>% Lower than yesterday</p>
                    </section>
                </section>
            </section>

            <!-- Active Stock Values -->
            <section class="col-span-full border border-gray-400/30 rounded-lg p-3 md:col-span-1 flex flex-col gap-2">
                <section class="flex items-center w-full justify-between">
                    <p class="text-gray-500">Active Stock Value</p>
                    <button id="toggleToolTipMessageBtn1" class="toggleToolTipMessageBtn cursor-pointer relative">
                        <svg class="lucide lucide-info-icon lucide-info size-5 md:size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <!-- Pop up information text -->
                        <section class="hidden absolute right-0 mt-1 w-50 bg-blue-100 border border-primary/40 rounded-lg p-2">
                            <p class="text-sm text-dark-blue">This is the total amount of sales earned for today.</p>
                        </section>
                    </button>
                </section>
                <section class="flex items-center gap-3">
                    <p class="text-3xl font-medium">₱1,294</p>
                </section>
                <section>
                    <section class="text-xs w-fit flex items-center text-green-600 gap-1">
                        <svg class="lucide lucide-trending-up-icon lucide-trending-up size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 7h6v6" />
                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                        </svg>
                        <p><span>12</span>% Higher than yesterday</p>
                    </section>
                    <section class="text-xs w-fit flex items-center gap-1 text-red-700">
                        <svg class="lucide lucide-trending-down-icon lucide-trending-down size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 17h6v-6" />
                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                        </svg>
                        <p><span>12</span>% Lower than yesterday</p>
                    </section>
                </section>
            </section>

            <!-- Pending Orders -->
            <section class="col-span-full border border-gray-400/30 rounded-lg p-3 md:col-span-1">
                <section class="flex items-center w-full justify-between">
                    <p class="text-gray-500">Pending Orders</p>
                    <button id="toggleToolTipMessageBtn4" class="toggleToolTipMessageBtn cursor-pointer relative">
                        <svg class="lucide lucide-info-icon lucide-info size-5 md:size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <!-- Pop up information text -->
                        <section class="hidden absolute right-0 mt-1 w-50 bg-blue-100 border border-primary/40 rounded-lg p-2">
                            <p class="text-sm text-dark-blue">This is the total number of pending orders waiting to be delivered.</p>
                        </section>
                    </button>
                </section>
                <section class="flex items-center gap-3">
                    <p class="text-3xl font-medium">24</p>
                </section>

                <!-- Pop up information text -->
                <!-- <section>
                    <p>This is the Total Amount of Sales for August 20, 2026</p>
                </section> -->
            </section>

            <!-- Top Charts -->
            <section class="grid col-span-full grid-cols-1 gap-3 md:grid-cols-3 mt-5">
                <!-- Top Selling Medicine List (5) -->
                <section class="col-span-1 flex flex-col gap-2 border border-gray-300 rounded-lg overflow-hidden">
                    <section class="flex items-center justify-between bg-secondary px-4 py-3 text-white">
                        <p class="font-semibold">Top 5 Selling Medicine</p>
                        <a href="" class="text-xs">View all</a>
                    </section>
                    <section id="topSellingMedicineList" class="w-full h-full px-4 flex flex-col divide-y divide-gray-300">
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <p class="grow">Paracetamol 500mg</p>
                            <p class="text-xs text-gray-500">450 Sold</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <p class="grow">Amoxicillin 250mg</p>
                            <p class="text-xs text-gray-500">310 Sold</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <p class="grow">Biogesic 500mg</p>
                            <p class="text-xs text-gray-500">285 Sold</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <p class="grow">Mefenamic Acid 500mg</p>
                            <p class="text-xs text-gray-500">190 Sold</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <p class="grow">Cetirizine 10mg</p>
                            <p class="text-xs text-gray-500">125 Sold</p>
                        </section>
                    </section>
                </section>

                <!-- Low Stock Alerts (5) -->
                <section class="col-span-1 flex flex-col gap-2 border border-gray-300 rounded-lg overflow-hidden">
                    <section class="flex items-center justify-between bg-secondary px-4 py-3 text-white">
                        <p class="font-semibold">Low Stocks Alert</p>
                        <a href="" class="text-xs">View all</a>
                    </section>
                    <section id="topSellingMedicineList" class="w-full h-full px-4 flex flex-col divide-y divide-gray-300">
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Amoxicillin 500mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-003</p>
                            </section>
                            <p class="text-red-600">3 left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Metformin 500mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-012</p>
                            </section>
                            <p class="text-red-600">5 left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Amlodipine 5mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-008</p>
                            </section>
                            <p class="text-red-600">8 left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-orange-400"></div>
                            <section class="grow">
                                <p class="">Loperamide 2mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-019</p>
                            </section>
                            <p class="text-orange-400">14 left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-orange-400"></div>
                            <section class="grow">
                                <p class="">Losartan 50mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-021</p>
                            </section>
                            <p class="text-orange-400">18 left</p>
                        </section>
                    </section>
                </section>

                <!-- Expiring Soon (5) -->
                <section class="col-span-1 flex flex-col gap-2 border border-gray-300 rounded-lg overflow-hidden">
                    <section class="flex items-center justify-between bg-secondary px-4 py-3 text-white">
                        <p class="font-semibold">Expiring Soon</p>
                        <a href="" class="text-xs">View all</a>
                    </section>
                    <section id="topSellingMedicineList" class="w-full h-full px-4 flex flex-col divide-y divide-gray-300">
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Amoxicillin 500mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-003</p>
                            </section>
                            <p class="text-red-600">3 days left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Metformin 500mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-012</p>
                            </section>
                            <p class="text-red-600">5 days left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-red-600"></div>
                            <section class="grow">
                                <p class="">Amlodipine 5mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-008</p>
                            </section>
                            <p class="text-red-600">8 days left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-orange-400"></div>
                            <section class="grow">
                                <p class="">Loperamide 2mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-019</p>
                            </section>
                            <p class="text-orange-400">14 days left</p>
                        </section>
                        <section class="flex gap-2 py-2 items-center justify-center py-1 grow">
                            <div class="size-2 rounded-full bg-orange-400"></div>
                            <section class="grow">
                                <p class="">Losartan 50mg</p>
                                <p class="text-[smaller] text-gray-500">BATCH-2026-021</p>
                            </section>
                            <p class="text-orange-400">18 days left</p>
                        </section>
                    </section>
                </section>
            </section>

            <section class="grid col-span-full grid-cols-1 gap-4 mt-5 md:grid-cols-4">
                <!-- Top 5 Customer Chart -->
                <section class="col-span-1 h-80 relative flex items-center justify-center md:col-span-2 lg:col-span-1">
                    <canvas id="dashboardPaymentMethodPieChart"></canvas>
                </section>

                <!-- Recent Transactions -->
                <section class="col-span-1 md:col-span-2 lg:col-span-3 h-fit flex flex-col gap-1">
                    <p>Recent Transactions</p>
                    <section class="col-span-full rounded-md h-full border border-gray-400/40 overflow-hidden">
                        <div class="max-h-full h-full w-full overflow-y-auto scrollbar-thin scrollbar-thumb-secondary rounded-b-lg">
                            <table class="w-full text-sm border-collapse">
                                <thead>
                                    <tr>
                                        <th class="sticky top-0 z-10 bg-secondary text-white text-start font-semibold text-md py-4 pl-5 rounded-tl-md md:table-cell w-full sm:w-50">Transaction Number</th>
                                        <th class="sticky top-0 z-10 bg-secondary text-white text-start font-semibold text-md py-4 pl-5 hidden sm:table-cell sm:w-80 md:w-110 lg:w-100 xl:w-120 2xl:w-180">Cashier</th>
                                        <th class="sticky top-0 z-10 bg-secondary text-white text-start font-semibold text-md py-4 pl-5 w-50 hidden xl:table-cell">Customer Type</th>
                                        <th class="sticky top-0 z-10 bg-secondary text-white text-start font-semibold text-md py-4 pl-5 hidden lg:table-cell">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="divide-y divide-slate-100 h-full">
                                    <tr class="bg-secondary/10 transition-colors border-b border-gray-100">
                                        <td class="py-4 pl-5 font-medium text-dark-blue">TXN-2026-00842</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">Renzo Tolentino</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">Regular</td>
                                        <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱1,294.00</td>
                                    </tr>

                                    <tr class="transition-colors border-b border-gray-100">
                                        <td class="py-4 pl-5 font-medium text-dark-blue">TXN-2026-00841</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">Maria Santos</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">Senior Citizen</td>
                                        <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱845.50</td>
                                    </tr>

                                    <tr class="bg-secondary/10 transition-colors border-b border-gray-100">
                                        <td class="py-4 pl-5 font-medium text-dark-blue">TXN-2026-00840</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">Renzo Tolentino</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">Student</td>
                                        <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱312.00</td>
                                    </tr>

                                    <tr class="transition-colors border-b border-gray-100">
                                        <td class="py-4 pl-5 font-medium text-dark-blue">TXN-2026-00841</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">Maria Santos</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">Senior Citizen</td>
                                        <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱845.50</td>
                                    </tr>

                                    <tr class="bg-secondary/10 transition-colors border-b border-gray-100">
                                        <td class="py-4 pl-5 font-medium text-dark-blue">TXN-2026-00840</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">Renzo Tolentino</td>
                                        <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">Student</td>
                                        <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱312.00</td>
                                    </tr>

                                    <tr id="emptySearchResultRow" class="hidden colspan-full">
                                        <td colspan="7">
                                            <div class="w-full h-full flex flex-col items-center justify-center gap-2 p-15 text-center">
                                                <p class="text-gray-600/80">No results to show.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </section>
            </section>

        </section>
    </main>

    <script src="../../js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboardPaymentMethodPieChart.js"></script>
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

        $("#toggleDateRangeFilterBtn").on("click", function() {
            $("#dashboardDateRangeFilter").toggleClass("hidden").toggleClass("opacity-0");
        })

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

        /*
        ==============================================================================
        HELPER FUNCTIONS, ADDITIONAL FUNCTIONS & EVENT LISTENER FUNCTIONS
        - Functions to help reduce redundancy
        ==============================================================================
        */
    </script>
</body>


</html>