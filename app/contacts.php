<?php $contacts = getContactsByUserId($_SESSION["user_id"]); ?>

<main class="flex justify-center flex-col items-center md:h-screen">
    <div class="text-center border-b border-tertiary border-opacity-40 mb-6 w-full">
    </div>
    <div
        class="flex justify-center flex-col items-center bg-card border border-gray-700 border-opacity-20 rounded-lg shadow-card_shadow shadow-gray-900 px-2 md:px-8 py-10">
        <span
            class="text-4xl font-semibold bg-quaternary border border-gray-700 rounded-xl px-4 py-2 mb-6">Contacts</span>
        <?php if(isset($_FILES["import_contacts"]) && $_FILES["import_contacts"]["error"] == UPLOAD_ERR_OK && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="self-start">
            <a href="./register_contact"
                class="flex items-center gap-2 self-start mb-6 bg-quaternary border border-gray-300 rounded-lg px-3 py-2"><img
                    src="../assets/img/add.svg" alt="add" class="max-w-img min-w-img">
                <span class="font-medium">Ajouter un contact</span></a>
        </div>
        <div class="self-start">
            <form action="#" method="POST" enctype="multipart/form-data">
                <input
                    class="block w-full text-sm border border-gray-300 rounded-lg bg-secondary focus:outline-none pr-2 mb-6"
                    type="file" name="import_contacts" required>
                <button type="submit"
                    class="font-medium flex items-center gap-2 self-start mb-6 bg-quaternary border border-gray-300 rounded-lg px-3 py-2"><img
                        src="../assets/img/import.svg" alt="import" class="max-w-img min-w-img">Importer des
                    contacts</button>

            </form>
        </div>
        <?php if(!is_null($action) && $action === "remove_contact" && !$success): ?>
            <ul class="text-sm text-center font-medium text-red-300 bg-red-900 rounded-lg px-10 py-2 mb-6">
                <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if(!empty($contacts)): ?>
            <table class="border-collapse">
                <thead>
                    <tr class="text-center bg-tertiary">
                        <th class="border border-black border-opacity-20 p-2">ID</th>
                        <th class="border border-black border-opacity-20 p-2">Nom</th>
                        <th class="border border-black border-opacity-20 p-2">Prénom</th>
                        <th class="border border-black border-opacity-20 p-2">Numéro de téléphone</th>
                        <th class="border border-black border-opacity-20 p-2">Adresse</th>
                        <th class="border border-black border-opacity-20 p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($contacts); $i++): ?>
                        <tr class="bg-secondary">
                            <td class="border border-black border-opacity-20 p-2">
                                <?= $contacts[$i]["id"] ?>
                            </td>
                            <td class="border border-black border-opacity-20 p-2">
                                <?= $contacts[$i]["lastname"] ?>
                            </td>
                            <td class="border border-black border-opacity-20 p-2">
                                <?= $contacts[$i]["firstname"] ?>
                            </td>
                            <td class="border border-black border-opacity-20 p-2">
                                <?= $contacts[$i]["phone_number"] ?>
                            </td>
                            <td class="border border-black border-opacity-20 p-2">
                                <?= $contacts[$i]["address"] ?>
                            </td>
                            <td class="border-r border-black border-opacity-20 p-4 flex gap-1">
                                <a href="<?= "./update_contact"."?id=".$contacts[$i]["id"] ?>"
                                    class="bg-quaternary border border-gray-300 rounded-lg p-1"><img
                                        src="../assets/img/edit.svg" alt="edit" class="max-w-img min-w-img"></a>
                                <a href="<?= "./contacts"."?action=remove_contact&id=".$contacts[$i]["id"] ?>"
                                    class="bg-quaternary border border-gray-300 rounded-lg p-1"><img
                                        src="../assets/img/delete.svg" alt="delete" class="max-w-img min-w-img"></a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>