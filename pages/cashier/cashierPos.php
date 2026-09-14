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
    <!-- Cashier POS -->
    <main class="w-full h-fit min-h-full grid grid-cols-1 divide-x divide-primary/20 lg:grid-cols-[7dvw_auto_10dvw] xl:lg:grid-cols-[15dvw_auto_20dvw] 3xl:grid-cols-[400px_auto_500px] ">
        <!-- Sidebar -->
        <aside id="sidebar" class="hidden absolute z-50 w-full h-fit bg-secondary text-white p-5 flex flex-col gap-3 divide-y divide-primary/20 lg:block lg:static lg:h-full lg:bg-white lg:text-dark-blue">
            <!-- Logo Container -->
            <section class="flex items-center justify-between lg:justify-center xl:justify-between">
                <a href=" " class="py-3 flex items-center lg:justify-center 2xl:justify-start gap-2">
                    <p class="bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-semibold rounded-md text-lg">AC</p>
                    <p class="text-lg font-medium font-semibold lg:hidden xl:block">ApexCare</p>
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
                <section class="flex gap-2">
                    <p class="bg-primary size-10 px-3 py-2 flex items-center justify-center text-white font-semibold rounded-md text-2xl">AI</p>
                    <section class="flex flex-col">
                        <p class="text-lg font-medium lg:hidden xl:block">Renzo Tolentino</p>
                        <p class="text-white/70 lg:text-gray-500 lg:hidden xl:block">U1213</p>
                    </section>
                </section>

                <section class="w-full mt-10 text-center">
                    <button class="border border-primary rounded-md text-center flex items-center justify-center gap-2 cursor-pointer w-full lg:w-fit h-fit px-3 py-2 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-log-out-icon lucide-log-out size-4" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 17 5-5-5-5" />
                            <path d="M21 12H9" />
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        </svg>
                        <p class="lg:hidden xl:block">Logout</p>
                    </button>
                </section>
            </section>

            <!-- Sidebar Menu List -->
            <section class="divide-y divide-primary/20 flex flex-col gap-4 w-full">
                <section class="py-3 flex flex-col lg:items-center gap-1 xl:items-start">
                    <p class="lg:hidden font-medium text-white/60 xl:block lg:text-dark-blue/30">Actions</p>
                    <a href="../cashier/cashierPos.php" class="bg-primary text-white rounded-md cursor-pointer lg:w-fit h-fit px-3 py-2 flex items-center gap-3 2xl:w-full hover:bg-secondary/40 transition duration-100">
                        <svg class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="7" height="9" x="3" y="3" rx="1" />
                            <rect width="7" height="5" x="14" y="3" rx="1" />
                            <rect width="7" height="9" x="14" y="12" rx="1" />
                            <rect width="7" height="5" x="3" y="16" rx="1" />
                        </svg>
                        <p class="lg:hidden text-start xl:block">POS Termnial</p>
                    </a>
                </section>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="w-full h-full p-5 grid grid-rows-[10%_auto_1fr] grid-cols-1 md:grid-cols-2 lg:grid-cols-4 lg:grid-rows-[auto_auto_1fr] gap-3">
            <!-- Header -->
            <section class="col-span-full flex items-center justify-between">
                <section class="flex items-center gap-3">
                    <p class="col-span-full flex items-center text-lg font-medium md:text-2xl">POS Termnial</p>
                </section>

                <button id="openSidebarBtn" class="bg-primary p-1 size-10 flex items-center justify-center text-white rounded-md lg:hidden">
                    <svg class="lucide lucide-menu-icon lucide-menu size-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 5h16" />
                        <path d="M4 12h16" />
                        <path d="M4 19h16" />
                    </svg>
                </button>
            </section>

            <!-- Search, Filter & Add sales button -->
            <section class="col-span-full flex gap-2 items-center justify-between flex-col lg:flex-row">
                <section class="border border-primary flex items-center gap-2 p-2 pr-3 rounded-md w-full h-fit lg:w-100">
                    <svg class="lucide lucide-search-icon lucide-search size-4.5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21 21-4.34-4.34" />
                        <circle cx="11" cy="11" r="8" />
                    </svg>
                    <input class="outline-0 text-sm w-full" type="text" name="medicineSearchQuery" id="medicineSearchQueryTxt">
                </section>
            </section>

            <!-- Medicine Grid -->
            <section class="col-span-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 3xl:grid-cols-5 w-full h-fit gap-2">
                <section class="border border-gray-300 h-fit rounded-lg p-4 flex flex-col justify-between bg-white shadow-xs">
                    <section class="flex justify-between items-start gap-3">
                        <section class="w-full min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate" title="Amoxicillin Trihydrate 500mg Capsule">
                                Amoxicillin Trihydrate 500mg Capsule
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5">Antibiotic</p>
                        </section>
                        <span class="text-xs font-medium text-gray-600 bg-gray-100 px-2 py-0.5 rounded shrink-0">
                            Brand
                        </span>
                    </section>
                    <section class="flex flex-col gap-2 mt-10">
                        <p class="text-xs text-gray-600">
                            <span class="font-bold text-gray-900 text-sm">86</span> Stock(s) left
                        </p>

                        <section class="flex gap-2">
                            <button class="bg-white border border-primary py-2 px-3 rounded-md text-black font-medium cursor-pointer">
                                Request Restock
                            </button>
                            <button class="bg-primary py-2 px-3 rounded-md text-white cursor-pointer font-medium">
                                Add Item
                            </button>
                        </section>
                    </section>
                </section>
            </section>
        </section>

        <button id="openAddNewSalePanelBtn" class="w-[80%] fixed bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white font-medium px-5 py-3 rounded-md shadow-lg transition-all active:scale-95 md:w-[50%] xl:hidden">
            <span>View Sale Panel</span>
        </button>

        <!-- Add New Sale Side Panel -->
        <section id="addNewSalePanelBtn" class="hidden bg-gray-500/50 fixed bottom-0 right-0 w-full h-dvh shadow-xl z-40 lg:w-[93dvw] lg:block xl:w-full xl:static">
            <section class="w-full h-full bg-white flex flex-col justify-between">
                <section class="p-5 border-b border-gray-100 flex items-start justify-between bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Current Order</h2>
                        <p class="text-xs text-gray-500">OD-123</p>
                    </div>
                    <button id="closeAddNewSalePanelBtn" class="lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </section>

                <!-- Main Form & Items Scroll Area -->
                <form id="addSaleForm" class="p-5 overflow-y-auto flex-1 flex flex-col gap-5 text-sm scrollbar-none w-full">

                    <!-- Customer & Transaction Classification -->
                    <section class="flex flex-col gap-3 w-full">
                        <label class="text-xs font-medium text-gray-400 tracking-wider">Transaction Info</label>

                        <section>
                            <label for="customer_type" class="block text-xs font-semibold text-gray-700 mb-1">Customer Type</label>
                            <select id="customer_type" name="customer_type" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-secondary focus:outline-none">
                                <option value="walk_in">Walk-in Customer</option>
                                <option value="regular">Regular Patient</option>
                                <option value="senior_pwd">Senior Citizen / PWD (20% Off)</option>
                            </select>
                        </section>

                        <section class="w-full">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Sales Type (Rx Status)</label>
                            <section class="w-full flex items-center  gap-4 bg-gray-50 p-2.5 rounded-lg border border-gray-200">
                                <label class="flex items-center gap-2 cursor-pointer text-xs font-medium text-gray-700">
                                    <input type="radio" name="sale_type" value="OTC" checked class="accent-secondary w-4 h-4">
                                    OTC (Over The Counter)
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer text-xs font-medium text-gray-700">
                                    <input type="radio" name="sale_type" value="Rx" class="accent-secondary w-4 h-4">
                                    Rx (Prescribed)
                                </label>
                            </section>
                            </div>
                        </section>

                        <hr class="border-gray-100">

                        <!-- Payment Method Radio Buttons -->
                        <section>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Payment Method</label>
                            <section class="grid grid-cols-3 gap-2">
                                <label class="flex flex-col items-center justify-center p-2 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 cursor-pointer text-xs font-medium text-gray-700 has-[:checked]:border-secondary has-[:checked]:bg-blue-50/50 has-[:checked]:text-secondary transition-all">
                                    <input type="radio" name="payment_method" value="Cash" checked class="sr-only">
                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Cash</span>
                                </label>
                                <label class="flex flex-col items-center justify-center p-2 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 cursor-pointer text-xs font-medium text-gray-700 has-[:checked]:border-secondary has-[:checked]:bg-blue-50/50 has-[:checked]:text-secondary transition-all">
                                    <input type="radio" name="payment_method" value="GCash" class="sr-only">
                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>GCash</span>
                                </label>
                                <label class="flex flex-col items-center justify-center p-2 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 cursor-pointer text-xs font-medium text-gray-700 has-[:checked]:border-secondary has-[:checked]:bg-blue-50/50 has-[:checked]:text-secondary transition-all">
                                    <input type="radio" name="payment_method" value="Card" class="sr-only">
                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Card</span>
                                </label>
                            </section>
                        </section>

                        <hr class="border-gray-100">

                        <!-- Selected Items Cart Container -->
                        <section class="flex flex-col gap-3">
                            <section class="flex items-center justify-between">
                                <label class="text-xs font-medium text-gray-400 tracking-wider">Cart Items</label>
                                <span id="cartItemCount" class="text-xs font-semibold text-secondary bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-100">
                                    2 Items
                                </span>
                            </section>

                            <!-- Empty State Placeholder (Shown when no grid item is clicked) -->
                            <section id="emptyCartState" class="hidden flex-col items-center justify-center p-8 border-2 border-dashed border-gray-200 rounded-xl text-center">
                                <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-xs text-gray-400 font-medium">No medicines added yet.</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">Click an item on the POS grid to add.</p>
                            </section>

                            <!-- Dynamic Cart Items List -->
                            <section id="cartItemsList" class="flex flex-col gap-2.5">

                                <!-- Added Item 1 -->
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2.5 relative">
                                    <div class="flex justify-between items-start pr-6 min-w-0">
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 text-sm leading-tight truncate">Amoxicillin Trihydrate</p>
                                            <p class="text-xs text-gray-500 mt-0.5">500mg • Capsule (Amoxil)</p>
                                        </div>
                                        <span class="font-bold text-gray-900 text-sm shrink-0">₱30.00</span>
                                    </div>

                                    <div class="flex items-center justify-between border-t border-gray-200/60 pt-2">
                                        <!-- Quantity Buttons -->
                                        <div class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden shadow-xs">
                                            <button type="button" class="px-2.5 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition-colors text-xs cursor-pointer">-</button>
                                            <input type="number" value="2" min="1" class="w-10 text-center text-xs font-bold text-gray-800 border-none focus:outline-none" />
                                            <button type="button" class="px-2.5 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition-colors text-xs cursor-pointer">+</button>
                                        </div>

                                        <div class="text-right">
                                            <span class="text-[11px] text-gray-400 mr-1">Unit: ₱15.00</span>
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <button type="button" class="absolute top-3 right-2 text-gray-400 hover:text-red-500 transition-colors p-1 cursor-pointer" title="Remove Item">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Added Item 2 -->
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-200 flex flex-col gap-2.5 relative">
                                    <div class="flex justify-between items-start pr-6 min-w-0">
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 text-sm leading-tight truncate">Paracetamol</p>
                                            <p class="text-xs text-gray-500 mt-0.5">500mg • Tablet (Biogesic)</p>
                                        </div>
                                        <span class="font-bold text-gray-900 text-sm shrink-0">₱75.00</span>
                                    </div>

                                    <div class="flex items-center justify-between border-t border-gray-200/60 pt-2">
                                        <!-- Quantity Buttons -->
                                        <div class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden shadow-xs">
                                            <button type="button" class="px-2.5 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition-colors text-xs cursor-pointer">-</button>
                                            <input type="number" value="10" min="1" class="w-10 text-center text-xs font-bold text-gray-800 border-none focus:outline-none" />
                                            <button type="button" class="px-2.5 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition-colors text-xs cursor-pointer">+</button>
                                        </div>

                                        <div class="text-right">
                                            <span class="text-[11px] text-gray-400 mr-1">Unit: ₱7.50</span>
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <button type="button" class="absolute top-3 right-2 text-gray-400 hover:text-red-500 transition-colors p-1 cursor-pointer" title="Remove Item">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                            </section>
                        </section>

                        <hr class="border-gray-100">

                        <!-- Summary Breakdown -->
                        <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-col gap-2">
                            <label class="text-xs font-medium text-gray-400 tracking-wider mb-1">Payment Summary</label>

                            <div class="flex justify-between text-gray-600 text-xs">
                                <span>Subtotal</span>
                                <span class="font-semibold text-gray-800">₱105.00</span>
                            </div>
                            <div class="flex justify-between text-gray-600 text-xs">
                                <span>Discount</span>
                                <span class="font-semibold text-red-600">-₱0.00</span>
                            </div>
                            <div class="flex justify-between font-bold text-gray-900 text-base border-t border-gray-200 pt-2 mt-1">
                                <span>Total Amount</span>
                                <span class="text-emerald-600">₱105.00</span>
                            </div>
                        </section>

                </form>

                <!-- Footer Action Buttons -->
                <section class="p-4 border-t border-gray-100 bg-white flex items-center gap-3">
                    <button type="button" class="closeAddSaleBtn w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-lg text-sm transition-colors cursor-pointer">
                        Clear
                    </button>
                    <button type="submit" form="" class="w-2/3 bg-primary hover:bg-primary/90 text-white font-medium py-2.5 rounded-lg text-sm transition-colors cursor-pointer flex items-center justify-center gap-2">
                        <span>Process Sale</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </section>
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
        $("#openSidebarBtn").click(() => {
            $("#sidebar").slideDown();
        })
        $("#closeSidebarBtn").click(() => {
            $("#sidebar").slideUp();
        })

        $("#openAddNewSalePanelBtn").click(() => {
            $("#addNewSalePanelBtn").slideDown();
        })
        $("#closeAddNewSalePanelBtn").click(() => {
            $("#addNewSalePanelBtn").slideUp();
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