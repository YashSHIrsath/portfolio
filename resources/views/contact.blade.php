<x-app-layout>
    <x-slot name="title">Contact</x-slot>

    <div class="max-w-md mx-auto animate-fade-in">
        <h1 class="text-2xl font-bold mb-2 text-center text-slate-800 dark:text-slate-100">/contact</h1>
        <p class="text-xs text-center text-slate-500 dark:text-slate-400 mb-8">
            Get in touch for opportunities or collaborations.
        </p>

        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Name</label>
                <input type="text" id="name" name="name" class="w-full px-3 py-2 rounded-md bg-white dark:bg-[#161b22] border border-slate-200 dark:border-slate-700 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-1 focus:ring-blue-500/20 outline-none transition-all text-sm dark:text-white" placeholder="Jane Doe">
            </div>
            
            <div>
                <label for="email" class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 rounded-md bg-white dark:bg-[#161b22] border border-slate-200 dark:border-slate-700 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-1 focus:ring-blue-500/20 outline-none transition-all text-sm dark:text-white" placeholder="jane@example.com">
            </div>
            
            <div>
                <label for="message" class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Message</label>
                <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 rounded-md bg-white dark:bg-[#161b22] border border-slate-200 dark:border-slate-700 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-1 focus:ring-blue-500/20 outline-none transition-all text-sm dark:text-white" placeholder="Hello..."></textarea>
            </div>
            
            <button type="button" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 text-white text-sm font-medium rounded-md shadow-sm transition-colors cursor-pointer">
                Send Message
            </button>
        </form>
        
        <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
            <a href="mailto:yashshirsath@gmail.com" class="text-xs text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                yashshirsath@gmail.com
            </a>
        </div>
    </div>
</x-app-layout>
