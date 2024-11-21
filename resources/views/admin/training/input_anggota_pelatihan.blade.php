@extends('base/admin_navbar')

@section('content')
@php
use Carbon\Carbon;
$accounts = App\Models\Account::all();
@endphp

<header class="mt-16 p-8">
    <div class="grid">
        <h1 class="text-2xl font-bold text-[#20252f]">Input Anggota Pelatihan</h1>
        <!-- Input Button -->
        <button id="addButton" class="px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg justify-self-end">+ Add</button>
    </div>
</header>

@foreach ($groups as $group)
<div class="bg-[#f6f1e3] rounded-lg shadow-lg p-6 mx-16 mb-8 misa-card">
    <div class="flex justify-between">
        <!-- Group Name -->
        <div class="flex-1 basis-1/4">
            <div class="flex items-start space-x-4">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold">{{ $group->name }}</h2>
                </div>
            </div>
        </div>

        <!-- Members List -->
        <div class="flex-1 basis-3/4 bg-white p-4 rounded-lg">
            <h3 class="text-[#20252f] font-semibold border-b pb-2">ANGGOTA</h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <ul class="text-gray-600 mt-2 grid grid-flow-col grid-rows-2 gap-x-4 gap-y-1">
                    @foreach ($group->groupDetails as $groupDetail)
                    <li>{{ $groupDetail->account->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4 mt-4">
        <button
            id="editButton{{ $group->id }}"
            class="edit-button px-6 py-2 bg-[#002366] hover:bg-[#20252f] text-white rounded-lg"
            data-members='@json($group->groupDetails->map(fn($detail) => ["name" => $detail->account->name, "wilayah" => $detail->account->region, "account_id" => $detail->account->id]))'>
            Edit
        </button>
        <form id="editForm{{ $group->id }}" action="{{ route('groups.updateMembers', $group->id) }}" method="POST" style="display: none;">
            @csrf
            @method('PUT')

            <!-- Dropdown for Members -->
            <label class="block text-sm font-medium text-gray-700">Nama Anggota</label>
            <select class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white" name="member_ids[]" multiple>
                @foreach ($accounts as $account)
                @if (! $group->groupDetails->contains('account_id', $account->id))
                <option value="{{ $account->id }}">{{ $account->name }}</option>
                @endif
                @endforeach
            </select>

            <!-- Save Button -->
            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Save</button>
            </div>
        </form>

        <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="group_id" value="{{ $group->id }}">
            <button type="submit" class="px-4 py-2 bg-[#ae0001] hover:bg-[#740001] text-white rounded-lg">Delete</button>
        </form>
    </div>
</div>

<!-- Modal Tambah Kelompok -->
<div id="addModal" class="hidden fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-[#f6f1e3] p-8 rounded-lg shadow-lg w-96">
        <h3 class="text-lg font-semibold mb-4">Tambah Kelompok Baru</h3>

        <!-- Form for submitting new group data -->
        <form id="addGroupForm" action="{{ route('groups.store') }}" method="POST">
            @csrf

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
                <input type="text" name="group_name" class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                    placeholder="Input Nama Kelompok" required>
            </div>

            <!-- Anggota Dropdown -->
            <div>
                <label class="block text-sm mt-4 font-medium text-gray-700">Nama Anggota</label>
                <select name="member_id" class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white">
                    <!-- Dynamically populate the options from the backend, excluding existing members -->
                    @foreach($allMembers as $member)
                    <!-- Exclude members already in the group -->
                    @if(!in_array($member->id, $existingMemberIds))
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <button type="button"
                class="w-full bg-[#740001] mt-2 text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300"
                id="addMemberButton">
                Tambah Anggota
            </button>

            <!-- Table to show added anggota -->
            <div class="mt-6 overflow-y-auto max-h-60">
                <h3 class="text-lg font-semibold">Daftar Anggota</h3>
                <table class="w-full mt-2 table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-1 py-1">No.</th>
                            <th class="border border-gray-300 px-6 py-1">Nama</th>
                            <th class="border border-gray-300 px-1 py-1">Wilayah</th>
                            <th class="border border-gray-300 py-1">Action</th>
                        </tr>
                    </thead>
                    <tbody id="anggotaTableBody">
                        <!-- Table rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>

            <div class="bg-[#f6f1e3] py-3 sm:flex sm:flex-row-reverse">
                <button type="submit"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#002366] text-base font-medium text-white hover:bg-[#20252f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                    id="cancelButton">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit Kelompok -->
<div id="editModal{{ $group->id }}" class="hidden fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-[#f6f1e3] p-8 rounded-lg shadow-lg w-96">
        <h3 class="text-lg font-semibold mb-4">Edit {{ $group->name }}</h3>

        <!-- Form to update group members -->
        <form id="updateForm{{ $group->id }}" action="{{ route('groups.updateMembers', $group->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="w-full mt-2 table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-1 py-1">No.</th>
                        <th class="border border-gray-300 px-6 py-1">Nama</th>
                        <th class="border border-gray-300 px-1 py-1">Wilayah</th>
                        <th class="border border-gray-300 py-1">Action</th>
                    </tr>
                </thead>
                <tbody id="anggotaTableBody{{ $group->id }}">
                    <!-- Existing Members will be populated here -->
                </tbody>
            </table>

            <!-- Add Member Dropdown -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Tambah Anggota</label>
                <select class="block appearance-none w-full p-2 border border-gray-300 rounded-md bg-white" id="addMemberSelect{{ $group->id }}">
                    @foreach ($accounts as $account)
                    <!-- Ensure the account isn't already part of any other group -->
                    @if ($groups->except($group->id)->every(fn($otherGroup) => !$otherGroup->groupDetails->contains('account_id', $account->id)))
                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <button type="button" class="w-full bg-[#740001] mt-2 text-white py-2 rounded-lg hover:bg-[#20252f] transition-all duration-300" id="addMemberButton{{ $group->id }}" onclick="addMemberToGroup({{ $group->id }})">
                Tambah Anggota
            </button>

            <!-- Save and Cancel Buttons -->
            <div class="bg-[#f6f1e3] py-3 sm:flex sm:flex-row-reverse mt-4">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#002366] text-base font-medium text-white hover:bg-[#20252f] focus:outline-none sm:w-auto sm:text-sm">
                    Save
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm" id="cancelButton{{ $group->id }}">
                    Cancel
                </button>
            </div>
        </form>

    </div>
</div>

@endforeach

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Open Add Modal on clicking "Add" button
        const addButton = document.getElementById('addButton');
        const addModal = document.getElementById('addModal');
        if (addButton) {
            addButton.addEventListener('click', () => {
                toggleModal(addModal, true); // Show the Add Modal
            });
        }

        // Cancel Button Functionality
        const cancelButtons = document.querySelectorAll('[id^="cancelButton"]');
        cancelButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const modalId = e.target.id.replace('cancelButton', 'editModal'); // get the modal id
                const modal = document.getElementById(modalId);
                toggleModal(modal, false); // Hide the modal
            });
        });

        // Open Edit Modal and populate it with members
        const editButtons = document.querySelectorAll('[id^="editButton"]');
        const editModals = document.querySelectorAll('[id^="editModal"]');
        editButtons.forEach((editButton, index) => {
            editButton.addEventListener('click', () => {
                const modal = editModals[index];
                const groupId = editButton.getAttribute('id').replace('editButton', '');
                const membersJson = editButton.getAttribute('data-members');
                populateEditModal(modal, membersJson, groupId);
                toggleModal(modal, true);
            });
        });

        // Add member to group when "Add Member" button is clicked
        const addMemberButtons = document.querySelectorAll('[id^="addMemberButton"]');
        addMemberButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const groupId = button.getAttribute('id').replace('addMemberButton', '');
                addMemberToGroup(groupId);
            });
        });

        // Delegate event for dynamic remove buttons
        document.querySelectorAll('.edit-modal').forEach((modal) => {
            modal.addEventListener('click', function(e) {
                if (e.target && e.target.matches('button.text-red-600')) {
                    const groupId = e.target.closest('tr').dataset.groupId;
                    const memberId = e.target.closest('tr').dataset.memberId;
                    removeMember(groupId, memberId);
                }
            });
        });
    });

    // Function to toggle modal visibility
    function toggleModal(modal, show) {
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    // Function to populate the edit modal with members data
    function populateEditModal(modal, membersJson, groupId) {
        const members = JSON.parse(membersJson);
        const tableBody = modal.querySelector(`#anggotaTableBody${groupId}`);
        tableBody.innerHTML = ''; // Clear any existing rows

        members.forEach((member, index) => {
            const row = document.createElement('tr');
            row.classList.add('bg-gray-100');
            row.dataset.memberId = member.account_id;
            row.dataset.groupId = groupId;
            row.innerHTML = `
            <td class="border border-gray-300 px-1 py-1">${index + 1}</td>
            <td class="border border-gray-300 px-6 py-1">${member.name}</td>
            <td class="border border-gray-300 px-1 py-1">${member.wilayah}</td>
            <td class="border border-gray-300 px-1 py-1">
                <button type="button" class="text-red-600">Remove</button>
            </td>
        `;
            tableBody.appendChild(row);
        });
    }

    // Function to add member to the group
    function addMemberToGroup(groupId) {
        const memberSelect = document.getElementById(`addMemberSelect${groupId}`);
        const selectedOption = memberSelect.options[memberSelect.selectedIndex];
        if (!selectedOption) return; // Ensure an option is selected

        const memberId = selectedOption.value;
        const memberName = selectedOption.text;
        const wilayah = selectedOption.getAttribute('data-wilayah');

        const tableBody = document.querySelector(`#anggotaTableBody${groupId}`);
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-member-id', memberId);
        newRow.setAttribute('data-group-id', groupId);
        newRow.innerHTML = `
        <td class="border border-gray-300 px-1 py-1">${tableBody.rows.length + 1}</td>
        <td class="border border-gray-300 px-6 py-1">${memberName}</td>
        <td class="border border-gray-300 px-1 py-1">${wilayah}</td>
        <td class="border border-gray-300 px-1 py-1">
            <button type="button" class="text-red-600">Remove</button>
        </td>
    `;
        tableBody.appendChild(newRow);

        const updateForm = document.getElementById(`updateForm${groupId}`);
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'member_ids[]';
        hiddenInput.value = memberId;
        updateForm.appendChild(hiddenInput);

        memberSelect.value = ''; // Deselect the current option
    }

    // Function to remove member from the group
    function removeMember(groupId, memberId) {
        const row = document.querySelector(`#anggotaTableBody${groupId} tr[data-member-id="${memberId}"]`);
        if (row) {
            row.remove(); // Remove the row
        }

        const form = document.getElementById(`updateForm${groupId}`);
        const hiddenInput = form.querySelector(`input[name="member_ids[]"][value="${memberId}"]`);
        if (hiddenInput) {
            hiddenInput.remove(); // Remove the hidden input
        }
    }
</script>
@endsection