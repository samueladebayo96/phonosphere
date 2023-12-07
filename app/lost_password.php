<!-- 
    View lost_password : la page mot de passe oublié
 -->

<main class="flex justify-center flex-col items-center md:h-screen">
    <div class="text-center border-b border-tertiary border-opacity-40 mb-6 w-full">
    </div>
    <form action="lost_password?action=update_password" method="POST"
        class="flex justify-center items-center flex-col px-8 py-12 bg-card border border-gray-700 border-opacity-20 rounded-lg shadow-card_shadow shadow-gray-900">
        <span class="text-2xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Mot de
            passe oublié</span>
        <?php if(!is_null($action) && $action === "update_password" && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="flex flex-col gap-1 mb-2">
            <label for="username" class="font-medium">Nom d'utilisateur :</label>
            <input type="text" name="username"
                class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none" required>
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-btn border border-gray-100 rounded-lg px-10 h-8 mb-4 mt-4"><img
                    src="../assets/img/arrow.svg" alt="arrow" class="max-w-img min-w-img"></button>
        </div>
    </form>
</main>