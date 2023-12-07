<!-- 
    View update_password : la page pour modifier son mot de passe
 -->

<main class="flex justify-center flex-col items-center md:h-screen">
    <div class="text-center border-b border-tertiary border-opacity-40 mb-6 w-full">
    </div>
    <div
        class="flex justify-center items-center flex-col px-8 py-12 bg-card border border-gray-700 border-opacity-20 rounded-lg shadow-2xl">
        <span class="text-2xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Informations
            du compte</span>
        <ul class="text-center mb-6">
            <li class="mb-1">Nom d'utilisateur : <strong>
                    <?= $_SESSION["username"] ?>
                </strong></li>
            <li class="mb-1">Question secrète : <strong>
                    <?= getUserByUserName($_SESSION["username"])["secret_question"] ?>
                </strong></li>
        </ul>
        <span class="text-2xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Changer
            de mot de passe</span>
        <?php if (!is_null($action) && $action === "reset_password" && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="update_password?action=reset_password" method="POST"
            class="flex flex-col justify-center items-center px-8">
            <div class="flex flex-col gap-1 mb-2">
                <label for="secret_answer" class="font-medium">Réponse secrète :</label>
                <input type="text" name="secret_answer"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex flex-col gap-1 mb-2">
                <label for="password" class="font-medium">Nouveau mot de passe :</label>
                <input type="password" name="password"
                    class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                    required>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-btn border border-gray-100 rounded-lg px-10 h-8 mb-4 mt-4"><img
                        src="../assets/img/arrow.svg" alt="arrow" class="max-w-img min-w-img"></button>
        </form>
    </div>
</main>