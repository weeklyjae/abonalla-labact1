<div class="mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">Quick Navigation</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <a href="{{ route('admin.coding') }}"
                   class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors {{ request()->routeIs('admin.coding*') ? 'ring-2 ring-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : '' }}">
                    <span class="text-lg mr-2">💻</span>
                    Coding Projects
                </a>
                
                <a href="{{ route('admin.media') }}"
                   class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors {{ request()->routeIs('admin.media*') ? 'ring-2 ring-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : '' }}">
                    <span class="text-lg mr-2">🎬</span>
                    Editing & Photography
                </a>
                
                <a href="{{ route('admin.travel') }}"
                   class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors {{ request()->routeIs('admin.travel*') ? 'ring-2 ring-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : '' }}">
                    <span class="text-lg mr-2">✈️</span>
                    Travel Photos
                </a>
                
                <a href="{{ route('admin.site') }}" 
                   class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors {{ request()->routeIs('admin.site*') ? 'ring-2 ring-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : '' }}">
                    <span class="text-lg mr-2">⚙️</span>
                    Site Settings
                </a>
                
            </div>
        </div>
    </div>
</div>
