<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./generalStyle.css">
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
    <title>ApexCare Login</title>
</head>

<body class="w-full h-dvh text-sm font-display text-black pt-5   lg:pt-10">
    <!-- Login Page -->
    <main class="w-full h-full flex justify-center items-start">
        <!-- Login Attempt Toast -->
        <section class="hidden fixed border border-yellow-500 bg-yellow-50 left-1/2 -translate-x-1/2 z-50 w-[90%] rounded-lg top-10 right-10 h-fit p-5 flex items-center gap-5 sm:w-auto sm:left-auto sm:right-10 sm:translate-x-0 lg:w-fit">
            <section>
                <svg class="lucide lucide-triangle-alert-icon lucide-triangle-alert size-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
            </section>
            <p class="grow">Warning Message</p>
            <button class="cursor-pointer">
                <svg class="lucide lucide-x-icon lucide-x size-5 text-black" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </section>

        <!-- Login Form -->
        <form action="" method="POST" id="loginForm" class="rounded-xl w-full h-fit p-5 flex flex-col gap-10 text-center sm:w-100 md:w-120">
            <section class="flex flex-col gap-8 w-full h-fit justify-center items-center">
                <section class="flex items-center gap-3">
                    <p class="size-14 bg-primary text-white font-semibold rounded-lg text-2xl p-2 flex items-center justify-center">AC</p>
                    <p class="text-2xl font-semibold">ApexCare</p>
                </section>
                <section class="flex flex-col gap-2">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-medium">Welcome to ApexCare</h1>
                    <p class="text-md">Precision tracking for your pharmacy's supply chain and sales.</p>
                </section>
            </section>

            <section class="w-full h-fit flex flex-col gap-5">
                <section class="w-full h-fit flex flex-col gap-2 items-start">
                    <label for="" class="text-md font-medium">Email</label>
                    <section class="w-full flex items-center gap-2 border border-gray-600/40 p-3 rounded-lg">
                        <svg class="lucide lucide-mail-icon lucide-mail size-4 text-gray-600/40" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                        </svg>
                        <input type="email" name="user_email" id="" required placeholder="exampleemail@gmail.com" class="w-full outline-none">
                    </section>
                    <section class="flex items-center gap-1 text-red-500">
                        <svg class="lucide lucide-info-icon lucide-info size-3.5 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <p class="text-xs md:text-md" id="userEmailErrorMsg">Error Message</p>
                    </section>
                </section>
                <section class="w-full h-fit flex flex-col gap-2 items-start">
                    <label for="" class="text-md font-medium">Password</label>
                    <section class="w-full flex items-center gap-2 border border-gray-600/40 p-3 rounded-lg">
                        <svg class="lucide lucide-key-icon lucide-key size-4 text-gray-600/40" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4" />
                            <path d="m21 2-9.6 9.6" />
                            <circle cx="7.5" cy="15.5" r="5.5" />
                        </svg>
                        <input type="password" name="user_password" id="" required class="w-full outline-none">
                    </section>
                    <section class="flex items-center gap-1 text-red-500">
                        <svg class="lucide lucide-info-icon lucide-info size-3.5 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <p class="text-xs md:text-md" id="userPasswordErrorMsg">Error Message</p>
                    </section>
                </section>
            </section>

            <button type="submit" name="login_btn" id="loginBtn" class="bg-primary text-white font-medium p-3 rounded-lg cursor-pointer hover:bg-primary/90">Login</button>
        </form>

    </main>

    <script src="./js/jquery.min.js"></script>

    <script>
        $(document).ready(() => {
            let data = {
                action: "handleUserLogin",
                email: "admin@pharmacy.test",
                password: "Admin123!"
            };

            $.post("./controller/authController.php", data, function(response) {
                console.log(response);
            })
        })
    </script>
</body>


</html>