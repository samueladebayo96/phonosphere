<?php $contact = getContactById($_GET["id"]); ?>

<main class="flex justify-center flex-col items-center md:h-screen">
    <div class="text-center border-b border-tertiary border-opacity-40 mb-6 w-full">
    </div>
    <div
        class="flex flex-col justify-center items-center bg-card border border-gray-700 border-opacity-20 rounded-lg  shadow-card_shadow shadow-gray-900 px-8 py-12">
        <span
            class="text-center text-2xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Modifier
            un contact</span>
        <?php if(!is_null($action) && $action === "update" && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="./update_contact?action=update&id=<?= $_GET["id"] ?>" method="POST" class="">
            <div class="grid grid-cols-2 grid-rows-2 gap-2">
                <div class="flex flex-col gap-1 mb-2">
                    <label for="lastname" class="font-medium">Nom de famille :</label>
                    <input type="text" name="lastname"
                        class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                        placeholder="<?= $contact["lastname"] ?>" required>
                </div>
                <div class="flex flex-col gap-1 mb-2">
                    <label for="firstname" class="font-medium">Prénom :</label>
                    <input type="text" name="firstname"
                        class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                        placeholder="<?= $contact["firstname"] ?>" required>
                </div>
                <div class="flex flex-col gap-1 mb-2">
                    <label for="phone_number" class="font-medium">Numéro de téléphone :</label>
                    <input type="tel" name="phone_number"
                        class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                        placeholder="<?= $contact["phone_number"] ?>" required>
                </div>
                <div class="flex flex-col gap-1 mb-2">
                    <label for="address" class="font-medium">Adresse :</label>
                    <input type="text" name="address"
                        class="text-gray-500 bg-white border border-gray-300 rounded-md px-2 h-8 focus:outline-none"
                        placeholder="<?= $contact["address"] ?>" required>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-btn border border-gray-100 rounded-lg px-10 h-8 mb-4 mt-4"><img
                        src="../assets/img/arrow.svg" alt="arrow" class="max-w-img min-w-img"></button>
            </div>
        </form>
    </div>
</main>