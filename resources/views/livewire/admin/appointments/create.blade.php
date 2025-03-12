<div id="hs-basic-modal" wire:ignore.self class="hs-overlay bg-gray-900/50 dark:bg-neutral-900/80  hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
    <div class="sm:max-w-2xl sm:w-full m-3 sm:mx-auto">
        <form wire:submit="save">
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Modal title
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-basic-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <form wire:submit.prevent="save">
                        <!-- Campo Client ID -->
                        <div class="mb-4">
                            <label for="client_id" class="block text-sm font-medium mb-2 dark:text-white">Client</label>
                            <select id="client_id" wire:model="form.client_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400">
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('form.client_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo Professional ID -->
                        <div class="mb-4">
                            <label for="professional_id" class="block text-sm font-medium mb-2 dark:text-white">Professional</label>
                            <select id="professional_id" wire:model="form.professional_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400">
                                <option value="">Select Professional</option>
                                @foreach($professionals as $professional)
                                <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                                @endforeach
                            </select>
                            @error('form.professional_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo Service ID -->
                        <div class="mb-4">
                            <label for="service_id" class="block text-sm font-medium mb-2 dark:text-white">Service</label>
                            <select id="service_id" wire:model="form.service_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @error('form.service_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo Date Time -->
                        <div class="mb-4">
                            <label for="date_time" class="block text-sm font-medium mb-2 dark:text-white">Date and Time</label>
                            <input type="datetime-local" id="date_time" wire:model="form.date_time" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400">
                            @error('form.date_time') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                            <select id="status" wire:model="form.status" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400">
                                <option value="">Select Status</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                            </select>
                            @error('form.status') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo Notes -->
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium mb-2 dark:text-white">Notes</label>
                            <textarea id="notes" wire:model="form.notes" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:placeholder-neutral-500 dark:text-neutral-400" placeholder="Additional notes"></textarea>
                            @error('form.notes') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botão de Submit -->
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
                    </form>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-basic-modal">
                        Close
                    </button>
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Save changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>