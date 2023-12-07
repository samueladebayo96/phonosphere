<main class="flex justify-center flex-col items-center md:h-screen">
    <div class="text-center border-b border-tertiary border-opacity-40 mb-6 w-full">
    </div>
    <div
        class="flex flex-col justify-center items-center bg-card border border-gray-700 border-opacity-20 rounded-lg  shadow-card_shadow shadow-gray-900 px-8 py-12">
        <span
            class="text-center text-2xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Inscription</span>
        <?php if(!is_null($action) && $action === "add_user" && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="./register?action=add_user" method="POST" class="grid grid-cols-2 grid-rows-2 gap-2">
            <div class="flex flex-col gap-1 mb-2">
                <label for="lastname" class="font-medium">Nom de famille :</label>
                <input type="text" name="lastname"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2  h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="firstname" class="font-medium">Prénom :</label>
                <input type="text" name="firstname"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2  h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="username" class="font-medium">Nom d'utilisateur :</label>
                <input type="text" name="username"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="password" class="font-medium">Mot de passe :</label>
                <input type="password" name="password"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="retry_password" class="font-medium">Retaper le mot de passe :</label>
                <input type="password" name="retry_password"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="secret_question" class="font-medium">Question secrète :</label>
                <input type="text" name="secret_question"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="secret_answer" class="font-medium">Réponse secrète :</label>
                <input type="text" name="secret_answer"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex items-end mb-2">
                <button type="submit" class="bg-btn border border-gray-100 rounded-lg px-24 h-8"><img
                        src="../assets/img/arrow.svg" alt="arrow" class="max-w-img min-w-img"></button>
        </form>
    </div>
</main>
</body>

</html>