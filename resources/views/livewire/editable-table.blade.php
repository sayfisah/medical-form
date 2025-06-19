<div>
    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($columns as $column)
                    <th class="p-2 border">{{ $column['label'] }}</th>
                @endforeach
                <th class="p-2 border no-print">Actions</th> {{-- Hide Actions column on print --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                <tr>
                    @foreach ($columns as $column)
                        <td class="p-2 border">
                            @if($row['editing'] ?? false)
                                @if($column['type'] ?? 'text' === 'select')
                                    <select 
                                        wire:model.defer="rows.{{ $index }}.{{ $column['field'] }}" 
                                        class="border rounded px-2 py-1 w-full no-print"
                                    >
                                        @foreach ($column['options'] ?? [] as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input 
                                        type="text" 
                                        wire:model.defer="rows.{{ $index }}.{{ $column['field'] }}" 
                                        class="border rounded px-2 py-1 w-full no-print"
                                    />
                                @endif
                            @else
                                {{ $row[$column['field']] }}
                            @endif
                        </td>
                    @endforeach
                    <td class="p-2 border space-x-2 no-print">
                        @if($row['editing'] ?? false)
                            <button type="button" wire:click="saveRow({{ $index }})" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">Save</button>
                            <button type="button" wire:click="deleteRow({{ $index }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                        @else
                            <button type="button" wire:click="editRow({{ $index }})" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Edit</button>
                            <button type="button" wire:click="deleteRow({{ $index }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ✅ FIX: Set type="button" to avoid triggering parent form validation --}}
    <button 
        type="button"
        wire:click="addRow" 
        class="mt-4 bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded no-print"
    >
        Add New
    </button>
</div>
