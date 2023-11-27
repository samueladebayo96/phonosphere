<!-- 
    View login : la page de connexion
 -->

<div class="flex justify-center items-center min-h-full">
    <div class="flex flex-col w-full max-w-xl gap-10 max-sm:max-w-lg max-[550px]:max-w-md">
        <h1 class="text-6xl font-bold font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Connexion</h1>
        <div
            class="flex flex-col justify-center items-center rounded-3xl py-8 border border-black border-opacity-10 bg-black bg-opacity-30">
            <?php if (!is_null($action) && $action === "log_in" && !$success): ?>
                <ul
                    class="text-sm text-center font-medium font-['Roboto Slab'] text-red-400 bg-black bg-opacity-30 rounded-lg px-10 py-2 mb-6">
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="./login?action=log_in" method="POST"
                class="flex flex-col items-center justify-center gap-6 max-w-2xl">
                <div>
                    <label for="username" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Nom
                        d'utilisateur :</label>
                    <input type="text" name="username"
                        class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Mot de
                        passe :</label>
                    <input type="password" name="password"
                        class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5 border border-opacity-20" required>
                </div>
                <button type="submit"
                    class="flex justify-center border border-black bg-black bg-opacity-50 hover:bg-opacity-40 focus:outline-none rounded-2xl w-full sm:w-auto px-20 py-2.5"><img
                        src="./assets/img/arrow.svg" alt="arrow" /></button>
                <div class="flex flex-col gap-2">
                    <a href="./register" class="block text-xs font-medium font-['Roboto Slab'] text-gray-50">Pas
                        encore inscrit ?</a>
                    <a href="./lost_password" class="block text-xs font-medium font-['Roboto Slab'] text-gray-50">Mot de
                        passe oublié
                        ?</a>
                </div>
            </form>
        </div>
    </div>
</div>