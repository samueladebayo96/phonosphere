<!-- 
    View lost_password : la page mot de passe oublié
 -->

<div class="flex justify-center items-center min-h-full">
    <div class="flex flex-col w-full max-w-xl gap-10 max-sm:max-w-lg max-[550px]:max-w-md">
        <h1 class="text-6xl font-bold font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Mot de passe Oublié
        </h1>

        <div
            class="flex flex-col justify-center items-center rounded-3xl py-8 border border-black border-opacity-10 bg-black bg-opacity-30">
            <?php if (!is_null($action) && $action === "reset_password" && !$success): ?>
                <ul
                    class="text-sm text-center font-medium font-['Roboto Slab'] text-red-400 bg-black bg-opacity-30 rounded-lg py-2 px-5 mb-6">
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form action="update_password?action=reset_password" method="POST"
                    class="flex flex-col items-center justify-center gap-6 max-w-2xl">
                    <div>
                        <div>
                            <label for="secret_answer"
                                class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Réponse secrète
                                :</label>
                            <input type="text" name="secret_answer"
                                class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Nouveau mot de passe
                                :</label>
                            <input type="password" name="password"
                                class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                                required>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex justify-center border border-black bg-black bg-opacity-50 hover:bg-opacity-40 focus:outline-none rounded-2xl w-full sm:w-auto px-20 py-2.5"><img
                            src="./assets/img/arrow.svg" alt="arrow" /></button>
                </form>
            <?php else: ?>
                <form action="update_password?action=reset_password" method="POST"
                    class="flex flex-col items-center justify-center gap-6 max-w-2xl">
                    <div>
                        <div>
                            <label for="secret_answer"
                                class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Réponse secrète
                                :</label>
                            <input type="text" name="secret_answer"
                                class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Nouveau mot de passe
                                :</label>
                            <input type="password" name="password"
                                class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                                required>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex justify-center border border-black bg-black bg-opacity-50 hover:bg-opacity-40 focus:outline-none rounded-2xl w-full sm:w-auto px-20 py-2.5"><img
                            src="./assets/img/arrow.svg" alt="arrow" /></button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>