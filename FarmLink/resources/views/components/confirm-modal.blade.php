<!-- Confirmation Modal -->
<div x-data="{ 
        show: false, 
        title: '', 
        message: '', 
        confirmAction: null,
        formId: null,
        confirmText: 'Confirm',
        cancelText: 'Cancel',
        type: 'danger'
    }" 
     @open-confirm-modal.window="
        show = true;
        title = $event.detail.title || 'Confirm Action';
        message = $event.detail.message || 'Are you sure?';
        confirmAction = $event.detail.action || null;
        formId = $event.detail.formId || null;
        confirmText = $event.detail.confirmText || 'Confirm';
        cancelText = $event.detail.cancelText || 'Cancel';
        type = $event.detail.type || 'danger';
     "
     x-show="show" 
     x-cloak
     @keydown.escape.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" 
             @click="show = false"></div>

        <!-- Center modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div :class="{
                    'bg-red-100': type === 'danger',
                    'bg-yellow-100': type === 'warning',
                    'bg-blue-100': type === 'info'
                }" class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Danger Icon -->
                    <svg x-show="type === 'danger'" class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <!-- Warning Icon -->
                    <svg x-show="type === 'warning'" class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <!-- Info Icon -->
                    <svg x-show="type === 'info'" class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="title"></h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" x-text="message"></p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        @click="
                            if(formId) {
                                const form = document.getElementById(formId);
                                if(form) {
                                    form.submit();
                                }
                            } else if(confirmAction) {
                                confirmAction();
                            }
                            show = false;
                        "
                        :class="{
                            'bg-red-600 hover:bg-red-700 focus:ring-red-500': type === 'danger',
                            'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500': type === 'warning',
                            'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500': type === 'info'
                        }"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                        x-text="confirmText">
                </button>
                <button type="button" 
                        @click="show = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
                        x-text="cancelText">
                </button>
            </div>
        </div>
    </div>
</div>
