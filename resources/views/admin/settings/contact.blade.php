<x-admin-layout>
    <x-slot name="title">Contact Settings</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">Contact Form Settings</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.contact-settings.update') }}" method="POST" x-data="fieldManager({{ json_encode($contactConfig) }})" @submit="validateAndSubmit">
                @csrf
                @method('PUT')

                <!-- Receiver Email -->
                <div class="mb-8">
                    <label for="contact_email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Receiver Email</label>
                    <p class="text-xs text-slate-500 mb-2">The email address where all contact form submissions will be sent.</p>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $contactEmail) }}" class="max-w-md block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @error('contact_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <hr class="border-slate-200 dark:border-slate-800 my-8">

                <!-- Dynamic Fields -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-slate-900 dark:text-white">Form Fields</h2>
                        <button type="button" @click="addField()" class="text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1.5 rounded-md transition-colors">
                            + Add Field
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(field, index) in fields" :key="index">
                            <div class="flex gap-4 items-start p-4 bg-slate-50 dark:bg-[#0d1117] rounded-lg border border-slate-200 dark:border-slate-700">
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <!-- Label -->
                                    <div>
                                        <label class="block text-xs font-medium text-slate-500 mb-1">Label</label>
                                        <input type="text" :name="`fields[${index}][label]`" x-model="field.label" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#161b22] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs" required @input="updateName(index)">
                                    </div>
                                    
                                    <!-- Name (Auto-generated) -->
                                    <div>
                                        <label class="block text-xs font-medium text-slate-500 mb-1">Name (Auto)</label>
                                        <input type="text" :name="`fields[${index}][name]`" x-model="field.name" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#161b22] dark:text-slate-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs bg-slate-100" readonly>
                                    </div>

                                    <!-- Type -->
                                    <div>
                                        <label class="block text-xs font-medium text-slate-500 mb-1">Type</label>
                                        <select :name="`fields[${index}][type]`" x-model="field.type" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#161b22] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs">
                                            <option value="text">Text Input</option>
                                            <option value="email">Email Input</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="number">Number</option>
                                        </select>
                                    </div>

                                    <!-- Required -->
                                    <div class="flex items-center h-full pt-5">
                                        <input type="hidden" :name="`fields[${index}][required]`" :value="field.required ? 1 : 0">
                                        <input type="checkbox" x-model="field.required" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded">
                                        <span class="ml-2 text-xs text-slate-700 dark:text-slate-300">Required</span>
                                    </div>
                                </div>

                                <!-- Remove -->
                                <button type="button" @click="removeField(index)" x-show="!isProtected(field)" class="mt-6 text-slate-400 hover:text-red-500 transition-colors" title="Remove Field">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <div x-show="isProtected(field)" class="mt-6 text-slate-300 cursor-not-allowed" title="Protected Field">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function fieldManager(initialFields) {
            return {
                fields: [],
                protectedNames: ['name', 'email', 'message', 'company'],

                init() {
                    this.fields = (initialFields || []).map(field => {
                        return {
                            ...field,
                            // Handle various truthy/falsy formats (boolean, string "1"/"0", int 1/0)
                            required: field.required == true || field.required == 1 || field.required == '1',
                            _protected: this.protectedNames.includes(field.name)
                        };
                    });
                },

                isProtected(field) {
                    return field._protected;
                },
                
                addField() {
                    let newName = 'new_field';
                    let counter = 1;
                    while (this.fields.some(f => f.name === newName)) {
                         newName = 'new_field_' + counter;
                         counter++;
                    }

                    this.fields.push({
                        label: 'New Field',
                        name: newName,
                        type: 'text',
                        required: false,
                        _protected: false
                    });
                },

                removeField(index) {
                    if (this.fields[index]._protected) {
                        alert("This field cannot be deleted.");
                        return;
                    }
                    if (this.fields.length <= 1) {
                        alert("You must have at least one field.");
                        return;
                    }
                    this.fields.splice(index, 1);
                },

                updateName(index) {
                    // Don't update name for protected fields
                    if (this.fields[index]._protected) return;

                    let label = this.fields[index].label;
                    let baseName = label.toLowerCase().replace(/ /g, '_').replace(/[^\w-]+/g, '');
                    
                    if (!baseName) return;

                    let name = baseName;
                    let counter = 1;
                    
                    // Check for duplicates within other fields
                    // AND check if the name is in the protected list (because even if not currently in fields, we shouldn't allow capturing a protected name)
                    // Wait, if it IS in protected list, it WOULD be in fields because they are always there.
                    // But just to be safe, we ensure unique name across all existing fields.
                    
                    while (this.fields.some((f, i) => i !== index && f.name === name)) {
                         name = baseName + '_' + counter;
                         counter++;
                    }

                    this.fields[index].name = name;
                },

                validateAndSubmit(e) {
                    // Double check for duplicates
                    const names = this.fields.map(f => f.name);
                    const uniqueNames = new Set(names);
                    if (names.length !== uniqueNames.size) {
                        e.preventDefault();
                        alert("Field names must be unique. Please check your field labels.");
                        return;
                    }
                }
            }
        }
    </script>
</x-admin-layout>
