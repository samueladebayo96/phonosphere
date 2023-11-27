<!-- 
    View profile : la page du profile de l'utilisateur
 -->
 
 <div class="flex justify-center items-center min-h-full">
    <div class="flex flex-col w-full max-w-xl gap-10 max-[550px]:max-w-md">
        <div class="flex justify-center items-center flex-col border-black bg-black bg-opacity-50 rounded-2xl py-10">
        <div class="border-black bg-black bg-opacity-20 py-5 px-10 rounded-2xl mb-6">
            <p class="text-lg font-bold font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Informations du compte</p>
            </div>
            <div class="mb-6">
                <p class="text-md font-medium font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Nom d'utilisateur : <?= getUserByUserId($_SESSION["user_id"])["username"] ?>
                </p>
                <p class="text-md font-medium font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Prénom :
                    <?= getUserByUserId($_SESSION["user_id"])["firstname"] ?>
                <p class="text-md font-medium font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Nom de famille :
                    <?= getUserByUserId($_SESSION["user_id"])["lastname"] ?>
                <p class="text-md font-medium font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Dernière connexion :
                    <?= getUserByUserId($_SESSION["user_id"])["last_activity"] ?>
                </p>
                <p class="text-md font-medium font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Question secrète :
                    <?= getUserByUserId($_SESSION["user_id"])["secret_question"] ?>
                </p>
            </div>
            <div class="border-black bg-black bg-opacity-20 py-5 px-10 rounded-2xl mb-6">
            <p class="text-lg font-bold font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Changer de mot de passe</p>
            </div>
            <?php if (!is_null($action) && $action === "reset_password" && !$success): ?>
                <ul
                    class="text-sm text-center font-medium font-['Roboto Slab'] text-red-400 bg-black bg-opacity-30 rounded-lg py-2 px-5 mb-6">
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="./profile?action=reset_password" method="POST"
                class="flex flex-col items-center justify-center gap-6 max-w-2xl">
                <div>
                    <label for="secret_answer" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Réponse secrète :</label>
                    <input type="text" name="secret_answer"
                        class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Nouveau mot de
                        passe :</label>
                    <input type="password" name="password"
                        class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5 border border-opacity-20" required>
                </div>
                <button type="submit"
                    class="flex justify-center border border-black bg-black bg-opacity-50 hover:bg-opacity-40 focus:outline-none rounded-2xl w-full sm:w-auto px-20 py-2.5"><img
                        src="./assets/img/arrow.svg" alt="arrow"/></button>
            </form>
        </div>
    </div>
</div>