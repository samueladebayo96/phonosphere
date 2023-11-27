<!-- 
    View profile : la page du profile de l'utilisateur
 -->

<?php

$contacts = getContactsByUserId($_SESSION["user_id"]);

?>

<div class="flex justify-center items-center min-h-full">
    <div class="flex flex-col w-full max-w-2xl gap-10 max-[550px]:max-w-md">
        <div class="flex justify-center">
            <?php if (!empty($contacts)): ?>
                <?php if (!is_null($action) && $action === "remove_contact" && !$success): ?>
                    <ul
                        class="text-sm text-center font-medium font-['Roboto Slab'] text-red-400 bg-black bg-opacity-30 rounded-lg px-10 py-2 mb-6">
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?= $error ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <table class="text-gray-50 rounded-xl border-black border-opacity-20 bg-black bg-opacity-50">
                    <thead class="text-xs border-b border-black border-opacity-60">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nom</th>
                            <th scope="col" class="px-6 py-3">Prénom</th>
                            <th scope="col" class="px-6 py-3">Numéro de téléphone</th>
                            <th scope="col" class="px-6 py-3">Adresse</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($contacts); $i++): ?>
                            <?php if ($i != count($contacts) - 1): ?>
                                <tr class="border-b border-black border-opacity-60">
                                <?php else: ?>
                                <tr>
                                <?php endif; ?>
                                <td class="px-6 py-4 font-medium font-['Roboto Slab']">
                                    <?= $contacts[$i]["id"] ?>
                                </td>
                                <td class="px-6 py-4 font-medium font-['Roboto Slab']">
                                    <?= $contacts[$i]["lastname"] ?>
                                </td>
                                <td class="px-6 py-4 font-medium font-['Roboto Slab']">
                                    <?= $contacts[$i]["firstname"] ?>
                                </td>
                                <td class="px-6 py-4 font-medium font-['Roboto Slab']">
                                    <?= $contacts[$i]["phone_number"] ?>
                                </td>
                                <td class="px-6 py-4 font-medium font-['Roboto Slab']">
                                    <?= $contacts[$i]["address"] ?>
                                </td>
                                <td class="px-6 py-4 font-bold font-['Roboto Slab']">
                                    <div class="flex flex-row gap-1">
                                        <a href=<?= "./update_contact" . "?id=" . $contacts[$i]["id"] ?>
                                            class="bg-black bg-opacity-30 border border-black border-opacity-20 rounded-md px-1 py-1"><img
                                                src="../assets/img/edit.svg" alt="edit" width="20" height="20" /></a>
                                        <a href=<?= "./contacts" . "?action=remove_contact&id=" . $contacts[$i]["id"] ?>
                                            class="bg-black bg-opacity-30 border border-black border-opacity-20 rounded-md px-1 py-1"><img
                                                src="../assets/img//delete.svg" alt="delete" width="20" height="20" /></a>
                                        <a href=<?= "./register_contact" ?>
                                            class="bg-black bg-opacity-30 border border-black border-opacity-20 rounded-md px-1 py-1"><img
                                                src="../assets/img/add.svg" alt="edit" width="20" height="20" /></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            <?php else:
                header("Location: register_contact");
            endif; ?>
        </div>
    </div>
</div>