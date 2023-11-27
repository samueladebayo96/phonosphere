<div class="w-full flex justify-center shadow-2xl fixed z-10 bg-black bg-opacity-30">
    <div
        class="flex justify-between w-full max-w-7xl items-center gap-3 mb-3 mt-2 max-xl:max-w-5xl max-lg:max-w-3xl max-md:max-w-xl max-sm:max-w-lg max-[550px]:max-w-md">


        <div class="flex items-center gap-6">
            <div class="border border-black bg-black bg-opacity-20 rounded-2xl px-2 py-2"><a href="./"><img
                        src="./assets/img/logo.svg" alt="logo" width="60" height="60" /></a></div>
            <p class="text-2xl font-bold font-['Roboto Slab'] text-gray-50 max-sm:text-lg max-[550px]:text-sm">
                Phonosphere
            </p>
        </div>
        <!-- MENU -->
        <div class="flex justify-center items-center">
            <ul class="flex justify-center gap-8">
                <li class="text-gray-50 text-1xl font-medium font-['Roboto Slab']"><a href="./home" class="">Accueil</a>
                </li>
                <?php if (!isset($_SESSION["user_id"])): ?>
                    <li class="text-gray-50 text-1xl font-medium font-['Roboto Slab']"><a href="./login"
                            class="">Connexion</a></li>
                <?php else: ?>
                    <li class="text-gray-50 text-1xl font-medium font-['Roboto Slab']"><a href="./profile"
                            class="">Profile</a></li>
                    <li class="text-gray-50 text-1xl font-medium font-['Roboto Slab']"><a href="./contacts"
                            class="">Contacts</a></li>
                    <li class="text-gray-50 text-1xl font-medium font-['Roboto Slab']"><a href="./logout"
                            class="">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>