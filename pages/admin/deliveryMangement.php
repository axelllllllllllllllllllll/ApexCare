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
    <title>Admin | Purchase Record</title>
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

    <!-- Receive Delivery Side Panel Drawer -->
    <aside id="addRecordPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-600/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80dvh] bg-white shadow-2xl flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[25%]">
            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Receive Delivery</h2>
                </section>
                <button class="closeAddRecordBtn text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </section>

            <!-- Form Scroll Area -->
            <section class="p-5 overflow-y-auto flex-1 flex flex-col gap-5 text-sm scrollbar-none">
                <!-- Delivery Info Header -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Delivery Information</label>

                    <!-- Supplier Select -->
                    <section>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Supplier Name</label>
                        <select class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none">
                            <option value="">Select Supplier</option>
                            <option value="1">PharmaCorp Inc.</option>
                            <option value="2">MedSupply Co.</option>
                            <option value="3">Global Health Ltd.</option>
                            <option value="4">BioCare Pharma</option>
                            <option value="5">Apex Distribution</option>
                        </select>
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
                            <input type="text" placeholder="Search medicine..." class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-9 pr-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </section>
                        <section class="hidden absolute w-full max-h-50 flex flex-col gap-2 overflow-scroll h-fit p-3 mt bg-gray-50 rounded-lg mt-2 border border-gray-200 scrollbar-none z-20">
                            <p class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Amoxicillin 500mg</p>
                            <p class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Paracetamol 500mg</p>
                            <p class="cursor-pointer hover:bg-gray-200 p-3 rounded-sm transition duration-100">Cetirizine HCl 10mg</p>
                        </section>
                    </section>

                    <!-- Batch Number & Expiry Date Row -->
                    <section class="grid grid-cols-2 gap-3">
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Batch Number</label>
                            <input type="text" placeholder="e.g., BATCH-1001" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Expiry Date</label>
                            <input type="date" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                    </section>

                    <!-- Unit Cost / Price Input -->
                    <section>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Unit Cost (₱)</label>
                        <input type="number" step="0.01" placeholder="0.00" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none" />
                    </section>

                    <!-- Received Quantity & Subtotal Controls -->
                    <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex items-center justify-between mt-1">
                        <section>
                            <p class="text-xs text-gray-500 mb-1">Received Qty</p>
                            <section class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden">
                                <button type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">-</button>
                                <input type="number" value="1" min="1" class="w-12 text-center text-sm font-semibold border-none focus:outline-none" />
                                <button type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">+</button>
                            </section>
                        </section>
                        <section class="text-right">
                            <p class="text-xs text-gray-500 mb-0.5">Subtotal</p>
                            <p class="text-base font-bold text-gray-900">₱0.00</p>
                        </section>
                    </section>

                    <!-- Add Item Button -->
                    <button type="button" class="w-full border-2 border-dashed border-gray-300 hover:border-secondary hover:text-secondary text-gray-600 font-semibold py-2 rounded-lg text-sm transition-colors flex items-center justify-center gap-1.5 mt-1 cursor-pointer">
                        <span>Add item</span>
                    </button>
                </section>

                <hr class="border-gray-100">

                <!-- Added Delivery Items List -->
                <section class="flex flex-col gap-3">
                    <section class="flex items-center justify-between">
                        <label class="text-xs font-medium text-gray-400">Added Delivery Items</label>
                        <span class="text-xs font-semibold text-secondary bg-blue-50 px-2 py-0.5 rounded-full">2 Items</span>
                    </section>

                    <section class="flex flex-col gap-2.5">
                        <!-- Added Delivery Item 1 -->
                        <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2 relative group">
                            <section class="flex justify-between items-start pr-6">
                                <section>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">Amoxicillin (Amoxil)</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Batch: BATCH-1001 • Exp: 2027-06-30</p>
                                </section>
                                <p class="font-bold text-gray-900 text-sm">₱625.00</p>
                            </section>
                            <section class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                <span>₱12.50 × 50 pcs</span>
                                <span class="text-gray-400 font-medium">Subtotal</span>
                            </section>
                            <!-- Remove Button -->
                            <button type="button" class="absolute top-3 right-2 text-gray-400 hover:text-red-500 transition-colors p-1" title="Remove Item">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </section>

                        <!-- Added Delivery Item 2 -->
                        <section class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2 relative group">
                            <section class="flex justify-between items-start pr-6">
                                <section>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">Paracetamol (Biogesic)</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Batch: BATCH-1002 • Exp: 2027-08-15</p>
                                </section>
                                <p class="font-bold text-gray-900 text-sm">₱4,500.00</p>
                            </section>
                            <section class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                <span>₱45.00 × 100 pcs</span>
                                <span class="text-gray-400 font-medium">Subtotal</span>
                            </section>
                            <!-- Remove Button -->
                            <button type="button" class="absolute top-3 right-2 text-gray-400 hover:text-red-500 transition-colors p-1" title="Remove Item">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </section>
                    </section>
                </section>

                <hr class="border-gray-100">

                <!-- Summary Breakdown -->
                <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-col gap-2">
                    <label class="text-xs font-medium text-gray-400 mb-1">Delivery Summary</label>

                    <section class="flex justify-between font-bold text-gray-900 text-base">
                        <span>Total Amount</span>
                        <span class="text-emerald-600">₱5,125.00</span>
                    </section>
                </section>

            </section>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="button" class="closeAddRecordBtn w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Cancel
                </button>
                <button type="submit" class="w-2/3 bg-primary hover:bg-secondary text-white font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Receive Delivery
                </button>
            </section>

        </section>
    </aside>

    <!-- Filter Panel -->
    <aside id="poFilterPanel" class="hidden fixed z-60 flex items-end justify-end bg-gray-600/40 w-full h-dvh">
        <!-- Panel Content -->
        <section class="relative z-10 w-full h-[80dvh] bg-white shadow-2xl flex flex-col justify-between font-display lg:h-dvh lg:w-[40%] xl:w-[25%]">
            <!-- Header -->
            <section class="p-5 border-b flex items-center justify-between bg-gray-50/50">
                <section>
                    <h2 class="text-lg font-bold text-gray-900">Filter</h2>
                </section>
                <button type="button" class="closeFilterBtn text-gray-400 hover:text-gray-600 transition-colors p-1">
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
                        <select class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none">
                            <option value="">All Suppliers</option>
                            <option value="unilab">Unilab Pharmaceuticals</option>
                            <option value="zuellig">Zuellig Pharma</option>
                            <option value="pascual">Pascual Laboratories</option>
                            <option value="pfizer">Pfizer Philippines</option>
                            <option value="mylan">Mylan Healthcare</option>
                        </select>
                    </section>
                </section>

                <hr class="border-gray-100">

                <!-- Category 2: Delivery Date Range Section -->
                <section class="flex flex-col gap-3">
                    <label class="text-xs font-medium text-gray-400">Delivery Date</label>

                    <section class="grid grid-cols-2 gap-3">
                        <!-- From Date Input -->
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">From</label>
                            <input type="date" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>

                        <!-- To Date Input -->
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">To</label>
                            <input type="date" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:ring-2 focus:ring-secondary focus:outline-none" />
                        </section>
                    </section>
                </section>
            </section>

            <!-- Footer Action Buttons -->
            <section class="p-4 border-t bg-white flex items-center gap-3">
                <button type="reset" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Reset
                </button>
                <button type="button" class="w-2/3 bg-primary hover:bg-primary/90 text-white font-medium py-2.5 rounded-lg text-sm transition-colors">
                    Apply Filters
                </button>
            </section>
        </section>
    </aside>

    <!-- Detail View Panel -->
    <aside id="viewDetailPanel" class="hidden fixed bottom-0 right-0 z-60 bg-gray-900/40 w-dvw h-dvh border-l flex flex-col justify-end font-display transition duration-200 lg:flex-row">
        <!-- Main Content Wrapper -->
        <section class="w-full h-[80%] flex flex-col bg-white p-6 justify-between lg:h-dvh lg:w-[40%] xl:w-[25%] overflow-y-auto scrollbar-none">

            <section class="flex flex-col w-full gap-6 items-start justify-between">
                <!-- Header & Close Button -->
                <section class="flex items-start justify-between pb-2 w-full border-b border-gray-100">
                    <div>
                        <span class="text-xs medium-semibold text-secondary">Purchase Order</span>
                        <h2 class="text-xl font-bold text-gray-900 leading-tight mt-0.5">PO-2026-089</h2>
                    </div>
                    <button class="closeViewDetailPanelBtn text-gray-400 transition-colors cursor-pointer hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </section>

                <!-- Order Status & Supplier Summary Card -->
                <section class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col gap-2 w-full">
                    <section class="flex items-center justify-between">
                        <span class="text-xs font-medium text-gray-500">Fulfillment Status</span>
                        <span class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            Completed
                        </span>
                    </section>
                    <section class="flex flex-col gap-0.5 mt-1">
                        <span class="text-xs text-medium-400 font-medium">Supplier</span>
                        <span class="text-xl font-extrabold text-gray-900">VIP Pharma Supplies</span>
                    </section>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <span>Order Date:</span>
                        <span class="font-semibold text-gray-700">Aug 22, 2026</span>
                    </p>
                </section>

                <!-- Purchased Items List -->
                <section class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-medium text-gray-400">Ordered Items</h3>
                        <span class="text-xs text-gray-500 font-medium">3 Items</span>
                    </div>

                    <!-- Items Container -->
                    <div class="flex flex-col gap-2.5 max-h-[320px] overflow-y-auto pr-1">

                        <!-- Item 1 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">Amoxicillin 500mg</p>
                                    <p class="text-xs text-gray-500 mt-0.5">BN-2026-001</p>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">₱30.00</p>
                            </div>
                            <div class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                <span>₱15.00 x 2 pcs</span>
                                <span class="text-gray-400 font-medium">Subtotal</span>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">Paracetamol 500mg</p>
                                    <p class="text-xs text-gray-500 mt-0.5">BN-2026-042</p>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">₱75.00</p>
                            </div>
                            <div class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                <span>₱7.50 x 10 pcs</span>
                                <span class="text-gray-400 font-medium">Subtotal</span>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col gap-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">Cetirizine HCl 10mg</p>
                                    <p class="text-xs text-gray-500 mt-0.5">BN-2026-108</p>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">₱60.00</p>
                            </div>
                            <div class="flex justify-between items-center border-t border-gray-200/60 pt-2 text-xs text-gray-600">
                                <span>₱12.00 × 5 pcs</span>
                                <span class="text-gray-400 font-medium">Subtotal</span>
                            </div>
                        </div>

                    </div>

                    <!-- Overall Order Financial Summary -->
                    <div class="bg-gray-100/70 p-3.5 rounded-xl flex flex-col gap-1.5 mt-1 text-sm">
                        <div class="flex justify-between font-bold text-gray-900 text-base border-t border-gray-200 pt-2 mt-0.5">
                            <span>Total Cost</span>
                            <span class="text-emerald-600">₱150.00</span>
                        </div>
                    </div>
                </section>
            </section>

            <!-- Quick Action Footer -->
            <section class="pt-4 mt-6 border-t border-gray-100 flex flex-col gap-2">
                <button class="w-full bg-red-50 border border-red-200 text-red-700 hover:bg-red-100 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors cursor-pointer">
                    Delete
                </button>
            </section>
        </section>
    </aside>

    <!-- Main Content -->
    <main class="w-full h-fit min-h-full grid grid-cols-1 divide-x divide-primary/20 lg:grid-cols-[auto_1fr]">
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
                    <a href="../admin/dashboard.php" class="rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 xl:w-full hover:bg-secondary/40 transition duration-100">
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
        <section class="w-full h-dvh p-5 px-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4 lg:gap-3 lg:grid-rows-[auto_auto_12fr] overflow-y-scroll scrollbar-thin scrollbar-thumb-secondary">
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
                    <button class="bg-primary text-white size-9 p-2 rounded-md flex items-center justify-center cursor-pointer hover:bg-primary/90">
                        <svg class="lucide lucide-funnel-icon lucide-funnel size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z" />
                        </svg>
                    </button>
                </section>

                <button class="bg-primary px-4 py-2 pr-5 rounded-md text-white cursor-pointer flex items-center justify-center gap-1 w-full sm:w-80 md:w-100">
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
                    <table class="w-full text-sm border-collapse relative">
                        <thead>
                            <tr>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 rounded-tl-md md:table-cell">Delivery Number</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden w-[55%] sm:w-[75%] md:w-100 md:table-cell lg:w-200">Supplier</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 w-50 hidden xl:table-cell">Delivery Date</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 hidden lg:table-cell">Total Cost</th>
                                <th class="text-start text-white sticky top-0 bg-secondary font-semibold text-md py-4 pl-5 pr-5 rounded-tr-md lg:w-50"></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-slate-100">
                            <tr class="h-1 border-b border-gray-100 hover:bg-gray-50/50 transition-colors">
                                <td class="max-w-[0] truncate py-4 pl-5 font-semibold text-gray-900">
                                    DL-2026-090
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden md:table-cell">
                                    <div>
                                        <p class="truncate font-medium text-gray-900">VIP Pharma Supplies VIP Pharma Supplies</p>
                                    </div>
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden xl:table-cell text-gray-600">
                                    Aug 22, 2026
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 hidden lg:table-cell font-bold text-gray-900">
                                    ₱24,500.00
                                </td>
                                <td class="max-w-[0] truncate py-4 pl-5 pr-5">
                                    <button class="viewDetailBtn bg-primary hover:bg-primary/90 text-white rounded-md flex items-center gap-1 px-3 py-2 cursor-pointer transition-colors text-xs font-medium">
                                        <svg class="lucide lucide-eye size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <p class="hidden md:block">View details</p>
                                    </button>
                                </td>
                            </tr>

                            <!-- Empty Row -->
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


        /*
        ==============================================================================
        HELPER FUNCTIONS, ADDITIONAL FUNCTIONS & EVENT LISTENER FUNCTIONS
        - Functions to help reduce redundancy
        ==============================================================================
        */
    </script>
</body>


</html>