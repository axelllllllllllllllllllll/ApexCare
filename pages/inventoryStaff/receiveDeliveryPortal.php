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
    <title>Inventory Staff | Delivery Management</title>
</head>

<body class="relative w-full h-dvh bg-white text-dark-blue text-sm font-display">
    <!-- Receive Delivery Side Panel Drawer -->
    <aside id="addRecordPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-600/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80dvh] bg-white shadow-2xl flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[35%] 2xl:w-[25%]">
            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Receive Delivery</h2>
                </section>
                <button onclick="toggleAddRecordPanel()" class="closeAddRecordBtn text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </section>

            <!-- Form Scroll Area -->
            <section id="deliveryForm" class="p-5 overflow-y-auto flex-1 flex flex-col gap-5 text-sm scrollbar-none">
                <!-- Delivery Info Header -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Delivery Information</label>

                    <!-- Supplier Select -->
                    <section>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Supplier Name</label>
                        <select id="receiveDeliverySuppliersList" class="required-input w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none"></select>
                    </section>

                </section>

                <!-- Medicine Item Entry Section -->
                <section class="flex flex-col gap-3">
                    <section class="flex justify-between items-center">
                        <label class="text-xs font-medium text-gray-400">Medicine Item Details</label>
                    </section>

                    <!-- Custom Dropdown with Search Input -->
                    <section class="relative">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Medicine Name</label>
                        <section class="relative">
                            <input id="receiveDeliveryMedicineNameInput" type="text" placeholder="Search medicine..." required class="required-input w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                        <section id="receiveDeliveryMedicineResultsList" class="hidden absolute w-full max-h-50 flex flex-col gap-2 overflow-scroll h-fit p-3 mt bg-gray-50 rounded-lg mt-2 border border-gray-200 scrollbar-none z-20"></section>
                    </section>

                    <!-- Batch Number & Expiry Date Row -->
                    <section class="grid grid-cols-2 gap-3">
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Batch Number</label>
                            <input id="receiveDeliveryBatchNumberInput" type="text" placeholder="e.g., BATCH-1001" required class="required-input w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Expiry Date</label>
                            <input id="receiveDeliveryExpireyDateInput" type="date" required class="required-input w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                    </section>

                    <!-- Unit Cost / Price Input -->
                    <section>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Unit Cost (₱)</label>
                        <input id="receiveDeliveryUnitCostInput" type="number" readonly required step="0.01" placeholder="0.00" class="required-input w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                    </section>

                    <!-- Received Quantity & Subtotal Controls -->
                    <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex items-center justify-between mt-1">
                        <section>
                            <p class="text-xs text-gray-500 mb-1">Received Quantity</p>
                            <section class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden">
                                <button onclick="decrementReceivedQuantity()" type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">
                                    <svg class="lucide lucide-minus size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                    </svg></button>
                                <input id="receiveDeliveryReceivedQuantityInput" type="number" value="1" min="1" required class="required-input  w-20 text-center text-sm font-semibold border-none focus:outline-none" />
                                <button onclick="incrementReceivedQuantity()" type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">
                                    <svg class="lucide lucide-plus size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </button>
                            </section>
                        </section>
                        <section class="text-right">
                            <p class="text-xs text-gray-500 mb-0.5">Subtotal</p>
                            <p class="text-base font-bold text-gray-900">₱<span id="receiveDeliverySubtotalDisplayText">0</span></p>
                        </section>
                    </section>

                    <!-- Add Item Button -->
                    <button id="addItemBtn" type="submit" class="w-full border-2 border-dashed border-gray-300 hover:border-secondary hover:text-secondary text-gray-600 font-semibold py-2 rounded-lg text-sm transition-colors flex items-center justify-center gap-1.5 mt-1 cursor-pointer">
                        <span>Add item</span>
                    </button>
                </section>

                <hr class="border-gray-100">

                <!-- Added Delivery Items List -->
                <section class="flex flex-col gap-3">
                    <section class="flex items-center justify-between">
                        <label class="text-xs font-medium text-gray-400">Added Delivery Items</label>
                        <span id="receiveDeliveryAddedItemCountDisplayText" class="text-xs font-semibold text-secondary bg-blue-50 px-2 py-0.5 rounded-full">2 Items</span>
                    </section>

                    <section id="addedItemsListContainer" class="flex flex-col gap-2.5"></section>
                </section>

                <hr class="border-gray-100">

                <!-- Summary Breakdown -->
                <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-col gap-2">
                    <label class="text-xs font-medium text-gray-400 mb-1">Delivery Summary</label>

                    <section class="flex justify-between font-bold text-gray-900 text-base">
                        <span>Total Amount</span>
                        <span class="text-emerald-600">₱<span id="receiveDeliveryTotalAmountDisplayText">0.00</span></span>
                    </section>
                </section>

            </section>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="button" class="closeAddRecordBtn w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Cancel
                </button>
                <button onclick="createDeliveryRecord()" type="submit" class="w-2/3 bg-primary hover:bg-secondary text-white font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Receive Delivery
                </button>
            </section>

        </section>
    </aside>

    <!-- Filter Panel -->
    <aside id="deliveryFilterPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-600/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80dvh] bg-white shadow-2xl flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[35%] 2xl:w-[25%]">
            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Filter</h2>
                </section>
                <button onclick="toggleFilterPanel()" type="button" class="closeFilterBtn text-gray-400 hover:text-gray-600 transition-colors p-1 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </section>

            <!-- Form Scroll Area -->
            <section class="p-5 overflow-y-auto flex-1 flex flex-col gap-5 text-sm scrollbar-none">
                <!-- Category 1: Supplier Dropdown -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Supplier</label>
                    <section>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Select Supplier</label>
                        <select id="supplierFilterSel" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none"></select>
                    </section>
                </section>

                <hr class="border-gray-100">

                <!-- Category 2: Received Date Range Section -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Received Date</label>

                    <section class="grid grid-cols-2 gap-3">
                        <!-- From Date Input -->
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">From</label>
                            <input type="date" id="fromDateFilterInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>

                        <!-- To Date Input -->
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">To</label>
                            <input type="date" id="toDateFilterInput" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                    </section>
                </section>
            </section>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="reset" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Reset
                </button>
                <button id="applyFilterBtn" type="button" class="w-2/3 bg-primary hover:bg-primary/90 text-white font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Apply Filters
                </button>
            </section>
        </section>
    </aside>

    <!-- Detail View Panel -->
    <aside id="viewDetailPanel" class="hidden fixed bottom-0 right-0 z-60 bg-gray-900/40 w-dvw h-dvh border-l flex flex-col justify-end font-display transition duration-200 lg:flex-row">
        <!-- Main Content Wrapper -->
        <section class="w-full h-[80%] flex flex-col bg-white p-6 justify-between overflow-y-auto scrollbar-none lg:h-dvh lg:w-[40%] xl:w-[35%] 2xl:w-[25%]">

            <section class="flex flex-col w-full gap-6 items-start justify-between">
                <!-- Header & Close Button -->
                <section class="flex items-start justify-between pb-2 w-full border-b border-gray-100">
                    <div>
                        <h2 id="deliveryNumberDisplayText" class="text-xl font-bold text-gray-900 leading-tight mt-0.5">PO-2026-089</h2>
                    </div>
                    <button onclick="toggleViewDetailPanel()" class="closeViewDetailPanelBtn text-gray-400 transition-colors cursor-pointer hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </section>

                <!-- Order Status & Supplier Summary Card -->
                <section class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col gap-2 w-full">
                    <section class="flex flex-col gap-0.5 mt-1">
                        <span class="text-xs text-medium-400 text-gray-400 font-medium">Supplier</span>
                        <span id="supplierDisplayText" class="text-xl font-extrabold text-gray-900">VIP Pharma Supplies</span>
                    </section>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <span>Received Date:</span>
                        <span id="receivedDateDisplayText" class="font-semibold text-gray-700">Aug 22, 2026</span>
                    </p>
                </section>


                <!-- Received Items List -->
                <section class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-medium text-gray-400">Received Items</h3>
                        <span id="receivedItemsCountDisplayText" class="text-xs text-gray-500 font-medium">asd</span>
                    </div>

                    <!-- Items Container -->
                    <div id="receivedItemList" class="flex flex-col gap-2.5 grow overflow-y-auto pr-1">

                    </div>

                    <!-- Overall Order Financial Summary -->
                    <div class="bg-gray-100/70 p-3.5 rounded-xl flex flex-col gap-1.5 mt-1 text-sm">
                        <div class="flex justify-between font-bold text-gray-900 text-base border-t border-gray-200 pt-2 mt-0.5">
                            <p>Total Cost</p>
                            <p id="deliveryGrandTotalDisplayText" class="text-green-700"></p>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </aside>

    <!-- Main Content -->
    <main class="w-full h-dvh min-h-full grid grid-cols-1 divide-x divide-primary/20 lg:grid-cols-[auto_1fr]">
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
                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="sidebar-hidden-item font-medium text-white/60 lg:hidden lg:text-dark-blue/30">Procurement</p>
                    <a href=" ../admin/deliveryMangement.php" class="bg-primary text-white rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-truck-icon lucide-truck size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                        <p class="sidebar-hidden-item text-start lg:hidden">Delivery Management</p>
                    </a>
                </section>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="w-full h-dvh p-5 px-8 grid grid-cols-1 grid-rows-[auto_auto_12fr] gap-8 md:grid-cols-2 lg:grid-cols-4 lg:gap-3 overflow-y-scroll scrollbar-thin scrollbar-thumb-secondary">
            <!-- Header -->
            <section class="col-span-full flex items-center justify-between">
                <section class="flex items-center gap-3">
                    <p class="col-span-full flex items-center text-lg font-medium md:text-2xl">Deliveries</p>
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

            <!-- Search, Filter & Add Delivery Record button -->
            <section class="col-span-full flex gap-2 items-center justify-between flex-col sm:flex-row">
                <section class="flex items-center gap-2 h-fit w-full">
                    <form id="searchDeliveryForm" class="border border-primary flex items-center gap-2 p-2 pr-3 rounded-md w-full h-fit sm:w-80 md:w-100">
                        <svg class="lucide lucide-search-icon lucide-search size-4.5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34" />
                            <circle cx="11" cy="11" r="8" />
                        </svg>
                        <input class="outline-0 text-sm w-full " type="text" name="medicineSearchQuery" id="searchDeliveryRecordInput">
                    </form>
                    <button id="showDeliverFilterPanelBtn" onclick="toggleFilterPanel()" class="bg-primary text-white size-9 p-2 rounded-md flex items-center justify-center cursor-pointer hover:bg-primary/90">
                        <svg class="lucide lucide-funnel-icon lucide-funnel size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z" />
                        </svg>
                    </button>
                </section>

                <button onclick="toggleAddRecordPanel()" class="bg-primary px-4 py-2 pr-5 rounded-md text-white cursor-pointer flex items-center justify-center gap-1 w-full sm:w-80 md:w-100">
                    <svg class="lucide lucide-download-icon lucide-download size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 15V3" />
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                    <p>Receive Delivery</p>
                </button>
            </section>

            <!-- Table records -->
            <section class="col-span-full rounded-md h-full border border-gray-400/40 overflow-hidden">
                <div class="max-h-full h-full w-full overflow-y-auto scrollbar-thin scrollbar-thumb-secondary rounded-b-lg">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr>
                                <th class="sticky top-0 z-10 bg-primary text-white text-start font-semibold text-md py-4 pl-5 rounded-tl-md md:table-cell w-full sm:w-50">Delivery Number</th>
                                <th class="sticky top-0 z-10 bg-primary text-white text-start font-semibold text-md py-4 pl-5 hidden sm:table-cell sm:w-80 md:w-110 lg:w-100 xl:w-120 2xl:w-180">Supplier</th>
                                <th class="sticky top-0 z-10 bg-primary text-white text-start font-semibold text-md py-4 pl-5 w-50 hidden xl:table-cell">Received Date</th>
                                <th class="sticky top-0 z-10 bg-primary text-white text-start font-semibold text-md py-4 pl-5 hidden lg:table-cell">Total Cost</th>
                                <th class="sticky top-0 z-10 bg-primary text-white text-start font-semibold text-md py-4 pl-5 pr-5 rounded-tr-md"></th>

                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-slate-100">
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
    <script src="../../js/helperFunctions.js"></script>
    <script>
        $(document).ready(() => {
            displayAllDeliveryRecordByReceiverId(6);

            displayAllSuppliers();
        })

        /*
        ==============================================================================
        MAIN FUNCTIONS 
         - Functions that are needed and do specific things 
        ==============================================================================
        */
        let receivedItemsList = [];
        let cartItems = [];

        // Create a render function for table row
        function displayAllDeliveryRecordByReceiverId(userId) {
            let data = {
                action: "getFilteredDeliveryRecord",
                search_query: $("#searchDeliveryRecordInput").val(),
                inventory_staff_id: userId, // Change this later into session value
                supplier_name_filter: $("#supplierFilterSel").val(),
                from_date: $("#fromDateFilterInput").val(),
                to_date: $("#toDateFilterInput").val(),
            };

            let rows = "";

            $("#tableBody").html("");
            $.post("../../controller/deliveryController.php", data, function(response) {

                // Error Handling Here
                if (response.status && response.status === "error") {
                    console.log(response.message);
                }

                for (let index = 0; index < response.length; index++) {
                    const delivery = response[index];

                    rows += `
                        <tr class="${index % 2 === 0 ? 'bg-secondary/10' : ''} transition-colors border-b border-gray-100">
                            <td class="py-4 pl-5 font-medium text-dark-blue">${delivery.delivery_number}</td>
                            <td class="py-4 pl-5 text-gray-600 hidden sm:table-cell truncate max-w-0">${delivery.supplier_name}</td>
                            <td class="py-4 pl-5 text-gray-600 hidden xl:table-cell">${delivery.received_date}</td>
                            <td class="py-4 pl-5 font-semibold text-gray-900 hidden lg:table-cell">₱${delivery.total_cost}</td>
                            <td class="py-4 pl-5 pr-5 flex items-center justify-end">
                                <button onclick="openViewDetailPanel(${delivery.delivery_id})" class="viewDetailBtn bg-primary hover:bg-primary/90 text-white rounded-md flex items-center gap-1 px-3 py-2 cursor-pointer transition-colors text-xs font-medium">
                                    <svg class="lucide lucide-eye size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <p class="hidden md:block">View details</p>
                                </button>
                            </td>
                        </tr>
                    `;
                }

                $("#tableBody").html(rows);
            })
        }

        function openViewDetailPanel(deliveryId) {
            toggleViewDetailPanel();

            let data = {
                action: "getDeliveryRecordById",
                delivery_id: deliveryId
            }

            $.post("../../controller/deliveryController.php", data, function(response) {

                let receivedItemsList = "";
                let completedItemsList = "";

                if (response.status.toLowerCase() === "success") {
                    let delivery = response;
                    let deliveryRecord = delivery.delivery_record_detail;
                    let deliveryItem = delivery.delivery_items;
                    let grandTotal = delivery.grand

                    // Error Handling Here

                    $("#deliveryNumberDisplayText").text(deliveryRecord.delivery_number);
                    $("#supplierDisplayText").text(deliveryRecord.supplier_name);
                    $("#receivedItemsCountDisplayText").text(deliveryRecord.received_date);

                    $("#receivedItemsCountDisplayText").text(`${deliveryItem.length} Items`);
                    $("#deliveryGrandTotalDisplayText").text(`₱${delivery.grand_total.total_amount}`);

                    for (let index = 0; index < deliveryItem.length; index++) {
                        let item = deliveryItem[index];

                        displayCompletedOrdersByDeliveryDetailId(item.delivery_detail_id);

                        receivedItemsList += `
                            <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-2">
                                <div class="flex flex-col justify-between items-start">
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-between items-start w-full">
                                            <p class="font-semibold text-gray-900 text-sm leading-tight">${item.medicine_name}</p>
                                            <p class="">Completed</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-0.5">${item.batch_number}</p>
                                    </div>
                                    <div class="mt-4 w-full">
                                        <div class="w-full flex items-center justify-between">
                                            <p class="text-xs text-gray-500 mt-0.5">Received Quantity</p>
                                            <p class="text-xs text-gray-500 mt-0.5">${item.received_quantity}</p>
                                        </div>
                                        <div class="w-full flex items-center justify-between">
                                            <p class="text-xs text-gray-500 mt-0.5">Unit Price</p>
                                            <p class="text-xs text-gray-500 mt-0.5">${item.unit_price}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-gray-900 text-sm">₱${item.sub_total_amount}</span>
                                </div>

                                <section class="flex flex-col justify-between gap-2 border-t border-gray-200/60 pt-2 text-xs text-gray-600 w-full h-fit overflow-scroll scrollbar-none">
                                    <button onclick="toggleCompletedOrdersPanel(${item.delivery_detail_id})" class="flex justify-between items-center mt-2 text-xs text-gray-600 cursor-pointer">
                                        <p class="text-xs text-gray-600">Completed Orders (<span id="completedOrdersCountDisplayText${item.delivery_detail_id}">2</span>)</p>
                                        <svg class="lucide lucide-chevron-down size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>
                                    
                                    <section id="completedOrderList${item.delivery_detail_id}" class="h-0 opacity-0 w-full flex flex-col gap-5 divide divide-y-gray-600 transition duration-500">
                                        
                                    </section>
                                </section>
                            </div>
                        `
                    }

                    $("#receivedItemList").html(receivedItemsList);
                }
            })
        }

        function displayCompletedOrdersByDeliveryDetailId(deliveryDetailId) {
            let data = {
                action: "getCompletedOrderByDeliveryDetailId",
                delivery_detail_id: deliveryDetailId
            };

            $.post("../../controller/orderController.php", data, function(response) {
                $(`#completedOrdersCountDisplayText${deliveryDetailId}`).text(response.data.length);

                let completedItemsList = "";
                for (let index = 0; index < response.data.length; index++) {
                    const item = response.data[index];


                    completedItemsList += `
                        <section class="pt-2 text-xs text-gray-600 w-full h-fit">
                            <div class="w-full flex items-center justify-between">
                                <p class="font-semibold text-gray-900 text-sm leading-tight mb-2">${item.order_number}2</p>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <p>Requested Quantity</p>
                                <p>${item.request_quantity}</p>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <p>Received Quantity</p>
                                <p>${item.received_quantity}</p>
                            </div>
                        </section>
                    `;
                }

                $(`#completedOrderList${deliveryDetailId}`).html(completedItemsList);
            })
        }

        function displayAllSuppliers() {
            let data = {
                action: "getAllSuppliers"
            };

            $.post("../../controller/supplierController.php", data, function(response) {
                let suppliersList = response.data;

                let options = "";

                $("#supplierFilterSel").append(options);
                $("#receiveDeliverySuppliersList").append(options);
                for (let index = 0; index < suppliersList.length; index++) {
                    let supplier = suppliersList[index];

                    options += `
                    <option value="${supplier.name}">${supplier.name}</option>
                    `
                }
                $("#supplierFilterSel").append(`<option value="">All Suppliers</option>` + options);
                $("#receiveDeliverySuppliersList").append(options);
            })
        }

        function displayMedicineByName(medicineName = "") {
            let data = {
                action: "getMedicineByName",
                medicine_name_to_search: medicineName
            };

            $.post("../../controller/medicineController.php", data, function(response) {
                // Error Handling

                let medicineList = response.data;

                if (medicineList.length == 0) {
                    $("#receiveDeliveryMedicineResultsList").html(`<p class="text-xs text-center text-gray-400 font-regular cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">There is no matching result</p>`);
                    return;
                }

                let list = "";
                $("#receiveDeliveryMedicineResultsList").html(list);
                for (let index = 0; index < medicineList.length; index++) {
                    let medicine = medicineList[index];

                    list = `
                        <p id="medicineItem${medicine.medicine_id}" class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">${medicine.name}</p>                        
                    `

                    $("#receiveDeliveryMedicineResultsList").append(list);

                    $(`#medicineItem${medicine.medicine_id}`).click(() => {
                        $("#receiveDeliveryMedicineNameInput").val(medicine.name).focusout();
                        hideReceiveDeliveryMedicineNameResultsList()

                        $("#receiveDeliveryUnitCostInput").val(medicine.selling_price)
                        computeReceivedQuantitySubtotal();
                    })
                }


            })
        }

        function addReceivedItem() {
            let receivedItem = {
                supplierName: $("#receiveDeliverySuppliersList").val().trim(),
                medicineName: $("#receiveDeliveryMedicineNameInput").val().trim(),
                batchNumber: $("#receiveDeliveryBatchNumberInput").val().trim(),
                expiryDate: $("#receiveDeliveryExpireyDateInput").val().trim(),
                unitPrice: Number.parseFloat($("#receiveDeliveryUnitCostInput").val().trim()),
                receivedQuantity: $("#receiveDeliveryReceivedQuantityInput").val().trim(),
                subtotal: Number.parseFloat($("#receiveDeliverySubtotalDisplayText").text().trim()),
                cashierId: 6,
            };

            let inputList = $("#deliveryForm input");
            let isInputFilled = true;

            for (let index = 0; index < inputList.length; index++) {
                const input = inputList[index];

                if (isEmptyField(input.id)) {
                    $(`#${input.id}`).removeClass("focus:ring-secondary focus:ring-secondary focus:ring-2")
                        .addClass("border-red-700 bg-red-100 text-red-700 focus:ring-red-700 focus:ring-1")
                        .focus();

                    isInputFilled = false;
                    break;
                } else {
                    $(`#${input.id}`).removeClass("border-red-700 bg-red-100 text-red-700 focus:ring-red-700")
                        .addClass("border-gray-300 bg-gray-50 text-black focus:ring-red-700 focus:ring-secondary focus:outline-none");
                }
            }

            if (isInputFilled) {
                cartItems.push(receivedItem);

                inputList.val("");
                $("#receiveDeliverySubtotalDisplayText").text("0")

                displayReceivedItems();
            }
        }

        function removeReceivedItem(cartIndex) {
            cartItems.splice(cartIndex, 1);

            displayReceivedItems();
        }

        function displayReceivedItems() {
            let items = cartItems;
            let totalAmount = 0;
            $("#addedItemsListContainer").html("");

            items.forEach((item, index) => {
                let newItem = `
                    <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2 relative group">
                        <section class="flex justify-between items-start pr-6">
                            <section>
                                <p class="font-semibold text-gray-900 text-sm leading-tight">${item.medicineName}</p>
                                <p class="text-xs text-gray-500 mt-0.5">Batch: ${item.batchNumber}</p>
                                <p class="text-xs text-gray-500 mt-0.5">Exp: ${item.expiryDate}</p>
                            </section>
                            <p class="font-bold text-gray-900 text-sm">₱${item.subtotal}</p>
                        </section>
                        <section class="flex justify-between item-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                            <span>₱${item.unitPrice} × ${item.receivedQuantity} pcs</span>
                            <span class="text-gray-400 font-medium">Subtotal</span>
                        </section>
                        <!-- Remove Button -->
                        <button onclick="removeReceivedItem(${index})" type="button" class="absolute top-3 right-2 text-gray-400 hover:text-red-500 transition-colors p-1" title="Remove Item">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </section>
                `;

                totalAmount += Number.parseFloat(item.subtotal);

                $("#addedItemsListContainer").append(newItem);
            });

            $("#receiveDeliveryAddedItemCountDisplayText").text(items.length + " Item(s)");
            $("#receiveDeliveryTotalAmountDisplayText").text(formatter.format(totalAmount));
        }

        function createDeliveryRecord() {
            let data = {
                action: "createDeliveryRecord",
                deliveryRecordDetails: {
                    supplier_name: $("#receiveDeliverySuppliersList").val().trim(),
                    receiver_id: 6, // Channge this later
                    total_amount: Number.parseFloat($("#receiveDeliveryTotalAmountDisplayText").text().trim()) || 0,

                },
                deliveryItems: cartItems
            };

            // if (data.deliveryItems.length === 0) {
            //     console.log("There are no items recorded.");
            //     return;
            // }

            $.post("../../controller/deliveryController.php", data, function(response) {
                console.log(response);
            })
        }


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

        function toggleFilterPanel() {
            $("#deliveryFilterPanel").toggleClass("hidden");
        }

        function toggleAddRecordPanel() {
            $("#addRecordPanel").toggleClass("hidden");
            displayReceivedItems();
        }

        function toggleViewDetailPanel() {
            $("#viewDetailPanel").toggleClass("hidden");
        }

        function toggleCompletedOrdersPanel(index) {
            $(`#completedOrderList${index}`).toggleClass("h-0 opacity-0");
        }

        function showReceiveDeliveryMedicineNameResultsList() {
            $(`#receiveDeliveryMedicineResultsList`).show();
        }

        function hideReceiveDeliveryMedicineNameResultsList() {
            $(`#receiveDeliveryMedicineResultsList`).hide();
        }

        /*
        ==============================================================================
        HELPER FUNCTIONS, ADDITIONAL FUNCTIONS & EVENT LISTENER FUNCTIONS
        - Functions to help reduce redundancy
        ==============================================================================
        */
        const formatter = new Intl.NumberFormat('en-US');

        // Function to compute for Received Quantity Subtotal
        function computeReceivedQuantitySubtotal() {
            let unitPriceInput = $("#receiveDeliveryUnitCostInput").val().trim();
            let quantityInput = $("#receiveDeliveryReceivedQuantityInput").val().trim() || 0;

            let invalidChars = ["+", "-", "e", "E"];
            if (!isValidInput(invalidChars, quantityInput)) {
                return;
            }

            let result = (Number.parseFloat(unitPriceInput) * Number.parseFloat(quantityInput)) || 0;
            if (!Number.isNaN(result) && result > -1) {
                $("#receiveDeliverySubtotalDisplayText").text(`${formatter.format(result)}`);
            }
        }

        $("#applyFilterBtn").click(() => {
            displayAllDeliveryRecordByReceiverId(6);

            toggleFilterPanel();
        })

        $("#searchDeliveryForm").submit((e) => {
            e.preventDefault();

            // Change Later
            displayAllDeliveryRecordByReceiverId(6)
        })

        $("#addItemBtn").on("click", (e) => {
            // e.preventDefault();

            addReceivedItem();
        })

        // Check if the input field is empty
        function isEmptyField(inputFieldId) {
            if ($(`#${inputFieldId}`).val() == "" || $(`#${inputFieldId}`).val() == 0) {
                return true;
            }

            return false;
        }

        // Increment and Decrement Received Quantity
        function incrementReceivedQuantity() {
            let receiveQuantityTxt = $("#receiveDeliveryReceivedQuantityInput");
            let currentReceivedQuantity = Number.parseFloat(receiveQuantityTxt.val() || 0);

            $("#receiveDeliveryReceivedQuantityInput").val(currentReceivedQuantity += 1);

            computeReceivedQuantitySubtotal()
        }

        function decrementReceivedQuantity() {
            let receiveQuantityTxt = $("#receiveDeliveryReceivedQuantityInput");
            let currentReceivedQuantity = Number.parseFloat(receiveQuantityTxt.val() || 0);

            if (currentReceivedQuantity > 1) {
                $("#receiveDeliveryReceivedQuantityInput").val(currentReceivedQuantity -= 1);

                computeReceivedQuantitySubtotal()
            }
        }

        // Debounce Function when the Inventory Staff types inside the medicine name input
        let timeout;
        $("#receiveDeliveryMedicineNameInput").on("input", () => {

            clearTimeout(timeout);

            let medicineToSearch = $("#receiveDeliveryMedicineNameInput").val().trim();

            timeout = setTimeout(() => {
                displayMedicineByName(medicineToSearch);

                if (medicineToSearch === "") {
                    hideReceiveDeliveryMedicineNameResultsList();
                } else {
                    showReceiveDeliveryMedicineNameResultsList();
                }
            }, 500);
        })

        // Debounce Function when the Inventory Staff types inside the received quantity input
        $("#receiveDeliveryReceivedQuantityInput").on("input", (e) => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                computeReceivedQuantitySubtotal();
            }, 500);
        });
        $("#receiveDeliveryReceivedQuantityInput").on("keydown", (e) => {
            if (e.key == "+" || e.key == "-" || e.key == "e" || e.key == "E") {
                e.preventDefault();
                return;
            }
        });
        $("#receiveDeliveryReceivedQuantityInput").on("paste", (e) => {
            let pastedText = (e.originalEvent.clipboardData || window.clipboardData).getData("text");
            let invalidChars = ["+", "-", "e", "E"];

            if (!isValidInput(invalidChars, pastedText)) {
                e.preventDefault();
                return;
            }
        });
    </script>

</body>

</html>