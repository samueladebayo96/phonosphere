<!-- 
    View register : la page d'inscription
 -->

<div class="flex justify-center items-center min-h-full">
    <div class="flex flex-col w-full max-w-xl gap-10 max-sm:max-w-lg max-[550px]:max-w-md">
        <h1 class="text-6xl font-bold font-['Roboto Slab'] text-gray-50 text-center max-sm:text-4xl">Inscription</h1>
        <div
            class="flex flex-col justify-center items-center rounded-3xl py-8 border border-black border-opacity-10 bg-black bg-opacity-30">
            <?php if (!is_null($action) && $action === "add_user" && !$success): ?>
                <ul
                    class="text-sm text-center font-medium font-['Roboto Slab'] text-red-400 bg-black bg-opacity-30 rounded-lg px-10 py-2 mb-6">
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="./register?action=add_user" method="POST"
                class="flex flex-col items-center justify-center gap-6 max-w-2xl">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="lastname"
                            class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Votre nom de famille
                            :</label>
                        <input type="text" name="lastname"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="firstname"
                            class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Votre prénom
                            :</label>
                        <input type="text" name="firstname"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="username" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Nom
                            d'utilisateur :</label>
                        <input type="text" name="username"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Mot
                            de
                            passe :</label>
                        <input type="password" name="password"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="retry_password"
                            class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Retaper votre mot
                            de
                            passe :</label>
                        <input type="password" name="retry_password"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="secret_question"
                            class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Votre question secrète
                            :</label>
                        <input type="text" name="secret_question"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div>
                        <label for="secret_answer"
                            class="block mb-2 text-md font-medium text-gray-50 dark:text-gray-50">Votre réponse secrète
                            :</label>
                        <input type="text" name="secret_answer"
                            class="bg-gray-50 text-black text-sm focus:outline-none rounded-lg block w-full p-2.5  border border-opacity-20"
                            required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="flex justify-center items-center border border-black bg-black bg-opacity-50 hover:bg-opacity-40 focus:outline-none rounded-2xl w-full p-2.5"><img
                                src="./assets/img/arrow.svg" alt="arrow" /></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>