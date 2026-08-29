<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                {{ __('Manage User Roles') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Admin Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-2xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-400 text-red-800 dark:bg-red-950/60 dark:border-red-800 dark:text-red-300 px-4 py-3 rounded-2xl relative shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-6 space-y-6">
                <div class="flex justify-between items-center border-b border-gray-150 dark:border-slate-800 pb-4">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white font-serif-display">All Registered Accounts</h3>
                    <span class="text-xs font-mono font-bold text-amber-500 bg-amber-500/10 px-3 py-1 rounded-lg">{{ $users->count() }} Users Total</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-800 text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-950">
                            <tr>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">User</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Email Address</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Joined Date</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">System Role</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150 dark:divide-slate-800">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-amber-100 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 flex items-center justify-center font-black text-xs border border-amber-500/20">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <span class="font-bold text-slate-900 dark:text-white">{{ $user->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-mono text-xs">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->id === auth()->id())
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-wider">
                                                {{ $user->role }} (You)
                                            </span>
                                        @else
                                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" onchange="this.form.submit()" class="rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 text-xs py-1.5 px-3 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-500/20 font-bold">
                                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Student</option>
                                                    <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Teacher</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Admin</option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
