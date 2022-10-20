<!-- TODO: integrasikan ke livewire -->
<div class="pt-20 px-20">
    <div class="flex justify-between items-center mt-8">
        <div class="">
            <label for="countries" class="block mb-2 text-gray-900">Search By NIM</label>
            <div class="flex gap-4">
                <input type="text" name="searchByNim" class="w-80 border px-2 py-1 rounded-full shadow">
                <input type="submit" value="Search" class="px-3 py-1 rounded bg-mainColor cursor-pointer text-white">
            </div>
        </div>
        <div class="">
            <button class="border border-mainColor rounded bg-white w-40 py-1 text-mainColor">Default</button>
        </div>
    </div>


    <div class="overflow-x-auto relative pt-8">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="py-3 px-6">
                        Nama Mahasiswa
                    </th>
                    <th scope="col" class="py-3 px-6">
                        NIM
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Level
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        Abdurrizqo Arrahman
                    </th>
                    <td class="py-4 px-6">
                        195150401111026
                    </td>
                    <td class="py-4">
                        <select id="countries" class="bg-gray-50 blox mx-auto border border-gray-300 w-60 py-4 px-3 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                            <option selected>Mahasiswa</option>
                            <option value="Non-Dept">Admin Non-Dept</option>
                            <option value="Advokesma">Admin Advokesma</option>
                            <option value="KWU">Admin KWU</option>
                            <option value="Mekominfo">Admin Mekominfo</option>
                            <option value="P2S">Admin P2S</option>
                            <option value="PSDM">Admin PSDM</option>
                            <option value="SOSMA">ADMIN SOSMA</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>